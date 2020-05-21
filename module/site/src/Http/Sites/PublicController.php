<?php
namespace Module\Site\Http\Sites;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use Meta;
use Mail;

class PublicController extends Controller
{
  function __construct()
  {
    Meta::title();
    Meta::set('robots', ''); 
    Meta::set('keywords', '');
    Meta::set('description', '');
    $this->lang = App::getLocale();
  }


  public function index()
  {
    return view('site::public.index');
  }


}