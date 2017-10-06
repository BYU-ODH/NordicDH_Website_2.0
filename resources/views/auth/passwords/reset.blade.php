@extends('layouts.general')

@section('title', 'Reset Password')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/cards.css">
@endsection

@section('content')
  <div class="container after-navbar-lg">
    <div class="row">
      <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="panel panel-primary">
            <div class="panel-heading text-center">
                Reset Password
            </div>
            <div class="panel-body">
              @if (session('status'))
                <div class="alert alert-success">
                  {{ session('status') }}
                </div>
              @endif
              <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <div class="col-sm-1 col-xs-12"></div>
                  <div class="col-sm-3 col-xs-12">
                    <label for="email" class="control-label text-left">E-Mail</label>
                  </div>
                  <div class="col-sm-7 col-xs-12">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                      <span class="help-block">
                        <strong>
                          {{ $errors->first('email') }}
                        </strong>
                      </span>
                    @endif
                  </div>
                  <div class="col-sm-1 col-xs-12"></div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <div class="col-sm-1 col-xs-12"></div>
                    <div class="col-sm-3 col-xs-12">
                      <label for="password" class="control-label text-left">Password</label>
                    </div>
                    <div class="col-sm-7 col-xs-12">
                      <input id="password" type="password" class="form-control" name="password" required>
                      @if ($errors->has('password'))
                        <span class="help-block">
                          <strong>
                            {{ $errors->first('password') }}
                          </strong>
                        </span>
                      @endif
                    </div>
                    <div class="col-sm-1 col-xs-12"></div>
                  </div>
                  <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <div class="col-sm-1 col-xs-12"></div>
                    <div class="col-sm-3 col-xs-12">
                      <label for="password-confirm" class="control-label text-left">Confirm Password</label>
                    </div>
                    <div class="col-sm-7 col-xs-12">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                      @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                          <strong>
                            {{ $errors->first('password_confirmation') }}
                          </strong>
                        </span>
                      @endif
                    </div>
                  <div class="col-sm-1 col-xs-12"></div>
                </div>
                <div class="form-group">
                  <div class="col-sm-5 col-xs-12"></div>
                  <div class="col-sm-5 col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block">
                      Reset Password
                    </button>
                  </div>
                  <div class="col-sm-2 col-xs-12"></div>
                </div>
              </form>
            </div>
          </div>
        </div>
      <div class="col-md-2"></div>
    </div>
  </div>
@endsection
