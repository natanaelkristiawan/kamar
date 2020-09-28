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

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '309946443419029');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=309946443419029&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
  </body>
</html>