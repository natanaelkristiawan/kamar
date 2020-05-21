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


<link rel="stylesheet" href="https://unpkg.com/responsive-lazyload/dist/responsive-lazyload.min.css">
<style>

  /*
   * Add a loading animation to lazyloaded images.
   */
  .js--lazyload--loading::before,.js--lazyload--loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: block;
    width: 60px;
    height: 60px;
    background-color: #BBBBBB;
    border: 2px solid #BBBBBB;
    border-radius: 50%;
    opacity: 0;
    z-index: 1;
  }

  .js--lazyload::before {
    animation: loading 2s linear 0s infinite;
  }

  .js--lazyload::after {
    animation: loading 2s linear -1s infinite;
  }

  @keyframes loading {
    0% {
      background-color: rgba(175, 175, 175, 0.95);
      transform: translate(-50%, -50%) scale(0.1);
      opacity: 1;
    }

    60% {
      background-color: rgba(175, 175, 175, 0.5);
    }

    100% {
      background-color: rgba(175, 175, 175, 0);
      transform: translate(-50%, -50%) scale(1);
      opacity: 0;
    }
  }

  .js--lazyload img {
    object-fit: cover;
  }
  .js--lazyload--loading img {
    opacity: 1 !important
  }

  .js--lazyload {
    background-color: white !important;
  }

  /*
   * NOTE: It’d probably be wise to hide the animation if JS is disabled.
   * To do this, add a `no-js` class to the body element and remove it with
   * JS once the DOM is ready, then uncomment this rule.
   * /
  /**/
  .js--lazyload {
     border-radius: .25rem!important
  }

  .js--lazyload:not(img) {
    height: 0;
    padding-bottom: 100% !important;
  }
  @media (min-width: 992px){
    .js--lazyload:not(img) {
      padding-bottom: 50vw !important;
    }
  }

</style>