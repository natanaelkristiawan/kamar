<?php
namespace Module\Site\Http\Sites;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App;
class CustomerController extends Controller
{
	function __construct()
  {
    $this->lang = App::getLocale();
    $this->middleware('auth:web');
  }
 public function logout(Request $request)
  {
    Auth::guard('web')->logout();
    session()->flush();
    $request->session()->flash('status_notif', 'Thank you for visit kamartamu');
    return redirect()->route('public.index');
  }
}