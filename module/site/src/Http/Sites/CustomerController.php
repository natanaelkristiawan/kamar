<?php
namespace Module\Site\Http\Sites;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App;
use Payments;
use Validator;
use Rooms;
use Books;
use Hash;
use Reviews;
use Module\Site\Facades\Site;

class CustomerController extends Controller
{
  protected $customer;
	function __construct()
  {
    $this->lang = App::getLocale();
    $this->middleware('auth:web');
    $this->customer = Auth::user();
  }

  public function dashboard()
  {
    $customer = Auth::user();
    return view('site::public.dashboard.index', compact('customer'));
  }
  
  public function bookingHistory(Request $request)
  {
    $customer = Auth::user();

    $data = json_decode(Books::findPendingBookByCustomer($request, $customer->id));

    $books = $data->data;
    $pagination = $data->meta->pagination;
    $route = 'bookingHistory';
    $requestParams = $request->input();


    return view('site::public.dashboard.history', compact(
      'customer',
      'books',
      'pagination',
      'route',
      'requestParams',
      'request'
    ));
  }

  public function bookingHistorySuccess(Request $request)
  {
    $customer = Auth::user();

    $data = json_decode(Books::findSuccessBookByCustomer($request, $customer->id));

    $books = $data->data;
    $pagination = $data->meta->pagination;
    $route = 'bookingHistorySuccess';
    $requestParams = $request->input();


    return view('site::public.dashboard.history-success', compact(
      'customer',
      'books',
      'pagination',
      'route',
      'requestParams'
    ));
  }

  public function updateProfile(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'phone' => 'required',
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
    $customer = Auth::user();
    /*check old password*/ 

    $changePassword = false;


    if (!(bool)empty($request->old_password)) {
      $validator  = Validator::make($request->all(), [
        'old_password'=> 'required',
        'password' => 'required|min:6|confirmed',
      ]);

      // check apakah password old nya sama apa g?
      if (!(bool)Hash::check($request->old_password, $customer->password)) {
        return response()->json(
          array(
            'status' => false,
            'error' => array('old_password' => array('Old Password Wrong'))
          ),401
        );
      }
      if ($validator->fails()) {
        return response()->json(
          array(
            'status' => false,
            'error' => $validator->errors()
          ),401
        );
      }
      $customer->password = bcrypt($request->password);
      $changePassword = true;
    }

    $customer->name = $request->name;
    $customer->phone = $request->phone;
    $customer->save();
     if ($changePassword) {
      $request->session()->flash('status_notif', 'Success, your data update with change password');
    } else {
      $request->session()->flash('status_notif', 'Success, your data update');
    }

    return response()->json(array(
      'status' => true
    ));

  }

  public function getSnapToken(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'fullname'  => 'required',
      'roomTotal' => 'required',
      'dateStart' => 'required',
      'dateEnd' => 'required',
      'roomID' => 'required',
      'nights' => 'required',
      'uuid'  => 'required',
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
    $calculatePayment = self::calculatePayment($request->roomID, $request->roomTotal, $request->nights);

    $customer = Auth::user();

    $customer_details = array(
      'first_name'       => $customer->name,
      'email'            => $customer->email,
      'phone'            => $customer->phone
    );

    $params = array(
      'transaction_details' => array(
        'order_id' => $request->uuid,
        'gross_amount' => $calculatePayment['grandTotal'],
      ),
      'item_details'        => $calculatePayment['items'],
      'customer_details'    => $customer_details,
      'enabled_payments' => 
      ['credit_card',
      'bca_klikbca', 'bri_epay', 'echannel', 'permata_va',
      'bca_va', 'bni_va', 'other_va'],
    );
    $snapToken = Payments::getSnapToken($params);
    // set cookies buat save sementara bookingnya nnti panggil kalau success update, set 30menit saja
    $setHistory = array(
      'uuid' => $request->uuid,
      'customer_id' => $customer->id,
      'room_id' => $request->roomID,
      'payment_id' => null,
      'rooms' => $request->roomTotal,
      'guests' => $request->roomTotal * 2,
      'nights' => $request->nights,
      'price' => $calculatePayment['price'],
      'total' => $calculatePayment['total'],
      'service' => $calculatePayment['service'],
      'grand_total' => $calculatePayment['grandTotal'],
      'date_checkin' => $request->dateStart,
      'date_checkout' => $request->dateEnd,
      'notes'=>null,
      'status' => 0
    );
    Books::updateOrCreateHistory(array('uuid'=>$request->uuid), array('uuid'=>$request->uuid,'data'=>$setHistory));
    return response()->json([
      'status' => true,
      'snapToken' => $snapToken
    ]);
  }

