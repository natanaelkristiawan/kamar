@extends('theme.admin.layouts.blank')

@section('content')
<form style="display: none;" id="upload-picture">@csrf</form>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('packages.create') }}
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
                    <label>Owner <span class="required">*</span></label>
                    <select class="form-control select-owner" name="owner_id" required="" data-error="Please select owner"></select>
                    <div class="help-block with-errors error"></div>
                  </div>

                  <div class="form-group">
                    <label>Total Quota <span class="required">*</span></label>
                    <input required="" data-error="Please enter total quota" type="text" value="{{ $data->total_quota }}" placeholder="Total Quota"  name="total_quota" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div> 

                  <div class="form-group">
                    <label>Used Quota <span class="required">*</span></label>
                    <input required="" data-error="Please enter used quota" type="text" value="{{ $data->used_quota }}" placeholder="Used Quota"  name="used_quota" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div> 

                  <div class="form-group">
                    <label>Remaining Quota <span class="required">*</span></label>
                    <input required="" data-error="Please enter remaining quota" type="text" value="{{ $data->remaining_quota }}" placeholder="Remaining Quota"  name="remaining_quota" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div> 


                  <div class="form-group">
                    <label>Bitly Link <span class="required">*</span></label>
                    <input required="" data-error="Please enter bitly link" type="text" value="{{ $data->bitly }}" placeholder="Bitly Link"  name="bitly" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div>


                  <div class="form-group">
                    <label>Date Start <span class="required">*</span></label>
                    <input required="" data-error="Please enter date start" type="text" value="{{ $data->date_start }}" placeholder="Date Start"  name="date_start" class="form-control datepicker">
                    <div class="help-block with-errors error"></div>
                  </div>

                  <div class="form-group">
                    <label>Date End <span class="required">*</span></label>
                    <input required="" data-error="Please enter date end" type="text" value="{{ $data->date_end }}" placeholder="Date End"  name="date_end" class="form-control datepicker">
                    <div class="help-block with-errors error"></div>
                  </div>

                  <div class="form-group row">
                    <div class="col-lg-4 col-sm-offset-2">
                      <button class="btn btn-primary btn-sm" name="submit" value="submit" type="submit">Save</button>
                      <button class="btn btn-primary btn-sm" name="submit" value="submit_exit" type="submit">Save & Exit</button>
                      <a href="{{ route('admin.packages') }}" class="btn btn-danger btn-sm" >Cancel</a>
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

  $(document).ready(function(){
    var owners = {!! json_encode($owners) !!}


    initSelect2('.select-owner', owners).then((result) => {
      result.val("{{ $data->owner_id }}").trigger('change');
    });

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose : true,
        startDate: new Date(),
        clearBtn: true
      })


  })

</script>
@stop