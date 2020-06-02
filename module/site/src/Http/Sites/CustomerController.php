<?php
namespace Module\Site\Http\Sites;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App;
use Payments;
use Validator;
use Rooms;
class CustomerController extends Controller
{

  protected $customer;

	function __construct()
  {
    $this->lang = App::getLocale();
    $this->middleware('auth:web');
    $this->customer = Auth::user();
  }

  public function getSnapToken(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'phone' => 'required',
      'fullname'  => 'required',
      'roomTotal' => 'required',
      'dateStart' => 'required',
      'dateEnd' => 'required',
      'roomID' => 'required',
      'nights' => 'required',
      'uuid'  => 'required',
      'g-recaptcha-response' => 'captcha'
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


    $customer_details = array(
      'first_name'       => $request->fullname,
      'email'            => $request->email,
      'phone'            => $request->phone,
    );



    $params = array(
      'transaction_details' => array(
        'order_id' => $request->uuid,
        'gross_amount' => $calculatePayment['grandTotal'],
      ),
      'item_details'        => $calculatePayment['items'],
      'customer_details'    => $customer_details
    );

    $snapToken = Payments::getSnapToken($params);
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
      'total' => $total,
      'service' => $service,
      'grandTotal' => $grandTotal,
      'items' => $items
    ];
  }


  public function logout(Request $request)
  {
    Auth::guard('web')->logout();
    session()->flush();
    $request->session()->flash('status_notif', 'Thank you for visit kamartamu');
    return redirect()->route('public.index');
  }
}