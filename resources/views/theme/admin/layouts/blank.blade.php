<!DOCTYPE html>
<html lang="en">
  <head>
    @include('theme.admin.partials.metadata')
  </head>
  <body>
    <!-- Begin page -->
    <div id="wrapper">
      @include('theme.admin.partials.header')
      @include('theme.admin.partials.sidebar')
      <div class="content-page">
        @yield('content')
        @include('theme.admin.partials.copyright')
      </div>
    </div>
    <!-- END wrapper -->
    @include('theme.admin.partials.modal')
    @include('theme.admin.partials.footer')
  </body>

</html>