@extends('layouts.general')

@section('title', 'Login')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/cards.css">
@endsection

@section('content')
  <div class="container after-navbar-lg">
    <div class="row">
      <div class="col-md-3 col-sm-2 col-xs-12"></div>
      <div class="col-md-6 col-sm-8 col-xs-12">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            Administrator Login
          </div>
          <div class="panel-body">
            <img class="login-img" alt="Generic User Image" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png"/>
            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-sm-2 col-xs-2"></div>
                <div class="col-sm-8 col-xs-8 input-group">
                  <span class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                  </span>
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>
                </div>
                <div class="text-center">
                  @if ($errors->has('email'))
                    <span class="help-block">
                      <strong>
                        {{ $errors->first('email') }}
                      </strong>
                    </span>
                  @endif
                </div>
                <div class="col-sm-2 col-xs-2"></div>
              </div>
              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-sm-2 col-xs-2"></div>
                <div class="col-sm-8 col-xs-8 input-group">
                  <span class="input-group-addon">
                    <i class="glyphicon glyphicon-lock"></i>
                  </span>
                  <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="text-center">
                  @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>
                        {{ $errors->first('password') }}
                      </strong>
                    </span>
                  @endif
                </div>
                <div class="col-sm-2 col-xs-2"></div>
              </div>
              <div class="form-group">
                <div class="col-sm-2 col-xs-2"></div>
                <div class="col-sm-8 col-xs-8 no-padding">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                  </div>
                </div>
                <div class="col-sm-2 col-xs-2"></div>
              </div>
              <div class="form-group">
                <div class="col-sm-3 col-xs-3"></div>
                <div class="col-sm-6 col-xs-6 text-center">
                  <button type="submit" class="btn btn-primary btn-block">
                    Login
                  </button>
                </div>
                <div class="col-sm-3 col-xs-3"></div>
              </div>
            </form>
          </div>
          <div class="panel-footer">
            <a class="btn btn-link grey-text" href="{{ route('password.request') }}">
              Forgot Your Password? Click Here
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-2 col-xs-12"></div>
    </div>
  </div>
@endsection
