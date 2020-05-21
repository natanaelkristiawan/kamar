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
    $this->lang = App::getLocale();
    self::setMeta();
  }


  public function setMeta()
  {
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::title($meta['title']);
    Meta::set('robots', $meta['tag']); 
    Meta::set('keywords', $meta['tag']);
    Meta::set('description', $meta['description']);
  }

  public function index()
  { 
    $mainBanner = Site::getDataSite('main-banner');
    $missionBanner = Site::getDataSite('mission-banner');
    $mission = Site::getDataSite('mission', true)[$this->lang];
    $missionData = Site::getDataSite('mission-data', true);
    $partner = Site::getDataSite('partner', true);

    $lang = $this->lang;
    return view('site::public.index', compact('mainBanner', 'missionBanner', 'mission', 'missionData', 'partner', 'lang'));
  }


}