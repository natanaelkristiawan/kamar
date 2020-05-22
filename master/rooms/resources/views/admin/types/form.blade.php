@extends('theme.admin.layouts.blank')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('types.create') }}
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
                    <label>Featured</label> 
                    <div>
                      <input type="hidden" name="is_featured" value="0">
                      <input type="checkbox" class="js-switch" name="is_featured" value="1" {{ (bool)$data->is_featured ?  'checked' : ''}} />
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
                      <a href="{{ route('admin.types') }}" class="btn btn-danger btn-sm" >Cancel</a>
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

  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
  elems.forEach(function(html) {
    var switchery = new Switchery(html, { color: '#1AB394' });
  });

  $(document).ready(function(){
    $('#name').on('keyup', function(){
      var name = $(this).val();
      var slug = slugify(name);
      $('#slug').val(slug);
    });
  });
</script>
@stop