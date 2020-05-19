@extends('theme.admin.layouts.blank')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('site') }}
        </div>
      </div>
    </div>
      <!-- end row -->

    <div class="page-content-wrapper">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <form style="display: none;" id="upload-picture">@csrf</form>
            <form role="form" method="POST" action="">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <h4 class="mt-0 header-title">Site Setting</h4>
                  </div>
                  <div class="col-lg-6 text-right">
                    <button type="submit" class="btn btn-sm btn-primary" id="submit-button">Save</button>
                    <a href="{{ route('admin.site') }}" class="btn btn-sm btn-neutral">Reset</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 mt-5"> 
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#main" role="tab">Main</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#our-mission" role="tab">Our Mission</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#partners" role="tab">Partners</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#privacy-policy" role="tab">Privacy & Policy</a>
                      </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div class="tab-pane p-3" id="main" role="tabpanel">
                        @include('site::admin.site.partials.main')
                      </div>
                      <div class="tab-pane p-3" id="our-mission" role="tabpanel">
                        @include('site::admin.site.partials.ourmission')
                      </div>
                      <div class="tab-pane p-3 active" id="partners" role="tabpanel">
                        @include('site::admin.site.partials.partners')
                      </div>
                      <div class="tab-pane p-3" id="privacy-policy" role="tabpanel">
                        @include('site::admin.site.partials.privacypolicy')
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- end page content-->

  </div> <!-- container-fluid -->

</div> <!-- content -->


@stop
@section('script')
@parent
<link href="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.css" type="text/css" rel="stylesheet" />
<script src="//cdn.jsdelivr.net/npm/featherlight@1.7.14/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('themes/additionals') }}/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css">
<script type="text/javascript" src="{{ asset('themes/additionals') }}/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js"></script>
<script type="text/javascript">
  var uploadPath = "{{ route('public.upload', array('config'=> 'module.site')).'/'.date('Y/m/d').'/site/file' }}"
  $('.textarea').summernote({
    tabsize: 2,
    height: 300,
    callbacks: {
      onImageUpload: function(files) {
        sendFile(files[0], $(this), "{{ url(env('ADMIN_URL', 'admin').'/upload/'.'module.site/'.date('Y/m/d').'/site/file') }}");
      }
    }
  });
</script>
@stop