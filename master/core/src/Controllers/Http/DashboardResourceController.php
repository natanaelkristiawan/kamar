<?php

namespace Master\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Meta;
use DB;

class DashboardResourceController extends Controller
{

  protected $report;

	public function __construct()
	{
		$this->middleware('auth:admin');
		Meta::title('Dashboard');
	}

	public function index()
	{
		return view('core::admin.core.dashboard');
	}

  public function profile()
  {
    Meta::title('Profile');
    $data = Auth::guard('admin')->user();
    return view('core::admin.core.profile', compact('data'));
  }

  public function updateProfilePicture(Request $request)
  {
    $data = Auth::guard('admin')->user();
    $data->photo = $request->photo;
    $data->save();

    return response()->json(array(
      'status' => true
    ));
  }

  public function doUpdateProfile(Request $request)
  {
    $data = Auth::guard('admin')->user();
    $validator = Validator::make($request->all(), [
      'name'  => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
              ->withErrors($validator)
              ->withInput();
    }


    if (!(bool)empty($request->password)) {
      if (strlen($request->password) < 6) {
        return redirect()->back()
                    ->withErrors(array('password' => 'Minimal Password 6 Character'))
                    ->withInput();
      }
    }

    $data->name = $request->name;

    if (!(bool)empty($request->password)) {
      $data->password = bcrypt($request->password);
    }

    $data->save();

    $request->session()->flash('status', 'Success Update Data!');

    return redirect()->back();
  }
}