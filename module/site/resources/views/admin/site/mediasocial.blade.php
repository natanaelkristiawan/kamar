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
                    <h4 class="mt-0 header-title">Media Social</h4>
                  </div>
                  <div class="col-lg-6 text-right">
                    <button type="submit" class="btn btn-sm btn-primary" id="submit-button">Save</button>
                    <a href="{{ route('admin.site') }}" class="btn btn-sm btn-neutral">Reset</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label>Facebook</label> 
                      <input type="text" placeholder="Facebook" value="{{ $facebook }}" name="media_facebook" class="form-control">
                    </div> 
                    <div class="form-group">
                      <label>Instagram</label> 
                      <input type="text" placeholder="Instagram" value="{{ $instagram }}" name="media_instagram" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Twitter</label> 
                      <input type="text" placeholder="Twitter" value="{{ $twitter }}" name="media_twitter" class="form-control">
                    </div>
                    <div class="form-group">
                      <label>Linkedin</label> 
                      <input type="text" placeholder="Linkedin" value="{{ $linkedin }}" name="media_linkedin" class="form-control">
                    </div>
                  </div>
                </div> 
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop