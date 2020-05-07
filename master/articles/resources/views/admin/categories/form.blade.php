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
            {{ Breadcrumbs::render('categories.create') }}
            @else
            {{ Breadcrumbs::render('categories.edit') }}
            @endif
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-neutral">New</a>
          <a href="{{ route('admin.categories') }}" class="btn btn-sm btn-danger">Close</a>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="container-fluid mt--6">
  <div class="card mb-4">
    <!-- Card header -->
    <div class="card-header">
      <h3 class="mb-0">Form</h3>
    </div>
    <!-- Card body -->
    <div class="card-body">
      <form role="form" method="POST" action="" data-toggle="validator" role="form" data-disable="false">
      @csrf
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
          <label>Status</label> 
          <div class="form-control-label">
            <input type="hidden" name="status" value="0">
            <input type="checkbox" class="js-switch" name="status" value="1" {{ (bool)$data->status ?  'checked' : ''}} />
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-4 col-sm-offset-2">
            <button class="btn btn-primary btn-sm" name="submit" value="submit" type="submit">Save</button>
            <button class="btn btn-primary btn-sm" name="submit" value="submit_exit" type="submit">Save & Exit</button>
            <a href="{{ route('admin.categories') }}" class="btn btn-danger btn-sm" >Cancel</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- Footer -->
  @include('theme.admin.partials.copyright')
</div>
@stop


@section('script')
@parent
<script type="text/javascript">

  var elem = document.querySelector('.js-switch');
  var switchery = new Switchery(elem, { color: '#1AB394' });

  $(document).ready(function(){
    $('#title').on('keyup', function(){
      var title = $(this).val();
      var slug = slugify(title);
      $('#slug').val(slug);
    });
  });


</script>
@stop