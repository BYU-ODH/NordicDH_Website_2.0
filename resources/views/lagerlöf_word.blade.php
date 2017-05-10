@extends('layouts.general')

@section('title', 'Lagerlöf Word Comparison')
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css"> 
    <link rel="stylesheet" type="text/css" href="/css/main.css">
@endsection

@section('content')
	<div class="jumbotron after-navbar jumbotron-white-background">
        <div class="container text-center">
		    <h1>
		        Topics Containing {{mb_convert_case($word, MB_CASE_TITLE, "UTF-8")}}
		    </h1>
		</div>
	</div>
    <main class="cd-main-content">
        <div class="cd-tab-filter-wrapper">
            <div class="cd-tab-filter">
            </div>
        </div>
        <section class="cd-gallery">
		    @if(!$topics->isEmpty())
			    <table class="table borderless">
			        <tbody>
			    	    @php
			    			$i = 0;
			    		@endphp
			        	@foreach($topics as $topic)
				            <tr>
				                <td class="text-center col-md-4 col-sm-4 col-xs-4 align-middle td-borderless">
				                	<h4>
					                	<a class="gray-link" href="/projects/1/Selma%20Lagerlöf%20Project/{{str_replace('/', '-', $topic->global_id)}}">
				                            {{substr($main->where('global_id', $topic->global_id)->first()->chunk_size, 0, 4) . ' Word Chunks'}}
				                            @if (strpos($main->where('global_id', $topic->global_id)->first()->chunk_size, 'NA'))
				                                {{'(Nouns and Adjectives), '}}
				                            @else
				                                {{'(Nouns), '}}
				                            @endif
				                            {{$main->where('global_id', $topic->global_id)->first()->topic_id . '/' . $main->where('global_id', $topic->global_id)->first()->topic_number}}
				                        </a>
				                    </h4>
				                    <div>
				                    	<div @if(Auth::check()) id="{{$topic->global_id}}" class="pointer" onclick="showInput(this)" @endif>
						                    @if($main->where('global_id', $topic->global_id)->first()->topic_name != " " && $main->where('global_id', $topic->global_id)->first()->topic_name != null)
						                        {{ $main->where('global_id', $topic->global_id)->first()->topic_name }}
						                    @else
						                        To Be Determined
						                    @endif
					                    </div>
					                </div>
				                </td>
				                <td class="td-borderless">
				                	@php
				                		$weight_list = $words[$i]->pluck('weight');
			                            $weight_size = count($weight_list);
			                            $data_weights = "";

			                            for($j=0; $j < $weight_size; $j++)
			                            {
					                		if($j == ($weight_size - 1))
					                		{
					                			$data_weights = $data_weights . $weight_list[$j];
					                		}

					                		else
					                		{
					                			$data_weights = $data_weights . $weight_list[$j] . ",";
					                		}
				                		}

				                		$word_list = $words[$i]->pluck('word');
				                		$word_size = count($word_list);
				                		$data_words = "";

				                		foreach($word_list as $topic_word)
				                		{
											if($word_list[$word_size -1] != $topic_word)
					                		{
					                			$data_words = $data_words . $topic_word . ",";
					                		}

					                		else
					                		{
					                			$data_words = $data_words . $topic_word;
					                		}
				                		}
				                	@endphp
				                	<svg class="bar-graph" data-bar-chart data-weights="{{$data_weights}}" data-words="{{$data_words}}" style="width: 100%">
				                		
				                	</svg>
				                </td>
				            </tr>
				            @php
				            	$i = $i + 1;
				            @endphp
			            @endforeach
			        </tbody>
			    </table>
			    <div class="gap"></div>
			    <div class="text-center bottom-margin-sm">
		            <button class="btn btn-default btn-lg" onclick="toTopics()">
		                Return to Topics
		            </button>
		        </div>
			@else
				<div class="jumbotron jumbotron-default-background after_navbar">
			        <div class="container text-center">
			            <h5>
			            	No Results Found
			            </h5>
			        </div>
			    </div>
			    <div class="text-center bottom-margin-sm">
		            <button class="btn btn-default btn-lg" onclick="toTopics()">
		                Return to Topics
		            </button>
		        </div>
			@endif
		</section>
        <div class="cd-filter">
            <form id="filters">
                <div class="cd-filter-block">
                    <h4>Search</h4>                   
                    <div class="cd-filter-content">
                        <input type="search" placeholder="Search Words ...">
                    </div> 
                </div>
                <div class="cd-filter-block">
                    <h4>Chunk Size</h4>
                    <ul class="cd-filter-content cd-filters list">
                        <li>
                        	@if($chunk_size == 1000)
                            	<input class="filter" data-filter=".1000" type="radio" name="chunks-size" id="1000-words" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/1000/{{$part_of_speech}}/{{$topic_number}}/{{$word}}'" checked>
                            @else
                            	<input class="filter" data-filter=".1000" type="radio" name="chunks-size" id="1000-words" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/1000/{{$part_of_speech}}/{{$topic_number}}/{{$word}}'">
                            @endif
                            <label class="radio-label" for="1000-words">1000 Words</label>
                        </li>
                        <li>
                        	@if($chunk_size == 1500)
								<input class="filter" data-filter=".1500" type="radio" name="chunks-size" id="1500-words" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/1500/{{$part_of_speech}}/{{$topic_number}}/{{$word}}'" checked>
							@else
								<input class="filter" data-filter=".1500" type="radio" name="chunks-size" id="1500-words" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/1500/{{$part_of_speech}}/{{$topic_number}}/{{$word}}'">
							@endif
                            <label class="radio-label" for="1500-words">1500 Words</label>
                        </li>
                        <li>
                        	@if($chunk_size == 2000)
                            	<input class="filter" data-filter=".2000" type="radio" name="chunks-size" id="2000-words" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/2000/{{$part_of_speech}}/{{$topic_number}}/{{$word}}'" checked>
                            @else
                            	<input class="filter" data-filter=".2000" type="radio" name="chunks-size" id="2000-words" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/2000/{{$part_of_speech}}/{{$topic_number}}/{{$word}}'">
                            @endif
                            <label class="radio-label" for="2000-words">2000 Words</label>
                        </li>
                    </ul>
                </div>
                <div class="cd-filter-block">
                    <h4>Number of Topics</h4>
                    <ul class="cd-filter-content cd-filters list">
                        <li>
                        	@if($topic_number == 25)
                            	<input class="filter" data-filter=".25" type="radio" name="topic-number" id="25-topics" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/25/{{$word}}'" checked>
                            @else
                            	<input class="filter" data-filter=".25" type="radio" name="topic-number" id="25-topics" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/25/{{$word}}'">
                            @endif
                            <label class="radio-label" for="25-topics">25 Topics</label>
                        </li>
                        <li>
                            @if($topic_number == 40)
                            	<input class="filter" data-filter=".40" type="radio" name="topic-number" id="40-topics" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/40/{{$word}}'" checked>
                            @else
                            	<input class="filter" data-filter=".40" type="radio" name="topic-number" id="40-topics" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/40/{{$word}}'">
                            @endif
                            <label class="radio-label" for="40-topics">40 Topics</label>
                        </li>
                        <li>
                            @if($topic_number == 55)
                            	<input class="filter" data-filter=".55" type="radio" name="topic-number" id="55-topics" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/55/{{$word}}'" checked>
                            @else
                            	<input class="filter" data-filter=".55" type="radio" name="topic-number" id="55-topics" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/55/{{$word}}'">
                            @endif
                            <label class="radio-label" for="55-topics">55 Topics</label>
                        </li>
                        <li>
                        	@if($topic_number == 70)
                            	<input class="filter" data-filter=".70" type="radio" name="topic-number" id="70-topics" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/70/{{$word}}'" checked>
                            @else
                            	<input class="filter" data-filter=".70" type="radio" name="topic-number" id="70-topics" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/70/{{$word}}'">
                            @endif
                            <label class="radio-label" for="70-topics">70 Topics</label>
                        </li>
                    </ul>
                </div>
                <div class="cd-filter-block">
                    <h4>Part of Speech</h4>
                    <ul class="cd-filter-content cd-filters list">
                        <li>
                        	@if($part_of_speech == 'N')
                            	<input class="filter" data-filter=".N" type="radio" name="part-of-speech" id="noun" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/N/{{$topic_number}}/{{$word}}'" checked>
                            @else
                            	<input class="filter" data-filter=".N" type="radio" name="part-of-speech" id="noun" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/N/{{$topic_number}}/{{$word}}'">
                            @endif
                            <label class="radio-label" for="noun">Noun</label>
                        </li>
                        <li>
                        	@if($part_of_speech == 'NA')
                            	<input class="filter" data-filter=".NA" type="radio" name="part-of-speech" id="noun-and-adj" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/NA/{{$topic_number}}/{{$word}}'" checked>
                            @else
                            	<input class="filter" data-filter=".NA" type="radio" name="part-of-speech" id="noun-and-adj" onClick="window.location='/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/NA/{{$topic_number}}/{{$word}}'">
                            @endif
                            <label class="radio-label" for="noun-and-adj">Noun and Adj.</label>
                        </li>
                    </ul>
                </div>
            </form>
            <a href="#0" class="cd-close">Close</a>
        </div> 
        <a href="#0" class="cd-filter-trigger">Filters</a>
    </main>
