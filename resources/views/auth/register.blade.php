@extends('layouts.general')

@section('title', 'Add Administrator')
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="../css/app.css"> 
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/cards.css">
@endsection
@section('content')
    <div class="container after-navbar-lg">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        Add Administrator
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <div class="col-sm-1 col-xs-12">
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <label for="first_name" class="control-label text-left">First Name</label>
                                </div>
                                <div class="col-sm-7 col-xs-12">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>
                                                {{ $errors->first('first_name') }}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <div class="col-sm-1 col-xs-12">
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                     <label for="last_name" class="control-label text-left">Last Name</label>                               
                                </div>
                                <div class="col-sm-7 col-xs-12">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>
                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>
                                                {{ $errors->first('last_name') }}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-sm-1 col-xs-12">
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <label for="email" class="control-label text-left">E-Mail</label>
                                </div>
                                <div class="col-sm-7 col-xs-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>
                                                {{ $errors->first('email') }}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-sm-1 col-xs-12">
                                </div>
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
                                <div class="col-sm-1 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-1 col-xs-12">
                                </div>
                                <div class="col-sm-3 col-xs-12">
                                    <label for="password-confirm" class="control-label text-left">Confirm Password</label>
                                </div>
                                <div class="col-sm-7 col-xs-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                                <div class="col-sm-1 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5 col-xs-12">
                                </div>
                                <div class="col-sm-5 col-xs-12">
                                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                </div>
                                <div class="col-sm-2 col-xs-12">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
@endsection
