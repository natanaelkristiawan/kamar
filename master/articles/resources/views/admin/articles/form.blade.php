@extends('theme.admin.layouts.blank')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">{!! Meta::get('title') !!}</h4>
          {{ Breadcrumbs::render('articles.create') }}
        </div>
      </div>
    </div>
    <!-- end row -->
    <form style="display: none;" id="upload-picture">@csrf</form>
    <form role="form" method="POST" action="" data-toggle="validator" role="form" data-disable="false">
      @csrf
      <div class="page-content-wrapper">
        <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h4 class="mt-0 header-title">Data</h4>
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
                  <div class="form-group" style="display: none">
                    <label>Order</label> 
                    <input type="number" data-error="Please enter order"  placeholder="Order" value="0" name="order" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Category</label>
                    <select name="category_id[]" data-placeholder="Choose a Category..." multiple class="chosen-select" tabindex="4">
                      @foreach($categories as $category)
                      <option {{ (bool)in_array($category->id, $data->category_id) ? 'selected' : '' }}  value="{{ $category->id }}">{{ $category->title }}</option>
                      @endforeach
                    </select>
                    
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
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">

                  <h4 class="mt-0 header-title">Metadata</h4>
                  <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item ">
                        <a class="nav-link active" data-toggle="tab" href="#metadata-id" role="tab">ID</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#metadata-en" role="tab">EN</a>
                      </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div class="tab-pane p-3 active" id="metadata-id" role="tabpanel">
                     <div class="form-group">
                        <label>Meta Title</label> 
                        <input type="text" placeholder="Meta Title" name="meta[id][title]" value="{{ (bool)count((array)$data->meta) ? $data->meta['id']['title'] : ''}}" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Meta Tag</label>
                        <input  type="text" placeholder="Meta Tag" value="{{ (bool)count((array)$data->meta) ? $data->meta['id']['tag'] : ''}}" name="meta[id][tag]" class="form-control tagsinput">
                      </div>
                      <div class="form-group">
                        <label>Meta Description</label>
                        <textarea class="form-control" rows="5" name="meta[id][description]">{{ (bool)count((array)$data->meta) ? $data->meta['id']['description'] : ''}}</textarea>
                      </div>
                    </div>
                    <div class="tab-pane p-3" id="metadata-en" role="tabpanel">
                      <div class="form-group">
                        <label>Meta Title</label> 
                        <input type="text" placeholder="Meta Title" name="meta[en][title]" value="{{ (bool)count((array)$data->meta) ? $data->meta['en']['title'] : ''}}" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Meta Tag</label>
                        <input  type="text" placeholder="Meta Tag" value="{{ (bool)count((array)$data->meta) ? $data->meta['en']['tag'] : ''}}" name="meta[en][tag]" class="form-control tagsinput">
                      </div>
                      <div class="form-group">
                        <label>Meta Description</label>
                        <textarea class="form-control" rows="5" name="meta[en][description]">{{ (bool)count((array)$data->meta) ? $data->meta['en']['description'] : ''}}</textarea>
                      </div>
                    </div>
                  </div>

              </div>
              </div>
            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="mt-0 header-title">Images</h4>
                  <div class="form-group" >
                    <label>Photo Profile</label>
                    <div style="position: relative; width: 128px;">
                      <div class="lds-dual-ring hide"></div>
                      <a href="javascript:;" class="upload-now">
                        <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($data->images) || empty($data->images)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$data->images) }}" class="card-img-top img-fluid image-preview">
                      </a>
                      <a href="javascript:;" class="remove-image-single">
                        <i class="fa fa-times"></i>
                      </a>
                      <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
                      <input type="hidden" name="images" value="{{ $data->images }}" class="image-path">
                      <small class="form-text text-muted d-inline-block">Recommended 1280x720</b></small>
                    </div>
                  </div>  

                  <div class="form-group" >
                    <label>Banner</label>
                    <div style="position: relative; width: 128px;">
                      <div class="lds-dual-ring hide"></div>
                      <a href="javascript:;" class="upload-now">
                        <img style="max-width: 128px; border-radius: 5px" alt="Card image cap" src="{{ (is_null($data->banners) || empty($data->banners)) ? 'https://via.placeholder.com/360x360' : url('image/profile/'.$data->banners) }}" class="card-img-top img-fluid image-preview">
                      </a>
                      <a href="javascript:;" class="remove-image-single">
                        <i class="fa fa-times"></i>
                      </a>
                      <input accept="image/x-png,image/gif,image/jpeg"  type="file" class="file-upload" name="file" style="display:none">
                      <input type="hidden" name="banners" value="{{ $data->banners }}" class="image-path">
                      <small class="form-text text-muted d-inline-block">Recommended 1280x720</b></small>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="mt-0 header-title">Content</h4>
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
                        <label>Title</label> 
                        <input type="text" placeholder="Title" name="title[id]" value="{{ (bool)count((array)$data->title) ? $data->title['id'] : ''}}" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Abstract</label>
                        <textarea name="abstract[id]" class="textarea form-control">{{ (bool)count((array)$data->abstract) ? $data->abstract['id'] : '' }}</textarea>
                      </div>
                      <div class="form-group">
                        <label>Article</label>
                        <textarea name="content[id]" class="textarea form-control">{{ (bool)count((array)$data->content) ? $data->content['id'] : '' }}</textarea>
                      </div>
                    </div>
                    <div class="tab-pane p-3" id="content-en" role="tabpanel">
                      <div class="form-group">
                        <label>Title</label> 
                        <input type="text" placeholder="Title" name="title[en]" value="{{ (bool)count((array)$data->title) ? $data->title['en'] : ''}}" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Abstract</label>
                        <textarea name="abstract[en]" class="textarea form-control">{{ (bool)count((array)$data->abstract) ? $data->abstract['en'] : '' }}</textarea>
                      </div>


                      <div class="form-group">
                        <label>Article</label>
                        <textarea name="content[en]" class="textarea form-control">{{ (bool)count((array)$data->content) ? $data->content['en'] : '' }}</textarea>
                      </div>
                    </div>
    
                  </div>
                  <div class="hr-line-dashed"></div>
                  <div class="form-group row">
                    <div class="col-lg-4 col-sm-offset-2">
                      <button class="btn btn-primary btn-sm" name="submit" value="submit" type="submit">Save</button>
                      <button class="btn btn-primary btn-sm" name="submit" value="submit_exit" type="submit">Save & Exit</button>
                      <a href="{{ route('admin.articles') }}" class="btn btn-danger btn-sm" >Cancel</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        </div>
      </div>
    </form>
  </div>
</div>
@stop


@section('script')
@parent
<script type="text/javascript">
  var uploadPath = "{{ route('public.upload', array('config'=> 'master.articles')).'/'.date('Y/m/d').'/articles/file' }}"
  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
  elems.forEach(function(html) {
    var switchery = new Switchery(html, { color: '#1AB394' });
  });

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
    $('#name').on('keyup', function(){
      var name = $(this).val();
      var slug = slugify(name);
      $('#slug').val(slug);
    });
  });


</script>
@stop