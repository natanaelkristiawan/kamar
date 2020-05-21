<?php
namespace Module\Site\Http\Sites;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use Meta;
use Mail;
use Module\Site\Facades\Site;

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
    $mainBanner = Site::getDataSite('main-banner');
    $missionBanner = Site::getDataSite('mission-banner');
    return view('site::public.index', compact('mainBanner', 'missionBanner'));
  }


}