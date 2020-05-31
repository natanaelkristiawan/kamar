<!DOCTYPE html>
<html lang="en">
  <head>
    @include('site::theme.kamartamu.partials.metadata')
  </head>
  
  <body class="red-skin">
    <div id="loader" class="hide">
      <div class="lds-ripple">
        <div></div>
        <div></div>
      </div>
      <span class="please-wait">Please Wait</span>
    </div>
    <div id="main-wrapper">
      @include('site::theme.kamartamu.partials.header')
      <div class="clearfix"></div>
      @yield('content')
      @include('site::theme.kamartamu.partials.footer')
      @include('site::theme.kamartamu.partials.modal')
      <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
    </div>
    @include('site::theme.kamartamu.partials.script')
    <!-- START Bootstrap-Cookie-Alert -->
    <div class="alert text-center cookiealert" role="alert">
      <b>Do you like cookies?</b> &#x1F36A; We use cookies to ensure you get the best experience on our website. <a href="https://cookiesandyou.com/" target="_blank">Learn more</a>
      <button type="button" class="btn btn-primary btn-sm acceptcookies">
          I agree
      </button>
    </div>
    <!-- END Bootstrap-Cookie-Alert -->
  </body>
</html>