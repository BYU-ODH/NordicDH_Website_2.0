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
      <div class="col-lg-3 col-md-2 col-sm-1">
      </div>
      <div class="col-lg-6 col-md-8 col-sm-10">
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
            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
              {{ csrf_field() }}
              <div class="col-xs-1">
              </div>
              <div class="col-xs-10">
                <p>
                  Enter your e-mail address below, and a link to reset your password will be sent to you.
                </p>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <div>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                    @if ($errors->has('email'))
                      <span class="help-block text-center">
                        <strong>
                            {{ $errors->first('email') }}
                        </strong>
                      </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="col-xs-2">
              </div>
              <div class="col-xs-8">
                <div class="form-group">
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">
                      Send Password Reset
                    </button>
                  </div>
                </div>
              </div>
              <div class="col-xs-2">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-2 col-sm-1">
      </div>
    </div>
  </div>
@endsection
