<meta charset="utf-8" />
<meta name="author" content="www.frebsite.nl" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{!! Meta::get('title') !!}</title>

{!! Meta::tag('robots') !!}

{!! Meta::tag('site_name', 'kamartamu.com') !!}
{!! Meta::tag('url', Request::url()); !!}
{!! Meta::tag('locale', App::getLocale() ) !!}

{!! Meta::tag('title') !!}
{!! Meta::tag('description') !!}
{!! Meta::tag('keywords') !!}

<style type="text/css">
  .red-skin {
    opacity: 0;
  }
</style>

<!-- Custom CSS -->
<link href="{{ asset('themes/landing') }}/assets/css/styles.min.css" rel="preload">
<link rel="stylesheet" href="{{ asset('themes/landing') }}/assets/css/styles.min.css" media="print" onload="this.media='all'">

<!-- Custom Color Option -->
<link href="{{ asset('themes/landing') }}/assets/css/colors.min.css" rel="preload">
<link rel="stylesheet" href="{{ asset('themes/landing') }}/assets/css/colors.min.css" media="print" onload="this.media='all'">


<style type="text/css">
  .property_gallery_slide-thumb:before {
    z-index: 0 !important;
  } 
  .property_gallery_slide-thumb a::before {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    display: block;
    z-index: 1;
    opacity: .15;
    background: linear-gradient(to bottom,transparent 5%,#1e2a4c);
  }
</style>

@section('style')
@show