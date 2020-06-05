@extends('theme.admin.layouts.blank')

@section('content')
<form style="display: none;" id="upload-picture">@csrf</form>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('customers.create') }}
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
                    <input required="" data-error="Please enter name" type="text" value="{{ $data->name }}" placeholder="Name"  name="name" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div>
                  <div class="form-group">
                    <label>Email <span class="required">*</span></label> 
                    <input required="" data-error="Please enter email" type="email" value="{{ $data->email }}" placeholder="Email"  name="email" class="form-control">
                    <div class="help-block with-errors error">
                      @if ($errors->has('email')) 
                      {{ $errors->first('email') }}
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Phone <span class="required">*</span></label> 
                    <input required="" data-error="Please enter phone" type="tel" value="{{ $data->phone }}" placeholder="Phone"  name="phone" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div>
                  @if($method == 'create')
                  <div class="form-group">
                    <label>Password<span class="required">*</span></label>
                    <input required="" data-minlength="6" id="password" data-error="Please enter password and minimal 6 character" type="password" value="" placeholder="Password"  name="password" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div> 
                  <div class="form-group">
                    <label>Confirm Password<span class="required">*</span></label>
                    <input required="" data-match="#password" data-match-error="Password don't match" type="password" value="" placeholder="Password"  name="password_confirmation" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div>
                  @else
                  <fieldset class="well">
                    <legend class="well-legend text-primary">Please don't change the password if not important !!!</legend>
                    <div class="form-group">
                      <label>Password<span class="required">*</span></label>
                      <input  id="password" data-error="Please enter password and minimal 6 character" type="password" value="" placeholder="Password"  name="password" class="form-control">
                      <div class="help-block with-errors error">
                        @if ($errors->has('password')) 
                        {{ $errors->first('password') }}
                        @endif
                      </div>
                    </div> 
                    <div class="form-group">
                      <label>Confirm Password<span class="required">*</span></label>
                      <input data-match="#password" data-match-error="Password don't match" type="password" value="" placeholder="Password"  name="password_confirmation" class="form-control">
                      <div class="help-block with-errors error"></div>
                    </div>
                  </fieldset>
                  @endif

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
                      <a href="{{ route('admin.customers') }}" class="btn btn-danger btn-sm" >Cancel</a>
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
<style type="text/css">
  fieldset {
  min-width: 0;
  padding: 0;
  margin: 0;
  border: 0;
}
.well {
  min-height: 20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #f5f5f5;
  border: 1px solid #e3e3e3;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
}
.well-legend {
  display: block;
  font-size: 14px;
  width: auto;
  padding: 2px 7px 2px 5px;
  margin-bottom: 5px;
  line-height: inherit;
  color: #333;
  background: #fff;
  border: 1px solid #e3e3e3;
  border-radius: 4px;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .05);
}
</style>
<script type="text/javascript">
  var elem = document.querySelector('.js-switch');
  var switchery = new Switchery(elem, { color: '#1AB394' });
  var uploadPath = "{{ route('public.upload', array('config'=> 'master.customers')).'/'.date('Y/m/d').'/file/file' }}";
</script>
@stop