@extends('theme.admin.layouts.blank')

@section('content')
<form style="display: none;" id="upload-picture">@csrf</form>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('ameneties.create') }}
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
                    <input required="" data-error="Please enter name" type="text" value="{{ $data->name }}" placeholder="Name" id="name" name="name" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div>
                  <div class="form-group">
                    <label>Slug <span class="required">*</span></label> 
                    <input required="" data-error="Please enter slug" type="text" value="{{ $data->slug }}" placeholder="Slug" id="slug" name="slug" class="form-control">
                    <div class="help-block with-errors error"></div>
                  </div>

                   <div class="form-group">
                    <label>Icon</label>
                    <div style="position: relative; max-width: 128px;">
                      <a href="javascript:;" id="upload-now">
                        <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($data->icon) || empty($data->icon)) ? 'https://via.placeholder.com/128x128' : url('image/profile/'.$data->icon) }}" class="card-img-top img-fluid icon-pic">
                      </a>
                      <a href="javascript:;" onclick="$('.icon-path').val(); $('.file-upload').val(''); $('.icon-pic').attr('src', 'https://via.placeholder.com/128x128')" class="remove-image">
                        <i class="fa fa-times"></i>
                      </a>
                      <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
                      <input type="hidden" name="icon" class="icon-path">
                    </div>
                     
                  </div>

                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#content-id" role="tab">ID</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#content-en" role="tab">EN</a>
                    </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div class="tab-pane active p-3" id="content-id" role="tabpanel">
                       <div class="form-group">
                        <label>Content</label> 
                        <input type="text" value="{{ (bool)count((array)$data->content) ? $data->content['id'] : '' }}" placeholder="Content" name="content[id]" class="form-control">
                      </div>
                    </div>
                    <div class="tab-pane p-3" id="content-en" role="tabpanel">
                       <div class="form-group">
                        <label>Content</label> 
                        <input type="text" value="{{ (bool)count((array)$data->content) ? $data->content['en'] : '' }}" placeholder="Content" name="content[en]" class="form-control">
                      </div>
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
                    <div class="col-sm-4 col-sm-offset-2">
                      <button class="btn btn-primary btn-sm" name="submit" value="submit" type="submit">Save</button>
                      <button class="btn btn-primary btn-sm" name="submit" value="submit_exit" type="submit">Save & Exit</button>
                      <a href="{{ route('admin.ameneties') }}" class="btn btn-danger btn-sm" >Cancel</a>
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
  .remove-image {
    display: inline-block;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    box-shadow: 0 14px 26px -12px rgba(0, 188, 212, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 188, 212, 0.2);
    background-color: #00bcd4;
    color: #fff;
    text-align: center;
    font-size: 12px;
    line-height: 20px;
    opacity: 1;
    background-color: #f44336;
    box-shadow: 0 12px 20px -10px rgba(244, 67, 54, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(244, 67, 54, 0.2);
    position: absolute;top: -10px;right: -10px
  }
</style>

<script type="text/javascript">

  var elem = document.querySelector('.js-switch');
  var switchery = new Switchery(elem, { color: '#1AB394' });

  $(document).ready(function(){
    $('#name').on('keyup', function(){
      var name = $(this).val();
      var slug = slugify(name);
      $('#slug').val(slug);
    });
  });


   function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.readAsDataURL(input.files[0]);

      var formData = new FormData($('#upload-picture')[0]);
      var real = $('.file-upload').prop('files')[0];
      formData.append('file', real);

      $.ajax({
        url: "{{ route('public.upload', array('config'=> 'master.rooms.ameneties')).'/'.date('Y/m/d').'/file/file' }}",   
        data : formData,
        dataType : 'json',
        type : 'post',
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,
        success : function(result){
          $('.icon-pic').attr('src', "{{ url('image/profile/') }}/"+result.path);
          $('.icon-path').val(result.path);
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