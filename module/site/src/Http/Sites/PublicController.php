<?php
namespace Module\Site\Http\Sites;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use Meta;
use Mail;
use Module\Site\Facades\Site;
use Rooms;
use Articles;
use League\Fractal;
use Module\Site\Library\Mobile_Detect;
use Customers;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;
use Auth;
use Socialite;
use Storage;
use Curl;
use Payments;
use Books;
use View;
use Packages;
use Master\Packages\Models\Package;
use Master\Packages\Models\Counter;
class PublicController extends Controller
{
  function __construct()
  {
    $this->lang = App::getLocale();
    View::share('callback_login', \Request::fullUrl());
  }
  public function setMeta()
  {
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::set('robots', $meta['tag']); 
    Meta::set('keywords', $meta['tag']);
    Meta::set('description', $meta['description']);
  }

  /*Landing*/
  protected function getLocations()
  {
    $dataLocation = Rooms::getLocations(true);
    $locations[] = array(
      'id' => '',
      'text' => ''
    );

    foreach ($dataLocation as $key => $value) {
      $locations[] = array(
        'id' => $value->slug,
        'text' => $value->name
      );
    }
    return $locations;
  }

  public function index()
  { 
    self::setMeta();
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::title($meta['title']);
    Meta::set('active', 'home');
    $mainBanner = Site::getDataSite('main-banner');
    $missionBanner = Site::getDataSite('mission-banner');
    $mission = Site::getDataSite('mission', true)[$this->lang];
    $missionData = Site::getDataSite('mission-data', true);
    $partner = Site::getDataSite('partner', true);
    $featuredRooms = self::getFeaturedRooms(6, $this->lang)->data;
    $featuredType = self::getTypesFeatured($this->lang)->data;
    $lang = $this->lang;


    $locations = self::getLocations();


    return view('site::public.index', 
      compact(
        'mainBanner', 
        'missionBanner', 
        'mission', 
        'missionData', 
        'partner', 
        'lang',
        'featuredRooms',
        'featuredType',
        'locations'
      )
    );
  }

  /*Rooms Details*/
  public function detailRoom(Request $request, $slug = '')
  {
    $data = Rooms::getRoomBySlug($slug, $this->lang);
    $data = json_decode($data)->data;
    if (!(bool)isset($data[0])) {
      return abort(404);
    }
    $room = $data[0];

    $ameneties = Rooms::getAmenetiesByIds($room->ameneties_ids, $this->lang);

    $locations = self::getLocations();

    $isBookmark = false;

    if (Auth::check()) {

      $customer = Auth::user();

      $isBookmark = !(bool)is_null(Site::isBookmark(array('customer_id'=>$customer->id, 'room_id'=>$room->id)));
    }

    $dateDisable = array();

    foreach ($room->date_off as $key => $value) {

      if($value->status){

        $list = self::getDatesFromRange($value->date_start, $value->date_end);

        $dateDisable = $dateDisable + $list;
      }
    }

    // pengen tau uuid tetap sama atau beda
    $uuid = Uuid::uuid4();
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::title($meta['title'].' - '.$room->meta->title);
    Meta::set('robots', $room->meta->tag); 
    Meta::set('keywords', $room->meta->tag);
    Meta::set('description', $room->meta->description);
    Meta::set('active', 'rooms');


    // get info of owner


    $packageOwner = Packages::getPackageByOwner($room->owner_id);

    // $packageOwner = null;
    $numeric = '';

    if (!(bool)is_null($packageOwner)) {
      $numeric = $packageOwner->used_quota;
    }

    return view('site::public.detail', compact('room', 'ameneties', 'locations', 'uuid' , 'dateDisable', 'isBookmark', 'packageOwner', 'numeric'));
  }


  public function checkDataCounter(Request $request)
  {
    $dataSend = array(
      'fingerprint' => $request->fingerprint,
      'dataIPClient' => $request->dataIPClient,
      'ip' => $request->ip,
      'owner_id' => $request->owner_id,
      'room_id' => $request->room_id,
      'package_id' => $request->package_id
    );


    // find data dulu sebelum kalkulasi
    $findData = Counter::where(array('fingerprint' => $request->fingerprint, 'ip' => $request->ip, 'room_id' => $request->room_id))->first();

    if ( is_null($findData) ) {
      // find data room packages
      $package = Package::find($request->package_id);

      $package->used_quota = $package->used_quota + 1;
      $package->remaining_quota = $package->remaining_quota - 1;

      if (($package->remaining_quota - 1) == 0) {
        $package->status = 3;
      }

      $package->save();


      // saatnya insert sebagai report

      Counter::create($dataSend);
    }


    return true;
  }


