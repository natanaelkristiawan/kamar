<?php

namespace Master\Rooms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Rooms\Interfaces\OwnersRepositoryInterface;
use Master\Rooms\Models\Owners;
use Validator;
use Meta;

class OwnersResourceController extends Controller
{
  protected $repository;
  protected $bank;

  public function __construct(OwnersRepositoryInterface $repository)
  {
    $this->middleware('auth:admin');
    $this->repository = $repository;
    $this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);

    $dataBank = json_decode(file_get_contents(base_path('master/rooms/files/bank.json')));
    $bank[] = array();
    // send to format select2 

    foreach ($dataBank as $list) {
      $bank[] = array(
        'id'  => $list->code,
        'text'=> $list->name.' - '.$list->code
      );
    }

    $this->bank = $bank;


    Meta::title('Owners');
  }

  public function index(Request $request)
  {
    if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Master\Rooms\Repositories\Presenter\OwnersPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }
    return view('rooms::admin.owners.index');  
  }

  public function create(Request $request)
  {
    $data = $this->repository->newInstance([]);
    $bank = $this->bank;

    return view('rooms::admin.owners.form', compact('data', 'bank'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name'      => 'required',
      'email'      => 'required',
      'phone'      => 'required',
      'status'    => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
          ->withErrors($validator)
          ->withInput();
    }

    $dataInsert = array(
      'name'          => $request->name,
      'email'         => $request->email,
      'bank'          => $request->bank,
      'bank_code'     => $request->bank_code,
      'bank_account'  => $request->bank_account,
      'bank_account_photo' => $request->bank_account_photo,
      'photo'         => $request->photo,
      'card_id'       => $request->card_id,
      'selfie_with_card_id'=> $request->selfie_with_card_id,
      'phone'     => $request->phone,
      'status'    => $request->status,
      'content'   => $request->content
    );


    $data = $this->repository->create($dataInsert);
    $request->session()->flash('status', 'Success Insert Data!');
    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.owners');
    }
    return redirect()->route('admin.owners.edit', ['id' => $data->id]);
  }

  public function edit(Request $request, Owners $data)
  {
    $bank = $this->bank;
    return view('rooms::admin.owners.form', compact('data', 'bank'));
  }

  public function update(Request $request, Owners $data)
  {
    $validator = Validator::make($request->all(), [
      'name'      => 'required',
      'email'      => 'required',
      'phone'      => 'required',
      'status'    => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
          ->withErrors($validator)
          ->withInput();
    }

    $dataInsert = array(
      'name'          => $request->name,
      'email'         => $request->email,
      'bank'          => $request->bank,
      'bank_account'  => $request->bank_account,
      'bank_code'  => $request->bank_code,
      'bank_account_photo' => $request->bank_account_photo,
      'photo'         => $request->photo,
      'card_id'       => $request->card_id,
      'selfie_with_card_id'=> $request->selfie_with_card_id,
      'phone'     => $request->phone,
      'status'    => $request->status,
      'content'   => $request->content
    );

    $data = $this->repository->update($dataInsert, $data->id);
    $request->session()->flash('status', 'Success Update Data!');
    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.owners');
    }
    return redirect()->route('admin.owners.edit', ['id' => $data->id]);
  }

  public function delete(Request $request, Owners $data)
  {
    $data = $this->repository->delete($data->id);
    $request->session()->flash('status', 'Success Delete Data!');

    return redirect()->route('admin.owners');
  }

}