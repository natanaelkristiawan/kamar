@extends('theme.admin.layouts.blank')

@section('content')
<form style="display: none;" id="upload-picture">@csrf</form>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('owners.create') }}
        </div>
      </div>
    </div>
      <!-- end row -->

    <div class="page-content-wrapper">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="mt-0 header-title">Create Data</h4>
                <form role="form" method="POST" action="" data-toggle="validator" role="form" data-disable="false">
                @csrf
                  <div class="form-group">
                    <label>Name <span class="required">*</span></label> 
                    <input required="" data-error="Please enter name" type="text" value="{{ $data->name }}" placeholder="Name" name="name" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div>
                  <div class="form-group">
                    <label>Email <span class="required">*</span></label> 
                    <input required="" data-error="Please enter email" type="text" value="{{ $data->email }}" placeholder="Email" name="email" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div>

                  <div class="form-group">
                    <label>Phone <span class="required">*</span></label> 
                    <input required="" data-error="Please enter phone" type="tel" value="{{ $data->phone }}" placeholder="Phone" name="phone" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div>
                  
                  <div class="form-group">
                    <label>Bank</label> 
                    <input type="hidden" name="bank" class="select-name" value="{{ $data->bank }}">
                    <select class="form-control select-bank" name="bank_code"></select>  
                  </div>
                  <div class="form-group">
                    <label>Bank Account</label>
                    <input type="text" value="{{ $data->bank_account }}" placeholder="Bank Account" name="bank_account" class="form-control">
                  </div>

                  <div class="form-group">
                    <label>Bank Account Photo</label>
                    <div style="position: relative; max-width: 128px;">
                      <a href="javascript:;" class="upload-now">
                        <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($data->bank_account_photo) || empty($data->bank_account_photo)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$data->bank_account_photo) }}" class="card-img-top img-fluid image-preview">
                      </a>
                      <a href="javascript:;"  class="remove-image-single">
                        <i class="fa fa-times"></i>
                      </a>
                      <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
                      <input type="hidden" name="bank_account_photo" value="{{ $data->bank_account_photo }}" class="image-path">
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Photo</label>
                    <div style="position: relative; max-width: 128px;">
                      <a href="javascript:;" class="upload-now">
                        <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($data->photo) || empty($data->photo)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$data->photo) }}" class="card-img-top img-fluid image-preview">
                      </a>
                      <a href="javascript:;"  class="remove-image-single">
                        <i class="fa fa-times"></i>
                      </a>
                      <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
                      <input type="hidden" name="photo" value="{{ $data->photo }}" class="image-path">
                    </div>
                  </div>
                  <div class="form-group" >
                    <label>Card ID (KTP/SIM)</label>
                    <div style="position: relative; max-width: 128px;">
                      <a href="javascript:;" class="upload-now">
                        <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($data->card_id) || empty($data->card_id)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$data->card_id) }}" class="card-img-top img-fluid image-preview">
                      </a>
                      <a href="javascript:;" class="remove-image-single">
                        <i class="fa fa-times"></i>
                      </a>
                      <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
                      <input type="hidden" name="card_id" value="{{ $data->card_id }}" class="image-path">
                    </div>
                  </div>

                  <div class="form-group" >
                    <label>Selfie With Card ID</label>
                    <div style="position: relative; max-width: 128px;">
                      <a href="javascript:;" class="upload-now">
                        <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($data->selfie_with_card_id) || empty($data->selfie_with_card_id)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$data->selfie_with_card_id) }}" class="card-img-top img-fluid image-preview">
                      </a>
                      <a href="javascript:;"  class="remove-image-single">
                        <i class="fa fa-times"></i>
                      </a>
                      <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
                      <input type="hidden" name="selfie_with_card_id" value="{{ $data->selfie_with_card_id }}" class="image-path">
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Status</label> 
                    <div>
                      <input type="hidden" name="status" value="0">
                      <input type="checkbox" class="js-switch" name="status" value="1" {{ (bool)$data->status ?  'checked' : ''}} />
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-4 col-sm-offset-2">
                      <button class="btn btn-primary btn-sm" name="submit" value="submit" type="submit">Save</button>
                      <button class="btn btn-primary btn-sm" name="submit" value="submit_exit" type="submit">Save & Exit</button>
                      <a href="{{ route('admin.owners') }}" class="btn btn-danger btn-sm" >Cancel</a>
                    </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop


@section('script')
@parent

<script type="text/javascript">

  var elem = document.querySelector('.js-switch');
  var switchery = new Switchery(elem, { color: '#1AB394' });
  var uploadPath = "{{ route('public.upload', array('config'=> 'master.rooms.owners')).'/'.date('Y/m/d').'/file/file' }}"
  var bank = {!! json_encode($bank) !!}

  async function initSelect2(selector, collection) {
    var action = new Promise((resolve, error) => {
      var data =  $(selector).select2({
        placeholder: "Select Option",
        data: collection,
      });
      resolve(data)
    });
    return await action;
  }

  $(document).ready(function() {
    initSelect2('.select-bank', bank).then((result) => {
      result.val("{{ $data->bank_code }}").trigger('change');
      result.on('select2:select', function (e) {
        var data = e.params.data;
        $('.select-name').val(data.text)
      });
    });
  });
</script>
@stop