  protected function calculatePayment($roomID, $roomTotal, $nights)
  {
    $room = Rooms::findByField('id', $roomID);
    /*calculate backend*/ 

    $total = $room->price * $roomTotal * $nights;
    $service = ($total * 10) / 100;
    $grandTotal = $total + $service;


    $items = array(
      array(
        'id'       => 'rooms',
        'price'    => $room->price * $nights,
        'quantity' => $roomTotal,
        'name'     => $room->name.' '.$nights.' night'
      ),
      array(
        'id'       => 'service',
        'price'    => $service,
        'quantity' => 1,
        'name'     => 'Service of kamartamu'
      )
    );

    return [
      'price' => $room->price,
      'total' => $total,
      'service' => $service,
      'grandTotal' => $grandTotal,
      'items' => $items
    ];
  }


  public function saveResponseMidtrans(Request $request)
  {
    $validator = Validator::make($request->all(), [
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
     // find data detail from book history
    $history = Books::findHistory($request->order_id);
    $dataBooking = $history->data;
    if ($request->status_code == 200) {
      unset($dataBooking['payment_id']);
      $dataBooking['status'] = 1;
    }
    $dataBooking['notes'] = $request->all();
    // create Book pending
    Books::updateOrCreateBookPending(array('uuid' => $request->order_id), $dataBooking);
    $request->session()->flash('status_notif', 'Thank you for create booking in kamartamu.com, Complete your payment');
    
    if ($request->status_code == 200) {
      return response()->json([
        'status' => true,
        'redirect' => route('public.bookingHistorySuccess')
      ]);
    }

    return response()->json([
      'status' => true,
       'redirect' => route('public.bookingHistory')
    ]);
  }

  public function bookingReceipt(Request $request, $uuid = '')
  {
    $book = Books::findBook($uuid);
    if (is_null($book)) {
      return abort(404);
    }
    return view('site::public.receipt', compact('book'));
  }

  public function sendReview(Request $request)
  {

    $customer = Auth::user();
    $validator = Validator::make($request->all(), [
      'g-recaptcha-response' => 'required|captcha',
      'review' => 'required',
      'book_id' => 'required',
    ]);

    // find data
    if ($validator->fails()) {
      return response()->json(
        array(
          'status' => false,
          'message' => 'The field is mandatory'
        )
      );
    }

    $dataSend = array(
      'book_id' => $request->book_id,
      'room_id' => Books::findBookByID($request->book_id)->room_id,
      'customer_id' => $customer->id,
      'review' => $request->review,
      'status' => 0
    );

    $review = Reviews::setReview($request->book_id, $customer->id,  $dataSend );

    $response = false;
    if ((bool)$review) {
      $bookUpdate = array(
        'review_id' => $review->id
      );
      Books::updateBook($request->book_id, $bookUpdate);
      $response = true;
    }

    return response()->json(
      array(
        'status' => $response,
        'message' => $response ? : 'The field is mandatory'
      )
    );
  }


  public function bookmark(Request $request)
  {
    $customer = Auth::user();
    $data = json_decode(Site::findBookmarkByCustomer($request, $customer->id, 4));
    $rooms = $data->data;
    $pagination = $data->meta->pagination;

    $route = 'bookmarkList';
    $requestParams = $request->all();

    return view('site::public.dashboard.bookmark', compact('rooms', 'pagination', 'route', 'requestParams', 'request'));
  }


  public function logout(Request $request)
  {
    Auth::guard('web')->logout();
    session()->flush();
    $request->session()->flash('status_notif', 'Thank you for visit kamartamu');
    return redirect()->route('public.index');
  }
}