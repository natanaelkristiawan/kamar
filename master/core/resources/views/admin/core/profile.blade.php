@extends('theme.admin.layouts.blank')

@section('content')
<form style="display: none;" id="upload-picture">@csrf</form>
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{!! Meta::get('title') !!}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
          {{ Breadcrumbs::render('profile') }}
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid mt--6">
  <!-- Table -->
  <div class="row">
    <div class="col-lg-3">
      <div class="card card-profile">
        <img src="{{ asset('template/argon') }}/assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
        <div class="row justify-content-center">
          <div class="col-lg-3 order-lg-2">
            <div class="card-profile-image">
              <a href="javascript:;" id="upload-now">
                <img src="{{ is_null($data->photo) ? asset('template/argon/assets/img/theme/team-4.jpg') : url('image/profile/'.$data->photo) }}" class="rounded-circle profile-pic">
              </a>
              <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
            </div>
          </div>
        </div>

        <div class="card-body mt-6 mb-5 pb-0">
          <div class="text-center">
            <h5 class="h3">
              {{ $data->name }}
            </h5>
            <div class="h5 font-weight-300">
              <i class="ni location_pin mr-2"></i>{{ $data->email }}
            </div>
            <div class="h5 mt-4">
              <i class="ni business_briefcase-24 mr-2"></i>Registered At
            </div>
            <div>
              <i class="ni education_hat mr-2"></i>{{ date('d F Y', strtotime($data->created_at)) }}
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="col-lg-9">
      <div class="card mb-4">
        <!-- Card header -->
        <div class="card-header">
          <h3 class="mb-0">Profile</h3>
        </div>
        <!-- Card body -->
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif
          <form role="form" method="POST" action="" data-toggle="validator" role="form" data-disable="false">
          @csrf
          <div class="form-group">
            <label class="form-control-label">Name <span class="required">*</span></label> 
            <input required="" data-error="Please enter name" type="text" value="{{ $data->name }}" placeholder="Name" name="name" class="form-control">
            <div class="help-block with-errors error"></div>
          </div>
          <div class="form-group">
            <label class="form-control-label">Email</label> 
            <input readonly type="text" value="{{ $data->email }}"class="form-control">
            <div class="help-block with-errors error"></div>
          </div> 

          <div class="form-group">
            <label class="form-control-label">Password</label> 
            <input type="password" name="password" value="" class="form-control">
            <div class="help-block with-errors error"></div>
          </div>
          <div class="form-group row">
            <div class="col-sm-4 col-sm-offset-2">
              <button class="btn btn-danger" name="submit" value="submit" type="submit">Save</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>



  <!-- Footer -->
  </div>
  @include('theme.admin.partials.copyright')
</div>
@stop


@section('script')
@parent

<script type="text/javascript">
  function base64ToBlob(base64, mime) 
  {
    mime = mime || '';
    var sliceSize = 1024;
    var byteChars = atob(base64);
    var byteArrays = [];

    for (var offset = 0, len = byteChars.length; offset < len; offset += sliceSize) {
      var slice = byteChars.slice(offset, offset + sliceSize);

      var byteNumbers = new Array(slice.length);
      for (var i = 0; i < slice.length; i++) {
        byteNumbers[i] = slice.charCodeAt(i);
      }

      var byteArray = new Uint8Array(byteNumbers);

      byteArrays.push(byteArray);
    }


    return new Blob(byteArrays, {type: mime});
  }

  var listdata;

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      


      reader.readAsDataURL(input.files[0]);

      var formData = new FormData($('#upload-picture')[0]);
      var real = $('.file-upload').prop('files')[0];
      formData.append('file', real);

      $.ajax({
        url: "{{ route('public.upload', array('config'=> 'master')).'/'.date('Y').'/'.date('m').'/'.date('d').'/file/file' }}",   
        data : formData,
        dataType : 'json',
        type : 'post',
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,
        success : function(result){
         if (typeof result.path !== 'undefined') {
          $.ajax({
            url : "{{ route('admin.update-profile-picture') }}",
            data: $.extend(false, TOKEN, {photo : result.path}),
            type: 'post',
            dataType: 'json',
            beforeSend: function(){
              $('.profile-pic').attr('src', "{{ url('image/profile/') }}/"+result.path);
            },
            success: function(result){
              if (result.status == true) {
                toastr.success('Update berhasil');
              }
            },
              
          });
         }
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