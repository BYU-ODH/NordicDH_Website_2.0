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
        <title>Nordic Digital Humanities Home</title>

        <!--===== LINKS =====-->
        <link href="https://fonts.googleapis.com/css?family=Tangerine" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/app.css"> 
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/cards.css">

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

	    <!--===== JUMBOTRON =====-->
	    <div class="jumbotron" id="main-jumbotron">
		    <div class="container">
			   	<p id="main-jumbotron-text">
			    	The Nordic Digital Humanities Lab hosts a variety of projects researched by faculty and students at Brigham Young University using various computational tools and visualization technologies to explore Nordic literature, art, media, and cultures in new ways. Feel free to browse the projects featured below or click <a href="coming_soon" id="main-jumbotron-link"><u>here</u></a> for more options.
			    </p>
			</div>
	    </div>

	    <!--===== PROJECT CARDS =====-->
	    @if (count($projects) > 3)
	      	<div class="carousel carousel-showmanymoveone slide" id="carouselivo">
	        	<div class="carousel-inner">
	        		@foreach($projects as $project)
	        			@if($project->project_id == 1)
	          				<div class="item active">
	          			@else
	          				<div class="item">
	          			@endif
		          				<div class="card-container col-md-3 col-sm-12">
		          					<div class="card">
					             		<div class="front">
					                 		<div class="cover">
					                     		<img src="../images/card-header.png"/>
					                 		</div>
					                 		<div class="user">
					                     		<img class="img-circle" src="{{ $project->image_path }}"/>
					                 		</div>
					                 		<div class="content">
					                     		<div class="main">
					                         		<h3 class="name">
					                         			{{ $project->project_name }}
					                         		</h3>
					                     			<p class="profession">
					                     				{{ $project->project_description }}
					                     			</p>
					                     		</div>
					                     		<div class="footer">
					                         		<div class="rating">
					                             		Last Updated: {{ substr($project->last_update, 5, 2) . "/" . substr($project->last_update, 8, 2) . "/" . 
					                             		substr($project->last_update, 0, 4) }}
					                         		</div>
					                     		</div>
					                 		</div>
					             		</div>
					             		<div class="back">
					                 		<div class="header">
					                     		<h5 class="motto">
					                     			{{ $project->project_name }}
					                     		</h5>
					                 		</div>
					                 		<div class="content">
					                     		<div class="main">
					                         		<h4 class="text-center">
					                         			Click here to view the project.
					                         		</h4>
					                         		<div class="text-center">
					                         			@if ($project->view === null)
							                         		<button type="button" class="btn btn-lg btn-primary" disabled>
							                         			Project Page
							                         		</button>
							                         	@else 
							                         		<a class="btn btn-lg btn-primary" href="projects/{{ $project->project_id }}/{{ $project->project_name }}">
							                         			Project Page
							                         		</a>
							                         	@endif
						                         	</div>
						                         	<br>
					                         		<h4 class="text-center">
					                         			Click here to learn more about the creation of this project.
					                         		</h4>
					                         		<div class="text-center">
						                         		<button type="button" class="btn btn-lg btn-primary" disabled>
						                         			Project Blog
						                         		</button>
						                         	</div>
					                     		</div>
					                 		</div>
						             	</div>
			     				</div>
			     			</div>
		     			</div>
	          		@endforeach
	          	</div>
	        	<a class="left carousel-control" href="#carouselivo" data-slide="prev">
	        		<i class="glyphicon glyphicon-chevron-left">
	        		</i>
	        	</a>
	        	<a class="right carousel-control" href="#carouselivo" data-slide="next">
	        		<i class="glyphicon glyphicon-chevron-right">
	        		</i>
	        	</a>
	      	</div>

	  	@else
	  		<div class="container">
	  		@if (count($projects) == 2)
	  			<div class="col-md-3">
	  		@elseif (count($projects) == 1)
	  			<div class="col-6 col-md-4">
	  		@endif
		  	@foreach($projects as $project)
		  		@if (count($projects) == 2) 
		  			<div class="card-container col-md-3">
		  		@elseif (count($projects) == 3 || count($projects) == 1)
		  			<div class="card-container col-md-4 col-sm-12">
		  		@endif
	         		<div class="card">
	             		<div class="front">
	                 		<div class="cover">
	                     		<img src="../images/card-header.png"/>
	                 		</div>
	                 		<div class="user">
	                     		<img class="img-circle" src="{{ $project->image_path }}"/>
	                 		</div>
	                 		<div class="content">
	                     		<div class="main">
	                         		<h3 class="name">
	                         			{{ $project->project_name }}
	                         		</h3>
	                     			<p class="profession" id="wrapper">
	                     				{{ $project->project_description }}
	                     			</p>
	                     		</div>
	                     		<div class="footer">
	                         		<div class="rating">
	                             		Last Updated: {{ substr($project->last_update, 5, 2) . "/" . substr($project->last_update, 8, 2) . "/" . 
	                             		substr($project->last_update, 0, 4) }}
	                         		</div>
	                     		</div>
	                 		</div>
	             		</div>
	             		<div class="back">
	                 		<div class="header">
	                     		<h5 class="motto">
	                     			{{ $project->project_name }}
	                     		</h5>
	                 		</div>
	                 		<div class="content">
	                     		<div class="main">
	                         		<h4 class="text-center">
	                         			Click here to view the project.
	                         		</h4>
	                         		<div class="text-center">
		                         		@if ($project->view === null)
			                         		<button type="button" class="btn btn-lg btn-primary" disabled>
			                         			Project Page
			                         		</button>
			                         	@else 
			                         		<a class="btn btn-lg btn-primary" href="projects/{{ $project->project_id }}/{{ $project->project_name }}">
			                         			Project Page
			                         		</a>
			                         	@endif
		                         	</div>
		                         	<br>
	                         		<h4 class="text-center">
	                         			Click here to learn more about the creation of this project.
	                         		</h4>
	                         		<div class="text-center">
		                         		<button type="button" class="btn btn-lg btn-primary" disabled>
		                         			Project Blog
		                         		</button>
		                         	</div>
	                     		</div>
	                 		</div>
		             	</div>
		         	</div>
		     	</div>
     		@endforeach
     		</div>
    	@endif

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
		<script type="text/javascript" src="../dotdotdot/src/jquery.dotdotdot.js">
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous">
		</script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous">
		</script>
		<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js">
		</script>
		<script type="text/javascript">
			$(document).ready(function()
			{
        		(function()
        		{
  					$('#carouselivo').carousel({});

  				}());

				(function()
				{
  					$('.carousel-showmanymoveone .item').each(function()
  					{
    					var clone_item = $(this);
						for (var i=1;i<4;i++) 
						{
      						clone_item = clone_item.next();
      						if (!clone_item.length) 
      						{
        						clone_item = $(this).siblings(':first');
      						}
      						clone_item.children(':first-child').clone()
        					.addClass("cloneditem-"+(i))
        					.appendTo($(this));
    					}
  					});
				}());

				$(".profession").dotdotdot({
					watch: true
				});

				$(".name").dotdotdot({
					watch: true
				});
        	});
		</script>
	</body>
</html>
