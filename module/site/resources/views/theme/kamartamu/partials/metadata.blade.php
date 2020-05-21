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


<!-- Custom CSS -->
<link href="{{ asset('themes/landing') }}/assets/css/styles.css" rel="stylesheet">
<!-- Custom Color Option -->
<link href="{{ asset('themes/landing') }}/assets/css/colors.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('themes/vertical') }}/assets/icons/fontawesome/css/fontawesome-all.css">


@section('style')
@show