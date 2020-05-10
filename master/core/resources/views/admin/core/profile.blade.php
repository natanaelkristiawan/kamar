@extends('theme.admin.layouts.blank')

@section('content')
<form style="display: none;" id="upload-picture">@csrf</form>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('profile') }}
        </div>
      </div>
    </div>
      <!-- end row -->

    <div class="page-content-wrapper">
      <div class="row">
        <div class="col-lg-3">
          <!-- Simple card -->
          <div class="card m-b-30">
            <a href="javascript:;" id="upload-now">
              <img alt="Card image cap" src="{{ is_null($data->photo) ? asset('template/argon/assets/img/theme/team-4.jpg') : url('image/profile/'.$data->photo) }}" class="card-img-top img-fluid profile-pic">
            </a>
            <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
            <div class="card-body text-center">
                <h4 class="card-title font-16 mt-0">Detail Account</h4>
                <div class="card-text">
                  <p class="m-t-0 mb-1">{{ $data->name }}</p>
                  <p class="m-t-0 mb-1">{{ $data->email }}</p>
                  <p class="m-t-0 mb-1">{{ date('d F Y', strtotime($data->created_at)) }}</p>
                </div>
            </div>
          </div>
        </div><!-- end col -->
        <div class="col-lg-9">
          <div class="card mb-4">

            <!-- Card body -->
            <div class="card-body">
              <h4 class="card-title font-16 mt-0">Profile</h4>
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
                <div class="col-lg-4 col-sm-offset-2">
                  <button class="btn btn-danger" name="submit" value="submit" type="submit">Save</button>
                </div>
              </div>
              </form>
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