  protected function addOrdinalNumberSuffix($num) {
      if (!in_array(($num % 100),array(11,12,13))){
      switch ($num % 10) {
        // Handle 1st, 2nd, 3rd
        case 1:  return $num.'st';
        case 2:  return $num.'nd';
        case 3:  return $num.'rd';
      }
    }
    return $num.'th';
  }



  protected function packageChecker($data = array()){
    $result = false;

    $date = strtotime(date('Y-m-d'));

    foreach ($data as $key => $value) {
      if ($date >= strtotime($value->date_start)) {
        if ($date <= strtotime($value->date_end)) {
          if($value->remaining_quota){
            $result = true;
          }
        }
      }
    }

    return $result;

  }


  protected function getDatesFromRange($start_date, $end_date, $date_format = 'Y-m-d')
  {
    $dates_array = array();
    for ($x = strtotime($start_date); $x <= strtotime($end_date); $x += 86400) {
       array_push($dates_array, date($date_format, $x));
    }

    return $dates_array;
  }

  protected function getFeaturedRooms($limit = 6, $language = 'id'){
    $data = Rooms::getFeaturedRooms(true, $limit, $language);
    return json_decode($data);
  }

  protected function getTypesFeatured($language = 'id')
  {
    $detect = new Mobile_Detect;
    $dataLimit = 3;
    if( $detect->isMobile() || $detect->isTablet() ){
      $dataLimit = 4;
    }
    $data = Rooms::getTypesFeatured(true, $dataLimit, $language);
    return json_decode($data);
  }

  /*Rooms*/
  public function rooms(Request $request)
  {
    self::setMeta();
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::title($meta['title'].' - '.trans('routes.rooms'));
    Meta::set('active', 'rooms');
    $data = json_decode(Rooms::getRooms($request, 8, $this->lang));
    $rooms = $data->data;
    $pagination = $data->meta->pagination;
    $featuredRooms = self::getFeaturedRooms(6, $this->lang)->data;
    $route = 'rooms';
    $requestParams = $request->all();


    $locations = self::getLocations();

    return view('site::public.rooms', compact(
      'rooms', 
      'pagination', 
      'featuredRooms', 
      'route', 
      'requestParams',
      'request',
      'locations'
    ));
  }

  /*Blogs*/
  public function blogs(Request $request)
  {
    self::setMeta();
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::title($meta['title'].' - blogs');
    Meta::set('active', 'blogs');
    $data = json_decode(Articles::getArticles($request, 8, $this->lang));
    $articles = $data->data;
    $pagination = $data->meta->pagination;
    $route = 'blogs';
    $requestParams = $request->input();
    return view('site::public.blogs', compact('articles', 'pagination', 'route', 'requestParams'));
  }


  /*Blog Detail*/
  public function blogDetail(Request $request, $slug = '')
  {
    $data = json_decode(Articles::getArticleBySlug($slug,$this->lang))->data;

    if (!(bool)isset($data[0])) {
      return abort(404);
    }

    $article = $data[0];
    Meta::set('active', 'blogs');
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::title($meta['title'].' - '.$article->meta->title);
    Meta::set('robots', $article->meta->tag); 
    Meta::set('keywords', $article->meta->tag);
    Meta::set('description', $article->meta->description);

    $prev = Articles::getArticleBefore($article->id);
    $next = Articles::getArticleAfter($article->id);

    $countArticle = Articles::countArticleByCategory();

    // find latest Article
    $latesArticle = json_decode(Articles::getLatestArticle(array($article->id), 5, $this->lang))->data;
    return view('site::public.blog-detail', compact('article', 'prev', 'next', 'countArticle', 'latesArticle'));
  }

  public function faq()
  {
    self::setMeta();
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::title($meta['title'].' - faq');
    $data = Site::getFaqData();
    $lang = $this->lang;
    return view('site::public.faq', compact('data', 'lang'));
  }

