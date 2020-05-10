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
        <div class="col-lg-3 order-lg-2">
          <!-- Simple card -->
          <div class="card m-b-30">
            <a href="javascript:;" id="upload-now">
              <img alt="Card image cap" src="{{ (is_null($data->photo) || empty($data->photo)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$data->photo) }}" class="card-img-top img-fluid photo-pic">
            </a>
            <a href="javascript:;" onclick="$('.photo-path').val(); $('.file-upload').val(''); $('.photo-pic').attr('src', 'https://via.placeholder.com/360x360')" class="remove-image-single">
              <i class="fa fa-times"></i>
            </a>
            <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
            <div class="card-body">
                <div class="card-text">
                  <form role="form" method="POST" action="" data-toggle="validator" role="form" data-disable="false">
                  @csrf
                    <input type="hidden" name="photo" value="{{ $data->photo }}" class="photo-path">
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
                      <label>Status</label> 
                      <div>
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" class="js-switch" name="status" value="1" {{ (bool)$data->status ?  'checked' : ''}} />
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12 col-sm-offset-2">
                        <button class="btn btn-primary btn-sm" name="submit" value="submit" type="submit">Save</button>
                        <button class="btn btn-primary btn-sm" name="submit" value="submit_exit" type="submit">Save & Exit</button>
                        <a href="{{ route('admin.owners') }}" class="btn btn-danger btn-sm" >Cancel</a>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
          </div>
        </div><!-- end col -->
        <div class="col-lg-9 order-lg-1">
          <div class="card mb-4">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <h4 class="mt-0 header-title">Properties</h4>
                </div>
                <div class="col-lg-6 text-right">
                  <a href="javascript:;" class="btn btn-sm btn-primary">New</a>
                  <button type="button" data-toggle="modal" data-target="#modal-filter" class="btn btn-sm btn-neutral">Filter</button>
                </div>
              </div>
              @include('rooms::admin.owners.partials.table-properties')


            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- container-fluid -->

</div> <!-- content -->
@stop


@section('script')
@parent

<script type="text/javascript">

  var elem = document.querySelector('.js-switch');
  var switchery = new Switchery(elem, { color: '#1AB394' });


  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.readAsDataURL(input.files[0]);

      var formData = new FormData($('#upload-picture')[0]);
      var real = $('.file-upload').prop('files')[0];
      formData.append('file', real);

      $.ajax({
        url: "{{ route('public.upload', array('config'=> 'master.rooms.owners')).'/'.date('Y/m/d').'/file/file' }}",   
        data : formData,
        dataType : 'json',
        type : 'post',
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,
        success : function(result){
          $('.photo-pic').attr('src', "{{ url('image/profile/') }}/"+result.path);
          $('.photo-path').val(result.path);
        }
      });
    }
  }

  $(".file-upload").change(function() {
    readURL(this);
  });

  $(document).ready(function() {
    $('#upload-now').on('click', function(){
      $('.file-upload').click();
    });
  });
</script>
@stop