@endsection

@section('scripts')
	<script src="/js/modernizr.js">
    </script>
    <script src="/js/jquery.mixitup.min.js">
    </script>
    <script src="/js/jquery.mixitup-pagination.min.js">
    </script>
    <script src="/js/main.js">
    </script>
    <script src="/js/d3/d3.min.js">
    </script>
    <script src="/js/c3/c3.min.js">
    </script>
    <script type="text/javascript">
    	var elements = {};

    	function toTopics() 
        {
        	window.location.href = '/projects/1/Selma Lagerlöf Project?chunk_size={{$chunk_size}}&topic_number={{$topic_number}}&part_of_speech={{$part_of_speech}}';
        }

        function showInput(object)
        {
            var parent = object.parentNode;
            var text = object.innerHTML;

            elements[object.id] = object.outerHTML;
            object.remove();

            var csrf_field = '{{ csrf_field() }}'
            csrf_field.replace(/"/g, "'");

            if(text.trim() == "To Be Determined")
            {
                $(parent).append("<div id='Restore" + object.id + "' class='side-margin-sm'><form class='form-horizontal' role='form' method='POST' action='/projects/1/Selma Lagerlöf Project/sql_update/" + object.id.replace("/", "-") + "'>" + csrf_field + "<div class='form-group'><div class='input-group'><span id='" + object.id + "' class='input-group-addon' onclick='restore(this)'><i class='glyphicon glyphicon-remove'></i></span><input name='name' type='text' class='form-control' placeholder='Enter Name Here'><span class='input-group-btn'><button class='btn btn-primary' type='submit'>Submit</button></span></div></div></form></div>");
            }
        
            else
            {
                $(parent).append("<div id='Restore" + object.id + "' class='side-margin-sm'><form class='form-horizontal' role='form' method='POST' action='/projects/1/Selma Lagerlöf Project/sql_update/" + object.id.replace("/", "-") + "'>" + csrf_field + "<div class='form-group'><div class='input-group'><span id='" + object.id + "' class='input-group-addon' onclick='restore(this)'><i class='glyphicon glyphicon-remove'></i></span><input name='name' type='text' class='form-control' placeholder='" + text.trim() + "'><span class='input-group-btn'><button class='btn btn-primary' type='submit'>Submit</button></span></div></div></form></div>");
            }
        };

        function restore(object)
        {
            var restore_element = elements[object.id];
            var replace_element = document.getElementById("Restore" + object.id);
            var parent = replace_element.parentNode;

            replace_element.remove();
            $(parent).append(restore_element);
        };

    	var drawGraphs = function()
    	{
    		$('.bar-graph').empty();
			$('[data-bar-chart]').each(function (i, svg) 
			{
			    var $svg = $(svg);
			    var weight_data = $svg.data('weights').split(',').map(function (datum) 
			    {
			      return parseFloat(datum);
			    });

			    var word_data = $svg.data('words').split(',');

			    var data = [];
			    for(i=0; i < weight_data.length; i++)
			    {
			    	data[i] = {weight: weight_data[i], word: word_data[i]};
			    }

			    var bar_space = 1;
			    var chart_height = $svg.outerHeight();
			    var chart_width = $svg.outerWidth() - 30;
			    var bar_width = chart_width/20;

			    var y = d3.scale.linear()
			        .domain([0, d3.max(data)])
			        .range([0, chart_height]);

			    d3.select(svg)
			      	.selectAll("rect")
			        .data(data)
			      	.enter().append("rect")
			        .attr("class", "bar")
			        .attr('fill', function(d, i)
	       	  		{
	       	    		if (d.word == "{{$word}}")
	       	    		{
	       	      			return "rgb(255, 0, 0)";
	       	    		}
	       	    		else
	       	    		{
	       	    			var red = 0 + (i*5);
	       	    			var blue = 34 + (i*5);
	       	    			var green = 85 + (i*5);
	       	      			return "rgb(" + red + "," + blue + "," + green + ")";
	       	    		}
	       	  		})
	       	  		.on("mouseover", function () 
	       	      	{
	                	d3.select(this).classed("hover", true);
	              	})
	              	.on("mouseout", function () 
	              	{
	                	d3.select(this).classed("hover", false);
	              	})
	              	.on("click", function (d) 
	              	{
	                	window.location = "/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/{{$topic_number}}/" + d.word;
	              	})
			        .attr("width", bar_width)
			        .attr("x", function (d, i) { return bar_width*i + bar_space*i; })
			        .attr("y", chart_height)
			        .attr("height", 0)
			        .transition()
			        .delay(function (d, i) { return i*100; })
			        .attr("y", function (d, i) { return chart_height-(d.weight*1000); })
			        .attr("height", function (d) { return d.weight*1000; });
		        
		        d3.select(svg)
		      		.selectAll("text")
		      		.data(data)
		      		.enter().append('text')
	       	  		.text(function(d) 
	       	  		{
	            		return d.word;
	          		})
	          		.attr("x", function (d, i) { return bar_width*i + bar_space*i + 20})
	          		.attr("y", function(d,i)
	       	  		{
	       	    		return chart_height - (d.weight*1000) - 7;
	       	  		})
	          		.attr('fill', function(d, i)
	       	  		{
	       	    		if (d.word == "{{$word}}")
	       	    		{
	       	      			return "rgb(255, 0, 0)";
	       	    		}
	       	    		else
	       	    		{
	       	    			var red = 0 + (i*5);
	       	    			var blue = 34 + (i*5);
	       	    			var green = 85 + (i*5);
	       	      			return "rgb(" + red + "," + blue + "," + green + ")";
	       	    		}
	       	  		})
	       	  		.attr('transform', function(d,i)
			       	{
			       	    var x = (bar_width*i + bar_space*i) + 15;
			       	    var y = chart_height - (d.weight*1000);
			       	    return "rotate(-45 " + x +", " + y + ")";
			       	})
	       	  		.on("mouseover", function () 
	       	      	{
	                	d3.select(this).classed("hover", true);
	              	})
	              	.on("mouseout", function () 
	              	{
	                	d3.select(this).classed("hover", false);
	              	})
	              	.on("click", function (d) 
	              	{
	                	window.location = "/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/{{$topic_number}}/" + d.word;
	              	});
	        });
		};
        var debounce = function(fn, timeout) 
		{
  			var timeout_id = -1;
  			return function() 
  			{
    			if (timeout_id > -1) 
    			{
      				window.clearTimeout(timeout_id);
    			}
    			timeout_id = window.setTimeout(fn, timeout);
  			}
		};
	
		var debounced_draw = debounce(function() 
		{
  			drawGraphs();
		}, 125);

		$(window).resize(debounced_draw);
		$(document).ready(function()
        {
        	drawGraphs();

        	$(".cd-filter-content input[type='search']").keyup(function()
        	{
        		if(event.keyCode == 13)
        		{
			    	var inputText = $(".cd-filter-content input[type='search']").val().toLowerCase();
			    	if ((inputText.length) > 0) 
			    	{            
			      		window.location = "/projects/1/Selma Lagerlöf Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/{{$topic_number}}/" + inputText;
			    	}
				 }
			});
        });
    </script>
@endsection