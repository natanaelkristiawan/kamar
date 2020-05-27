@extends('site::theme.kamartamu.layouts.index')
@section('content')
<!-- ============================ Page Title Start================================== -->
<div class="page-title" style="background:#f4f4f4 url('{{ is_null($article->banners) ? asset('img/assets/hotel-4416515_1920.jpg') : url('image/original/'.$article->banners)  }}');" data-overlay="5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				
				<div class="breadcrumbs-wrap">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ route('public.index') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Blog Detail</li>
					</ol>
					<h2 class="breadcrumb-title">{{ $article->title }}</h2>
				</div>
				
			</div>
		</div>
	</div>
</div>
<!-- ============================ Page Title End ================================== -->

<!-- ============================ Agency List Start ================================== -->
<section class="gray">

	<div class="container">
	
		<!-- row Start -->
		<div class="row">
		
			<!-- Blog Detail -->
			<div class="col-lg-8 col-md-12 col-sm-12 col-12">
				<div class="article_detail_wrapss single_article_wrap format-standard">
					<div class="article_body_wrap">
					
						<div class="article_featured_image">
					   	<a href="{{ url('image/original/'.$article->images) }}"
	              data-href="{{ url('image/original/'.$article->images) }}"
	              data-srcset = "{{ url('image/sm/'.$article->images) }} 300w,
	                            {{ url('image/md/'.$article->images) }} 600w,
	                            {{ url('image/lg/'.$article->images) }} 690w,
	                            {{ url('image/original/'.$article->images) }} 1380w"
	              class="img-fluid progressive replace">
	              <img src="{{ url('image/blur/'.$article->images) }}"  class="preview" >
	            </a>
						</div>
						
						<div class="article_top_info">
							<ul class="article_middle_info">
								<li><a href="#"><span class="icons"><i class="ti-user"></i></span>by kamartamu.com</a></li>
							</ul>
						</div>
						<h2 class="post-title">{{ $article->title }}</h2>
						{!! $article->content !!}
						<div class="single_article_pagination">
							@if($prev)
							<div class="prev-post">
								<a href="{{ route('public.blogDetail', array('slug'=>$prev)) }}" class="theme-bg">
									<div class="title-with-link">
										<span class="intro">Prev Post</span>
									</div>
								</a>
							</div>
							@endif
							<div class="article_pagination_center_grid">
								<a href="{{ route('public.blogs') }}"><i class="ti-layout-grid3"></i></a>
							</div>
							@if($next)
							<div class="next-post">
								<a href="{{ route('public.blogDetail', array('slug'=>$next)) }}" class="theme-bg">
									<div class="title-with-link">
										<span class="intro">Next Post</span>
									</div>
								</a>
							</div>
							@endif
						</div>
						
					</div>
				</div>
				
				
			</div>
			
			<!-- Single blog Grid -->
			<div class="col-lg-4 col-md-12 col-sm-12 col-12">
				<!-- Categories -->
				<div class="single_widgets widget_category">
					<h4 class="title">Categories</h4>
					<ul>
						@foreach($countArticle as $list)
						<li><a href="{{ route('public.blogs', array('category'=>$list->slug)) }}">{{ $list->title }} <span>{{ sprintf("%02d", $list->article_count) }}</span></a></li>
						@endforeach
					</ul>
				</div>
				
				<!-- Trending Posts -->
				<div class="single_widgets widget_thumb_post">
					<h4 class="title">Latest Post</h4>
					<ul>
						@foreach($latesArticle as $list)
						<li>
							<span class="left">
								<a href="{{ route('public.blogDetail', array('slug'=>$list->slug)) }}"
		              data-href="{{ url('image/original/'.$list->images) }}"
		              data-srcset = "{{ url('image/sm/'.$list->images) }} 300w,
		                            {{ url('image/md/'.$list->images) }} 600w,
		                            {{ url('image/lg/'.$list->images) }} 690w,
		                            {{ url('image/original/'.$list->images) }} 1380w"
		              class="img-fluid progressive replace">
		              <img src="{{ url('image/blur/'.$list->images) }}"  class="preview" >
		            </a>
							</span>
							<span class="right">
								<a class="feed-title" href="{{ route('public.blogDetail', array('slug'=>$list->slug)) }}">{{ $list->title }}</a> 
								<span class="post-date"><i class="ti-calendar"></i>{{ date('d F Y', strtotime($list->created_at)) }}</span>
							</span>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
			
		</div>
		<!-- /row -->					
		
	</div>
			
</section>
<!-- ============================ Agency List End ================================== -->

<div class="clearfix"></div>
@include('site::public.partials.signup')
@stop