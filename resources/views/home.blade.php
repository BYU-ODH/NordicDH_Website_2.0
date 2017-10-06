@extends('layouts.general')

@section('title', 'Home')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/cards.css">
@endsection

@section('content')
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
                        <a class="btn btn-lg btn-primary" href="blogs/{{ $project->project_id }}/{{ $project->project_name }}">
                          Project Blog
                        </a>
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
    		<i class="glyphicon glyphicon-chevron-left"></i>
    	</a>
    	<a class="right carousel-control" href="#carouselivo" data-slide="next">
    		<i class="glyphicon glyphicon-chevron-right"></i>
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
                  <a class="btn btn-lg btn-primary" href="blogs/{{ $project->project_id }}/{{ $project->project_name }}">
                    Project Blog
                  </a>
               	</div>
           		</div>
         		</div>
         	</div>
       	</div>
     	</div>
 		@endforeach
 		</div>
	@endif
@endsection

@section('scripts')
	<script type="text/javascript" src="../dotdotdot/src/jquery.dotdotdot.js"></script>
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
@endsection
