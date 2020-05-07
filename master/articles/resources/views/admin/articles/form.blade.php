@extends('theme.admin.layouts.blank')

@section('content')
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">{!! Meta::get('title') !!}</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
           @if($method == 'create')
            {{ Breadcrumbs::render('articles.create') }}
            @else
            {{ Breadcrumbs::render('articles.edit') }}
            @endif
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="{{ route('admin.articles.create') }}" class="btn btn-sm btn-neutral">New</a>
          <a href="{{ route('admin.articles') }}" class="btn btn-sm btn-danger">Close</a>
        </div>
      </div>
    </div>
  </div>
</div>


<form role="form" method="POST" action="" data-toggle="validator" role="form" data-disable="false">
  @csrf
  <div class="container-fluid mt--6">
    <div class="row">
      <div class="col-lg-6">
        <div class="card mb-4">
          <!-- Card header -->
          <div class="card-header">
            <h3 class="mb-0">Form</h3>
          </div>
          <!-- Card body -->
          <div class="card-body">

            <div class="form-group">
              <label class="form-control-label">Title <span class="required">*</span></label> 
              <input required="" data-error="Please enter title" type="text" value="{{ $data->title }}" placeholder="Title" id="title" name="title" class="form-control">
              <div class="help-block with-errors error"></div>
            </div>
            <div class="form-group">
              <label class="form-control-label">Slug <span class="required">*</span></label> 
              <input required="" data-error="Please enter slug" type="text" value="{{ $data->slug }}" placeholder="Slug" id="slug" name="slug" class="form-control">
              <div class="help-block with-errors error"></div>
            </div>
            <div class="form-group">
              <label class="form-control-label">Order <span class="required">*</span></label> 
              <input required="" type="number" data-error="Please enter order"  placeholder="Order" value="{{ $data->order }}" name="order" class="form-control">
              <div class="help-block with-errors error"></div>
            </div>
            <div class="form-group">
              <label class="form-control-label">Category</label>
              <select name="category_id[]" data-placeholder="Choose a Category..." multiple class="chosen-select" tabindex="4">
                @foreach($categories as $category)
                <option {{ (bool)in_array($category->id, $data->category_id) ? 'selected' : '' }}  value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
              </select>
              
            </div>
            <div class="form-group">
              <label class="form-control-label">Status</label> 
              <div>
                <input type="hidden" name="status" value="0">
                <input type="checkbox" class="js-switch" name="status" value="1" {{ (bool)$data->status ?  'checked' : ''}} />
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card mb-4">
          <!-- Card header -->
          <div class="card-header">
            <h3 class="mb-0">Metadata</h3>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <div class="form-group">
              <label class="form-control-label">Meta Title</label> 
              <input type="text" placeholder="Meta Title" name="meta[title]" value="{{ (bool)count((array)$data->meta) ? $data->meta['title'] : ''}}" class="form-control">
            </div>
            <div class="form-group">
              <label class="form-control-label">Meta Tag</label>
              <input  type="text" placeholder="Meta Tag" value="{{ (bool)count((array)$data->meta) ? $data->meta['tag'] : ''}}" name="meta[tag]" class="form-control tagsinput">
            </div>
            <div class="form-group">
              <label class="form-control-label">Meta Description</label>
              <textarea class="form-control" rows="5" name="meta[description]">{{ (bool)count((array)$data->meta) ? $data->meta['description'] : ''}}</textarea>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-lg-12">
        <div class="card mb-4">
          <!-- Card header -->
          <div class="card-header">
            <h3 class="mb-0">Images</h3>
          </div>
          <!-- Card body -->
          <div class="card-body">
            <div class="form-group">
              <label class="form-control-label">Banner Desktop</label>
              {!! Upload::setForm('images', 'master.articles', $data->images) !!}
            </div>


            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Banners Desktop</label>
                    {!! Upload::setForm('banners', 'master.articles', $data->banners) !!}
                </div>
              </div>

               <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Banners Mobile</label>
                    {!! Upload::setForm('banners_mobile', 'master.articles', $data->banners_mobile) !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="row">
      <div class="col-lg-12">

        <div class="card mb-4">
          <!-- Card header -->
          <div class="card-header">
            <h3 class="mb-0">Content</h3>
          </div>
          <!-- Card body -->
          <div class="card-body">

            <div class="form-group">
              <label>Abstract</label>
              <textarea name="abstract" class="textarea form-control">{{ $data->abstract }}</textarea>
            </div>


            <div class="form-group">
              <label>Article</label>
              <textarea name="content" class="textarea form-control">{{ $data->content }}</textarea>
            </div>


            <div class="hr-line-dashed"></div>
            <div class="form-group row">
              <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-primary btn-sm" name="submit" value="submit" type="submit">Save</button>
                <button class="btn btn-primary btn-sm" name="submit" value="submit_exit" type="submit">Save & Exit</button>
                <a href="{{ route('admin.articles') }}" class="btn btn-danger btn-sm" >Cancel</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    @include('theme.admin.partials.copyright')
  </div>




</form>
@stop


@section('script')
@parent
<script type="text/javascript">

  var elem = document.querySelector('.js-switch');
  var switchery = new Switchery(elem, { color: '#1AB394' });

  $('.textarea').summernote({
    tabsize: 2,
    height: 300,
    callbacks: {
      onImageUpload: function(files) {
        sendFile(files[0], $(this), "{{ url(env('ADMIN_URL', 'admin').'/upload/'.'master.articles/'.date('Y/m/d').'/articles/file') }}");
      }
    }
  });
  $(document).ready(function(){
    $('#title').on('keyup', function(){
      var title = $(this).val();
      var slug = slugify(title);
      $('#slug').val(slug);
    });
  });


</script>
@stop