  public function findCustomer(Request $request)
  {
    // tambahan saja
    if (is_null($request->email) && is_null($request->fullname)) {
      return response()->json([
        'status' => true,
        'step' => 'new_book_step'
      ]);
    }


    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'fullname'  => 'required',
      'roomTotal' => 'required',
      'dateStart' => 'required',
      'dateEnd' => 'required',
      'roomID' => 'required',
      'g-recaptcha-response' => 'required|captcha'
    ]);

    if ($validator->fails()) {
      return response()->json(
        array(
          'status' => false,
          'error' => $validator->errors()
        )
      );
    }
    $customer = Customers::findByEmail($request->email);
    if (is_null($customer)) {
      // create account
      $dataCustomer = array(
        'email' => $request->email,
        'name' => $request->fullname,
        'phone' =>  $request->phone,
        'token_verified' => Str::random(40),
        'status' => 0,
      );

      $customer = Customers::createCustomer($dataCustomer);
      // sendEmailActivate
      self::sendEmailActivate($request, $customer);
      // send for check email to activate
      return response()->json([
        'status' => true,
        'message' => 'Congratulations. The room is available. Please check your email to activate your account',
        'step' => 'activate_account'
      ]);
    }
    if (!(bool)is_null($customer->token_verified)) {
      return response()->json([
        'status' => true,
        'message' => trans('site::default.sweet_activate'),
        'step' => 'account_exist_not_active'
      ]);
    }

    if (!(bool)Auth::guard('web')->check()) {
      return response()->json([
        'status' => true,
        'step' => 'account_need_login'
      ]);
    }
    return response()->json([
      'status' => true,
      'step' => 'calculate_booking'
    ]);
  }


  public function reSendEmailActivate(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'g-recaptcha-response' => 'required|captcha'
    ]);

    if ($validator->fails()) {
      return response()->json(
        array(
          'status' => false,
          'error' => $validator->errors()
        )
      );
    }

    $customer = Customers::findByEmail($request->email);
    self::sendEmailActivate($request, $customer);

    // send for check email to activate
    return response()->json([
      'status' => true,
      'message' => 'Check your email to activate your account',
      'step' => 'activate_account'
    ]);
  }
  protected function sendEmailActivate(Request $request, $customer)
  {
    Mail::send('site::public.mails.activate', array('name'=>$customer->name, 'token_verified'=>$customer->token_verified, 'callback'=>$request->callback), function ($message) use ($customer)
    {
      $message->subject('Activate Account');
      $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));
      $message->to($customer->email);
    });
  }

  public function sendPassword($customer, $password)
  {
    Mail::send('site::public.mails.password', array('name'=>$customer->name, 'password'=>$password), function ($message) use ($customer)
    {
      $message->subject('Your Default Password');
      $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));
      $message->to($customer->email);
    });
  }


  public function activateAccount(Request $request, $token = '')
  {
    $customer = Customers::findByTokenActivate($token);
    if (is_null($customer)) {
      abort(404);
    }
    // password before
    $exist = $customer->password;
    $customer->token_verified = null;
    $customer->verified_at = date('Y-m-d H:i:s');
    $customer->status = 1;

    $password = strtolower(Str::random(6));
    if(is_null($exist)){
      $customer->password = bcrypt($password);
    }
    $customer->save();
    if (is_null($exist)) {
      self::sendPassword($customer, $password);
      $request->session()->flash('status_notif', 'Thank you for activate your account. Please check your email to get your password');
    } else {
      $request->session()->flash('status_notif', 'Thank you for activate your account.');
    }
    
    Auth::guard('web')->loginUsingId($customer->id);
    if (!(bool)is_null($request->callback)) {
      return redirect()->route('public.roomDetail', array('slug'=>$request->callback));
    }
    return redirect()->route('public.index');
  }


  /*login*/
  public function doLogin(Request $request)
  {
    $this->middleware('guard:web');
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password'  => 'required|min:6',
      'g-recaptcha-response' => 'required|captcha'
    ]);

    if ($validator->fails()) {
      if($request->ajax()){
        return response()->json([
          'status' => false,
          'message' => 'Failed to login, check your email or password'
        ], 401);
      }
      return redirect()->back()
                    ->withErrors(array('message' => 'Failed to login, check your email or password'))
                    ->withInput();
    }
    $credentials = $request->only('email', 'password');
    $remember = $request->remember;

    if (Auth::guard('web')->attempt($credentials, $remember)) {
      $customer = Customers::findByEmail($request->email);
      session()->flash('status_notif', 'Welcome back '.$customer->name);
      

      if($request->ajax()){
        return response()->json(['status' => true]);
      }

      return redirect()->route('public');
    }
    if($request->ajax()){
      return response()->json([
        'status' => false,
        'message' => 'Failed to login, check your email or password'
      ], 401);
    }
    return redirect()->back()
                  ->withErrors(array('message' => 'Failed to login, check your email or password'))
                  ->withInput();
  }

  /*register*/

  public function doRegister(Request $request)
  {
    $this->middleware('guard:web');
    $validator = Validator::make($request->all(), [
      'email' => 'required|email|unique:customers',
      'password'  => 'required|min:6|confirmed',
      'fullname'  => 'required',
      'phone'  => 'required',
      'g-recaptcha-response' => 'required|captcha'
    ]);

    if ($validator->fails()) {
      if($request->ajax()){
        return response()->json([
          'status' => false,
          'message' => 'Email has been registered with another account'
        ], 401);
      }
      return redirect()->back()
                    ->withErrors(array('message' => 'Failed to login, check your email or password'))
                    ->withInput();
    }


    $dataCustomer = array(
      'email'   => $request->email,
      'phone'   => $request->phone,
      'name' => $request->fullname,
      'password'  => bcrypt($request->input('password')),
      'token_verified'  =>  Str::random(40),
      'status' => 1
    );

    $customer = Customers::createCustomer($dataCustomer);
    // sendEmailActivate
    self::sendEmailActivate($request, $customer);
    Auth::guard('web')->loginUsingId($customer->id);
    $request->session()->flash('status_notif', 'Thank you for registration. Please check your email to activate your account');
    
    if($request->ajax()){
      return response()->json(['status' => true]);
    }
    return redirect()->route('public.index');
  } 


  public function fbLogin(Request $request)
  {
    $this->middleware('guard:web');

    session(['callback' => $request->callback]);

    return Socialite::driver('facebook')->redirect();
  }


  public function googleLogin(Request $request)
  {
    $this->middleware('guard:web');
    
    session(['callback' => $request->callback]);

    return Socialite::driver('google')->redirect();
  }


  public function googleConnect(Request $request)
  {
    $google = Socialite::driver('google')->stateless()->user();
    $customer = Customers::findByField('google_id', $google->id);
    if (is_null($customer)) {
      // coba cek emailnya udah terdaftar apa belum
      $emailCustomer = Customers::findByField('email', $google->email);
      // belum pernah daftar sama sekali waktunya save session
      if (is_null($emailCustomer)) {
         $dataCustomer = array(
          'email' => $google->email,
          'name' => $google->name,
          'phone' => null,
          'google_id' => $google->id,
          'token_verified' => Str::random(40),
          'status' => 0,
        );
        $customer = Customers::createCustomer($dataCustomer);
        // sendEmailActivate
        self::sendEmailActivate($request, $customer);
        Auth::guard('web')->loginUsingId($customer->id);
        $request->session()->flash('status_notif', 'Thank you for registration. Please check your email to activate your account');
        
        if (session()->has('callback')) {

          $callback = session('callback');
          session(['callback' => null]);
          return redirect($callback);
        }


        return redirect()->route('public.index');
        
      }

      // kalau udah daftar tinggal update aja
      $dataInsert = array(
        'google_id' => $google->id,
        'email'       => $emailCustomer->email,
        'status'      => 1
      );

      // update data
      $customer = Customers::updateOrCreate(array('email'=>$emailCustomer->email, 'id' => $emailCustomer->id), $dataInsert);
    }
    // force login
    Auth::guard('web')->loginUsingId($customer->id);

    if (session()->has('callback')) {

      $callback = session('callback');
      session(['callback' => null]);
      return redirect($callback);
    }


    return redirect()->route('public.index');
  }

  public function fbConnect(Request $request)
  {
    $this->middleware('guard:web');
    session()->put('state', $request->input('state'));
    $facebook = Socialite::driver('facebook')->user();
    // cari user idnya dulu di database ada apa kagak

    $customer = Customers::findByField('facebook_id', $facebook->id);
    // ini usernya belum pernah login pakai fb
    if (is_null($customer)) {
      // coba cek emailnya udah terdaftar apa belum
      $emailCustomer = Customers::findByField('email', $facebook->email);

      // belum pernah daftar sama sekali waktunya save session
      if (is_null($emailCustomer)) {
        $dataCustomer = array(
          'email' => $facebook->user['email'],
          'name' => $facebook->user['name'],
          'phone' => null,
          'facebook_id' => $facebook->id,
          'token_verified' => Str::random(40),
          'status' => 0,
        );
        $customer = Customers::createCustomer($dataCustomer);
        // sendEmailActivate
        self::sendEmailActivate($request, $customer);
        Auth::guard('web')->loginUsingId($customer->id);
        $request->session()->flash('status_notif', 'Thank you for registration. Please check your email to activate your account');
        
        if (session()->has('callback')) {

          $callback = session('callback');
          session(['callback' => null]);
          return redirect($callback);
        }

        return redirect()->route('public.index');
      }
      // kalau udah daftar tinggal update aja
      $dataInsert = array(
        'facebook_id' => $facebook->id,
        'email'       => $emailCustomer->email,
        'status'      => 1
      );
      // update data
      $customer = Customers::updateOrCreate(array('email'=>$emailCustomer->email, 'id' => $emailCustomer->id), $dataInsert);
    }
    // force login
    Auth::guard('web')->loginUsingId($customer->id);


    if (session()->has('callback')) {

      $callback = session('callback');
      session(['callback' => null]);
      return redirect($callback);
    }

    return redirect()->route('public.index');
  }

  public function captureMidtrans(Request $request)
  {

    Storage::disk('local')->append('public/midtrans.json', json_encode($request->all()));
    // debug dulu
    // return true;


    $dataMidtrans = array(
      'order_id'=> $request->order_id,
      'status_code'=> $request->status_code,
      'status_message'=> $request->status_message,
      'transaction_id'=> $request->transaction_id,
      'transaction_status'=> $request->transaction_status,
      'details'=> $request->all(),
    );

    // create history payment
    $midtrans = Payments::createHistoryPayment($dataMidtrans);

    // booking waiting for payment
    if ($request->transaction_status == 'pending' && $request->status_code == 201) {
      // find data detail from book history
      $history = Books::findHistory($request->order_id);

      if (is_null($history)) {
        return;
      }
      

      $dataBooking = $history->data;
      unset($dataBooking['notes']);
      // create Book pending
      $book = Books::updateOrCreateBookPending(array('uuid' => $request->order_id), $dataBooking);
      $book->va_numbers = $request->va_numbers[0]['va_number'];
      $book->bank = $request->va_numbers[0]['bank'];
      // find customernya
      $customer = $book->customer;

      if (is_null($customer)) {
        return;
      }

      $params = array(
        'customer' => $book->customer->name,
        'room_photo' => $book->room->photo_primary,
        'room_name' => $book->room->name,
        'location_name' => $book->room->location->name,
        'date_checkin' => $book->date_checkin,
        'date_checkout' => $book->date_checkout,
        'rooms' => $book->rooms,
        'guests' => $book->guests,
        'grand_total' => $book->grand_total,
        'bank' => $request->va_numbers[0]['bank'],
        'va_numbers' => $request->va_numbers[0]['va_number']
      );

      self::emailWaitPayment($customer->email, $params);
    }

    // booking success to payment
    if ($request->transaction_status == 'settlement' && $request->status_code == 200) {
      $book = Books::findBook($request->order_id);

      if (is_null($book)) {
        return;
      }
      // update data
      $bookUpdate = array(
        'payment_id' => $midtrans->id,
        'status' => 1,
        'updated_at' => date('Y-m-d H:i:s')
      );
      $book = Books::updateBook($book->id, $bookUpdate);

      $customer = $book->customer;

      if (is_null($customer)) {
        return;
      }

      $params = array(
        'customer' => $customer->name,
        'customer_phone' => $customer->phone,
        'room_photo' => $book->room->photo_primary,
        'room_name' => $book->room->name,
        'location_name' => $book->room->location->name,
        'date_checkin' => $book->date_checkin,
        'date_checkout' => $book->date_checkout,
        'rooms' => $book->rooms,
        'guests' => $book->guests,
        'grand_total' => $book->grand_total,
        'total' => $book->total,
        'owner_name' => $book->room->owner->name,
        'owner_phone' => $book->room->owner->phone,
        'room_address' => $book->room->address,
        'room_address_detail' => $book->room->address_detail['en'],
        'map' => 'https://maps.google.com/?q='.$book->room->latitude.','.$book->room->longitude
      );


      self::emailSuccess($customer->email, $params);
      self::emailOwner($book->room->owner->email, $params);
    }

    // booking using credit card
    if ($request->transaction_status == 'capture' && $request->status_code == 200) {
      $history = Books::findHistory($request->order_id);
      if (is_null($history)) {
        return;
      }
      $dataBooking = $history->data;
      $dataBooking['payment_id'] = $midtrans->id;
      $dataBooking['status'] = 1;

      unset($dataBooking['notes']);
      $book = Books::updateOrCreateBookPending(array('uuid' => $request->order_id), $dataBooking);

      $customer = $book->customer;
      if (is_null($customer)) {
        return;
      }
      $params = array(
        'customer' => $book->customer->name,
        'customer_phone' => $book->customer->phone,
        'room_photo' => $book->room->photo_primary,
        'room_name' => $book->room->name,
        'location_name' => $book->room->location->name,
        'date_checkin' => $book->date_checkin,
        'date_checkout' => $book->date_checkout,
        'rooms' => $book->rooms,
        'guests' => $book->guests,
        'total' => $book->total,
        'grand_total' => $book->grand_total,
        'owner_name' => $book->room->owner->name,
        'owner_phone' => $book->room->owner->phone,
        'room_address' => $book->room->address,
        'room_address_detail' => $book->room->address_detail['en'],
        'map' => 'https://maps.google.com/?q='.$book->room->latitude.','.$book->room->longitude
      );

      self::emailSuccess($customer->email, $params);
      self::emailOwner($book->room->owner->email, $params);
    }

    // booking expired
    if ($request->transaction_status == 'expire' && $request->status_code == 202) {
      $book = Books::findBook($request->order_id);

      if (is_null($book)) {
        return;
      }
      // update data
      $bookUpdate = array(
        'payment_id' => $midtrans->id,
        'status' => 2,
        'updated_at' => date('Y-m-d H:i:s')
      );
      Books::updateBook($book->id, $bookUpdate);
    }

    if ($request->transaction_status == 'cancel' && $request->status_code == 202) {
      $book = Books::findBook($request->order_id);
      // update data

      if (is_null($book)) {
        return;
      }
      $bookUpdate = array(
        'payment_id' => $midtrans->id,
        'status' => 2,
        'updated_at' => date('Y-m-d H:i:s')
      );
      Books::updateBook($book->id, $bookUpdate);
    }
  }


  public function privacyPolicy(Request $request)
  {
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::title($meta['title'].' - '.trans('site::default.privacyPolicy'));
    self::setMeta();

    $data = Site::getDataSite('privacy')[$this->lang];
    $banner = Site::getDataSite('privacy-banner');

    return view('site::public.page', compact('data', 'banner'));
  }

  public function aboutUs(Request $request)
  {
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::title($meta['title'].' - '.trans('site::default.aboutUs'));
    self::setMeta();
    
    $data = Site::getDataSite('aboutus')[$this->lang];
    $banner = Site::getDataSite('aboutus-banner');

    return view('site::public.page', compact('data', 'banner'));
  }

  public function condition(Request $request)
  {
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::title($meta['title'].' - '.trans('site::default.termCondition'));
    self::setMeta();
    $data = Site::getDataSite('condition')[$this->lang];
    $banner = Site::getDataSite('condition-banner');

    return view('site::public.page', compact('data', 'banner'));
  }



  public function bookmark(Request $request)
  {
    if (!(bool)Auth::check()) {
      return response()->json(
        array(
          'status' => false,
          'message' => 'need_login'
        ),
        401
      );
    }

    $validator = Validator::make($request->all(), [
      'room_id' => 'required'
    ]);

    if ($validator->fails()) {
      return response()->json(
        array(
          'status' => false,
          'error' => $validator->errors()
        )
      );
    }

    $customer = Auth::user();

    $attribute = array(
      'customer_id' => $customer->id,
      'room_id' => $request->room_id
    );

    $params = array(
      'customer_id' => $customer->id,
      'room_id' => $request->room_id,
      'status' => $request->status
    );


    $query = Site::setBookmark($attribute, $params);

    return response()->json(array(
      'status' => true
    ));
    
  }


  public function callbackSuccess(Request $request)
  {

  }


  public function emailSuccess($email, $params)
  {

    Mail::send('site::public.mails.successPayment', $params, function ($message) use ($email)
    {
      $message->subject('Success Payment');
      $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));
      $message->to($email);
    });
  }

  public function emailWaitPayment($email, $params)
  {

    Mail::send('site::public.mails.waitingPayment', $params, function ($message) use ($email)
    {
      $message->subject('Waiting Payment');
      $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));
      $message->to($email);
    });
  }

  public function emailOwner($email, $params)
  {

    Mail::send('site::public.mails.owner', $params, function ($message) use ($email)
    {
      $message->subject('Booking Notification');
      $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));
      $message->to($email);
    });
  }
}