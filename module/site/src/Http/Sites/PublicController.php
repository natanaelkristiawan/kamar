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
class PublicController extends Controller
{
  function __construct()
  {
    $this->lang = App::getLocale();
  }
  public function setMeta()
  {
    $meta = Site::getDataSite('meta')[$this->lang];
    Meta::set('robots', $meta['tag']); 
    Meta::set('keywords', $meta['tag']);
    Meta::set('description', $meta['description']);
  }

  /*Landing*/
  public function index()
  { 
    self::setMeta();
    Meta::title('kamartamu.com');
    Meta::set('active', 'home');
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

  /*Rooms Details*/
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
    Meta::set('active', 'rooms');
    return view('site::public.detail', compact('room', 'ameneties'));
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
    Meta::title('kamartamu.com - '.trans('routes.rooms'));
    Meta::set('active', 'rooms');
    $data = json_decode(Rooms::getRooms($request, 8, $this->lang));
    $rooms = $data->data;
    $pagination = $data->meta->pagination;
    $featuredRooms = self::getFeaturedRooms(6, $this->lang)->data;
    $route = 'rooms';

    return view('site::public.rooms', compact('rooms', 'pagination', 'featuredRooms', 'route'));
  }

  /*Blogs*/
  public function blogs(Request $request)
  {
    self::setMeta();
    Meta::title('kamartamu.com - blogs');
    Meta::set('active', 'blogs');
    $data = json_decode(Articles::getArticles($request, 1, $this->lang));
    $articles = $data->data;
    $pagination = $data->meta->pagination;
    $route = 'blogs';
    return view('site::public.blogs', compact('articles', 'pagination', 'route'));
  }


}