<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

	<!--===== HEAD =====-->
	<head>

		<!--===== META DATA =====-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="Nordic Digital Humanities, Nordic, Digital Humanities, Scandinavia, Corpus Linguistics, Christopher Oscarson, Brady Hammond, Merrill Asp, BYU, BYU Digital Humanities, Brigham Young University">
        <meta name="description" content="BYU's Nordic Digital Humanities Lab is an experimental publication that distributes digital humanities research specific to Nordic and Scandinavian works. Until recently the lab has focused primarily on topic modeling, but we are preparing to release new and exciting material in the near future.">

        <!--===== TITLE =====-->
        <title>Nordic Digital Humanities: @yield('title')</title>

        <!--===== LINKS =====-->
        <link href="https://fonts.googleapis.com/css?family=Tangerine" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        @yield('stylesheets')

    </head>

    <!--===== BODY =====-->
    <body>

        <!--===== NAVBAR =====-->
        <nav class="navbar navbar-default navbar-fixed-top navbar-toggleable-md">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">
                                Toggle navigation
                            </span>
                            <span class="icon-bar">
                            </span>
                            <span class="icon-bar">
                            </span>
                            <span class="icon-bar">
                            </span>
                    </button>
                    <a class="navbar-brand text-center white-text" href="/">
                        <img class="d-inline-block" id="humanities-logo" src="/images/navbar_logo.png" width="60" height="60" alt="BYU Humanities Logo">
                        Nordic Digital Humanities Lab
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <form class="nav navbar-nav navbar-right" id="searchbox" autocomplete="off">
                        <input name="q" type="text" size="15" placeholder="search projects"/>
                        <input id="button-submit" type="submit" value=""/>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="" id="home-link">
                            <a class="white-text" href="/">
                                Home
                            </a>
                        </li>
                        <li class="" id="about-link">
                            <a class="white-text" href="coming_soon">
                                About
                            </a>
                        </li>
                        <li class="" id="contact-link">
                            <a class="white-text" href="coming_soon">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!--===== CONTENT =====-->
        @yield('content')

        <!--===== FOOTER =====-->
        <footer role="footer">
            <div class="container">
                <div class="col-md-3 col-sm-12">
                    <h4>
                        Site
                    </h4>
                    <ul>
                        @foreach($links as $link)
                            @if($link->link_category == "site")
                                <li>
                                    <a href="{{$link->link_url}}" class="light-grey-text">
                                        {{$link->link_text}}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3 col-sm-12">
                    <h4>
                        Administrator Tools
                    </h4>
                    <ul>
                        @foreach($links as $link)
                            @if($link->link_category == "administrator_tools")
                                <li>
                                    <a href="{{$link->link_url}}" class="light-grey-text">
                                        {{$link->link_text}}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3 col-sm-12">
                    <h4>
                        Help
                    </h4>
                    <ul>
                        @foreach($links as $link)
                            @if($link->link_category == "help")
                                <li>
                                    <a href="{{$link->link_url}}" class="light-grey-text">
                                        {{$link->link_text}}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3 col-sm-12">
                    <h4>
                        Related Links
                    </h4>
                    <ul>
                        @foreach($links as $link)
                            @if($link->link_category == "related_links")
                                <li>
                                    <a href="{{$link->link_url}}" class="light-grey-text">
                                        {{$link->link_text}}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="container text-center">
                <hr>
                <p>
                    Brigham Young University © All Rights Reserved.
                </p>
            </div> 
        </footer>

        <!--===== SCRIPTS =====-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js">
        </script>
        @yield('scripts')
    </body>
</html>