<!DOCTYPE html>
<html lang="en">
  <head>
    @include('site::theme.kamartamu.partials.metadata')
  </head>
  
  <body class="red-skin">
    <div class="preloader"></div>
    <div id="main-wrapper">
      @include('site::theme.kamartamu.partials.header')
      <div class="clearfix"></div>
      @yield('content')
      @include('site::theme.kamartamu.partials.footer')
      @include('site::theme.kamartamu.partials.modal')
      <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
    </div>
    @include('site::theme.kamartamu.partials.script')
  </body>
</html>