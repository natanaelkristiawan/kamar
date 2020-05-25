@extends('site::theme.kamartamu.layouts.index')
@section('content')
<!-- ============================ Page Title Start================================== -->
<div class="page-title" style="background:#f4f4f4 url('{{ asset('img/assets/hotel-4416515_1920.jpg') }}');" data-overlay="5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        
        <div class="breadcrumbs-wrap">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog</li>
          </ol>
          <h2 class="breadcrumb-title">Our Blogs</h2>
        </div>
        
      </div>
    </div>
  </div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Agency List Start ================================== -->
<section class="gray">

  <div class="container">
  
    <div class="row">
      <div class="col text-center">
        <div class="sec-heading center">
          <h2>Latest News</h2>
          <p>We post regulary most powerful articles for help and support.</p>
        </div>
      </div>
    </div>
  
    <!-- row Start -->
    <div class="row">
      
      @foreach($articles as $article)
      <!-- Single blog Grid -->
      <div class="col-lg-4 col-md-6">
        <div class="grid_blog_box">
          <div class="gtid_blog_thumb">
            <a href="{{ url('image/original/'.$article->images) }}"
              data-href="{{ url('image/original/'.$article->images) }}"
              data-srcset = "{{ url('image/sm/'.$article->images) }} 300w,
                            {{ url('image/md/'.$article->images) }} 600w,
                            {{ url('image/lg/'.$article->images) }} 690w,
                            {{ url('image/original/'.$article->images) }} 1380w"
              class="img-fluid progressive replace">
              <img src="{{ url('image/blur/'.$article->images) }}"  class="preview" >
            </a>
            <div class="gtid_blog_info">
              <span class="post-date"><i class="ti-calendar"></i>{{ $article->created_at }}</span>
            </div>
          </div>                
          <div class="blog-body">
            <h4 class="bl-title"><a href="blog-detail.html">{{ $article->title }}</a><span class="latest_new_post">{{ $article->category }}</span></h4>
            {!! $article->abstract !!}
          </div>
        </div>
      </div>
      @endforeach
      
    </div>
    <!-- /row -->

    <!-- Pagination -->
    @include('site::public.general.pagination')     
    
  </div>
      
</section>
<!-- ============================ Agency List End ================================== -->
<div class="clearfix"></div>
@include('site::public.partials.signup')
@stop