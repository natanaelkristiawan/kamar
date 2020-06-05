<?php

namespace Master\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Customers\Interfaces\CustomersRepositoryInterface;
use Master\Customers\Models\Customers;
use Validator;
use Meta;
class CustomersResourceController extends Controller
{
	protected $repository;

	public function __construct(CustomersRepositoryInterface $repository)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;
		$this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
    Meta::title('Customers');
	}

	public function index(Request $request)
	{
   	if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Master\Customers\Repositories\Presenter\CustomersPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }
    return view('customers::admin.customers.index');  
	}

	public function create(Request $request)
	{
    $method = 'create';
    $data = $this->repository->newInstance([]);

    $data->name = old('name');
    $data->email = old('email');
    $data->phone = old('phone');
    $data->dob = old('dob');
    $data->gender = old('gender');
    $data->photo = old('photo');
    $data->password = old('password');
    $data->status = old('status');

    return view('customers::admin.customers.form', compact('data', 'method'));
	}

	public function store(Request $request)
	{
	  $validator = Validator::make($request->all(), [
      'email' => 'required|email|unique:customers',
      'phone' => 'required',
      'name'  => 'required',
      'password'  => 'required|min:6|confirmed',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
    }
    $dataInsert = array(
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'password' => bcrypt($request->password),
      'status' => $request->status,
    );


    $data = $this->repository->create($dataInsert);
    $request->session()->flash('status', 'Success Insert Data!');
    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.customers');
    }
    return redirect()->route('admin.customers.edit', ['id' => $data->id]);

	}

	public function edit(Request $request, Customers $data)
	{
    $method = 'edit';
	  return view('customers::admin.customers.form', compact('data', 'method'));
	}

	public function update(Request $request, Customers $data)
	{
    $validator = Validator::make($request->all(), [
      'email' => 'required|email|unique:customers,email,'.$data->id,
      'phone' => 'required',
      'name'  => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
    }

    if(!(bool)is_null($request->password)){
      $validator = Validator::make($request->all(), [
        'password'  => 'required|min:6|confirmed',
      ]);

      if ($validator->fails()) {
        return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
      }

    }
    $dataInsert = array(
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'status' => $request->status,
    );

    if(!(bool)is_null($request->password)){
      $dataInsert['password'] = bcrypt($request->password);
    }

    $data = $this->repository->update($dataInsert, $data->id);
    $request->session()->flash('status', 'Success Update Data!');
    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.customers');
    }
    return redirect()->route('admin.customers.edit', ['id' => $data->id]);
	  
	}

	public function delete(Request $request, Customers $data)
	{ 
    $data = $this->repository->delete($data->id);
    $request->session()->flash('status', 'Success Delete Data!');

    return redirect()->route('admin.customers');
	}

}