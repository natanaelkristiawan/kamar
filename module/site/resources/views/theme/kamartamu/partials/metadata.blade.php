<meta charset="utf-8" />
<meta name="author" content="www.natanaelkristiawan.com" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>{!! Meta::get('title') !!}</title>
<script type="text/javascript">
    var TOKEN = {'_token' : "{{ csrf_token() }}"};
</script>
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
  #back2Top {
    bottom: 85px !important;
  }
  footer {
    z-index: 0 !important;
  }

  #loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background-color: rgba(0,0,0,0.8);
    z-index: 1000000000000000000;
  }


  .lds-ripple {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }
  .lds-ripple div {
    position: absolute;
    border: 4px solid #fff;
    opacity: 1;
    border-radius: 50%;
    animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
  }
  .lds-ripple div:nth-child(2) {
    animation-delay: -0.5s;
  }
  @keyframes lds-ripple {
    0% {
      top: 36px;
      left: 36px;
      width: 0;
      height: 0;
      opacity: 1;
    }
    100% {
      top: 0px;
      left: 0px;
      width: 72px;
      height: 72px;
      opacity: 0;
    }
  }

  .please-wait {
    transform: translate(-50%, 0%);
    color: white;
    position: absolute;
    left: 50%;
    top: 57%;
    width: 100%;
    text-align: center;
    font-weight: bold;
    letter-spacing: 5px;
  }
  .hide-in-mobile {
    display: none !important;
  }

  @media screen and (max-width: 992px) {
    #rightmenu {
      display: none !important;
    }

   .hide-in-mobile {
    display: block !important;
    }

  }
  .modal-open{
    padding-right: 0px !important;
  }
  .error {
    color: #e74c3c
  }

  .room-wrap .select2-selection.select2-selection--single {
    margin: 10px 0px;
  }
  .room-wrap .select2-selection__arrow{
    margin-top: 10px;
  }

  .room-wrap .select2.select2-container.select2-container--default{
    border:2px solid #e6eaf3;
    color: #707e9c,
    background-color:rgb(230, 234, 243);
    border-radius: 3px;
  } 
</style>

@section('style')
@show