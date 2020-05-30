<?php

namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Site\Interfaces\SiteRepositoryInterface;
use Module\Site\Models\Site;
use Validator;
use Module\Site\Http\Traits\MainTrait;
use Illuminate\Support\Str;
class SiteResourceController extends Controller
{
	// use MainTrait;
	protected $repository;

	public function __construct(SiteRepositoryInterface $repository)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;
	}

	public function index(Request $request)
	{
		$meta = self::getMeta('array');
		$mainBanner = self::getMainBanner();
		$phone = self::getPhone();
		$email = self::getEmail();
		$address = self::getAddress();
		$mission = self::getMission('array');
		$missionBanner = self::getMissionBanner();
		$missionData = self::getMissionData('array');
		$privacy = self::getPrivacy('array');
		$privacyBanner = self::getPrivacyBanner();
		$partner = self::getPartner('array');
		$aboutus = self::getAboutus('array');
		$aboutusBanner = self::getAboutusBanner();
		$condition = self::getCondition('array');
		$conditionBanner = self::getConditionBanner();
		$payment = self::getPayment('array');
		$paymentBanner = self::getPaymentBanner();
		return view('site::admin.site.index', compact(
			'meta', 
			'mainBanner', 
			'phone', 
			'email',
			'address',
			'mission',
			'missionBanner',
			'privacy',
			'privacyBanner',
			'missionData',
			'partner',
			'aboutus',
			'aboutusBanner',
			'condition',
			'conditionBanner',
			'payment',
			'paymentBanner',
		));
	}

	public function store(Request $request)
	{
		/*main group*/
		self::setMainBanner($request);
		self::setMeta($request, 'array');
		self::setPhone($request);
		self::setEmail($request);
		self::setAddress($request);
		self::setMission($request, 'array');
		self::setMissionBanner($request);
		self::setMissionData($request, 'array');
		self::setPrivacy($request, 'array');
		self::setPrivacyBanner($request);
		self::setPartner($request, 'array');
		self::setAboutus($request, 'array');
		self::setAboutusBanner($request);
		self::setCondition($request, 'array');
		self::setConditionBanner($request);
		self::setPayment($request, 'array');
		self::setPaymentBanner($request);
		$request->session()->flash('status', 'Success Insert Data!');
		return redirect()->route('admin.site');
	}

	public function __call($method, $argument)
	{
		// set or get
		$action = explode('_', Str::snake($method));
		$request = count($argument) ? $argument[0] : '';
		if ($action[0] == 'set') {

			unset($action[0]);
			$params = array(
	      'name' => ucwords( implode(' ', $action) ),
	      'slug' => implode('-', $action),
	      'status' => 1
	    );
	    $value = is_null($request->{implode('_', $action)}) ? ((isset($argument[1]) && $argument[1]) == 'array' ? array() : '') : $request->{implode('_', $action)}; 
	    return $this->repository->updateOrCreate($params, ($params + array('value' => $value)));
		}

		if ($action[0] == 'get') {
			unset($action[0]);
			$query = $this->repository->findWhere(array('slug'=>implode('-', $action)))->first();
			return is_null($query) ? ((isset($argument[0]) && $argument[0]) == 'array' ? $this->repository->newInstance([]) : '') : $query->value;
		}
	}

}