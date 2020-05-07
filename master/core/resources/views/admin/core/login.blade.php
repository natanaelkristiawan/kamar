@extends('theme.admin.layouts.login')

@section('content')
<form class="form-horizontal m-t-30" method="POST" role="form" action="{{ route('admin.login') }}">
  @csrf
  <div class="form-group">
    <label for="email">Email</label>
    <input name="email" type="text" class="form-control" id="email" placeholder="Enter email">
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Enter password">
  </div>

  <div class="form-group row m-t-20">
    <div class="col-6">
      <div class="custom-control custom-checkbox">
        <input class="custom-control-input" name="remember" value="0" type="hidden">
        <input type="checkbox" name="remember" value="1" class="custom-control-input" id="customControlInline">
        <label class="custom-control-label" for="customControlInline">Remember me</label>
      </div>
    </div>
    <div class="col-6 text-right">
      <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
    </div>
  </div>
</form>
@stop