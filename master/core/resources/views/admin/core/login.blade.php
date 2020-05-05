@extends('theme.admin.layouts.login')

@section('content')

<form role="form" method="POST" role="form" action="{{ route('admin.login') }}">
  @csrf
  <div class="form-group mb-3">
    <div class="input-group input-group-merge input-group-alternative">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
      </div>
      <input class="form-control" name="email" required="" placeholder="Email" type="email">
    </div>
  </div>
  <div class="form-group">
    <div class="input-group input-group-merge input-group-alternative">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
      </div>
      <input class="form-control" name="password" required="" placeholder="Password" type="password">
    </div>
  </div>
  <div class="custom-control custom-control-alternative custom-checkbox">
    <input class="custom-control-input" name="remember" value="0" type="hidden">
    <input class="custom-control-input" name="remember" value="0" id=" customCheckLogin" type="checkbox">
    <label class="custom-control-label" for=" customCheckLogin">
      <span class="text-muted">Remember me</span>
    </label>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-primary my-4">Sign in</button>
  </div>
</form>
@stop