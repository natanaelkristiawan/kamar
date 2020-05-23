<?php
namespace Module\Site\Http\Sites;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use Meta;
use Mail;
use Module\Site\Facades\Site;
use Rooms;
use League\Fractal;
use Module\Site\Library\Mobile_Detect;
class PublicController extends Controller
{
  function __construct()
  {
    $this->lang = App::getLocale();

  }

  public function setMeta()
  {
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::title($meta['title']);
    Meta::set('robots', $meta['tag']); 
    Meta::set('keywords', $meta['tag']);
    Meta::set('description', $meta['description']);
  }

  /*Landing*/
  public function index()
  { 
    self::setMeta();
    $mainBanner = Site::getDataSite('main-banner');
    $missionBanner = Site::getDataSite('mission-banner');
    $mission = Site::getDataSite('mission', true)[$this->lang];
    $missionData = Site::getDataSite('mission-data', true);
    $partner = Site::getDataSite('partner', true);
    $featuredRooms = self::getFeaturedRooms(6, $this->lang)->data;
    $featuredType = self::getTypesFeatured($this->lang)->data;
    $lang = $this->lang;
    return view('site::public.index', 
      compact(
        'mainBanner', 
        'missionBanner', 
        'mission', 
        'missionData', 
        'partner', 
        'lang',
        'featuredRooms',
        'featuredType'
      )
    );
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
  public function detailRoom(Request $request, $slug = '')
  {
    $data = Rooms::getRoomBySlug($slug, $this->lang);

    $data = json_decode($data)->data;


    if (!(bool)isset($data[0])) {
      return abort(404);
    }
    $room = $data[0];
    $ameneties = json_decode(Rooms::getAmenetiesByIds($room->ameneties_ids, $this->lang))->data;

    Meta::title('kamartamu.com - '.$room->meta->title);
    Meta::set('robots', $room->meta->tag); 
    Meta::set('keywords', $room->meta->tag);
    Meta::set('description', $room->meta->tag);

    return view('site::public.detail', compact('room', 'ameneties'));
  }


}