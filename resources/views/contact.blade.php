@extends('layouts.general')

@section('title', 'Coming Soon')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
@endsection

@section('content')
  <div class="container navbar-margin-lg">
    <div class="row">
      <div class="col-md-3 col-sm-2 col-xs-12"></div>
      <div class="col-md-6 col-sm-8 col-xs-12">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            Contact Us
          </div>
          <div class="panel-body">
            <p class="text-center">Do you have a comment, suggestion, or question? We'd love to hear
              from you. Send us a message, and we will respond to you as soon as possible</p>
            </header>
            @if(Session::has('message'))
              <div class="alert alert-success">
                {{Session::get('message')}}
              </div>
            @endif
            <ul>
              @foreach($errors->all() as $error)
                <li>
                  {{ $error }}
                </li>
              @endforeach
            </ul>
            {!! Form::open(array('route' => 'contact_store', 'class' => 'form')) !!}
            <div class="form-group">
              {!! Form::label('Name*') !!}
              {!! Form::text('name', null, array('required', 'class'=>'form-control','placeholder'=>'')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('Email Address*') !!}
              {!! Form::text('email', null, array('required', 'class'=>'form-control', 'placeholder'=>'')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('Message*') !!}
              {!! Form::textarea('message', null, array('required', 'class'=>'form-control', 'placeholder'=>'')) !!}
            </div>
            <div class="form-group">
              <div class="col-sm-3 col-xs-3"></div>
              <div class="col-sm-6 col-xs-6 text-center">
                {!! Form::submit('Send', array('class'=>'btn btn-primary')) !!}
              </div>
              <div class="col-sm-3 col-xs-3"></div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-2 col-xs-12"></div>
    </div>
  </div>
@endsection
