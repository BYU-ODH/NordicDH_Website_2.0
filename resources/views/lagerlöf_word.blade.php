@extends('layouts.general')

@section('title', 'Lagerlöf Word Comparison')
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/css/reset.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/app.css"> 
    <link rel="stylesheet" type="text/css" href="/css/main.css">
@endsection

@section('content')
	<div class="jumbotron jumbotron-default-background after_navbar">
        <div class="container text-center">
            <h1>
            	Topics Containing {{mb_convert_case($word, MB_CASE_TITLE, "UTF-8")}}
            </h1>
	    	<form class="form-center" id="searchbox" autocomplete="off" action="/projects/1/Selma%20Lagerlöf%20Project/word_comparison/{{$word}}" method="post">
	            <input name="search" type="text" size="15" placeholder="search words"/>
	            <input id="button-submit" type="submit" value=""/>
	        </form>
        </div>
    </div>
    @if(!$topics->isEmpty())
	    <table class="table">
	        <tbody>
	    	    @php
	    			$i = 0;
	    		@endphp
	        	@foreach($topics as $topic)
		            <tr>
		                <td class="text-center col-md-4 col-sm-4 col-xs-4 align-middle">
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
			                    @if($main->where('global_id', $topic->global_id)->first()->topic_name != " " && $main->where('global_id', $topic->global_id)->first()->topic_name != null)
			                        {{ $main->where('global_id', $topic->global_id)->first()->topic_name }}
			                    @else
			                        To Be Determined
			                    @endif
			                </div>
		                </td>
		                <td>
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
	@else
		<div class="jumbotron jumbotron-default-background after_navbar">
	        <div class="container text-center">
	            <h5>
	            	No Results Found
	            </h5>
	        </div>
	    </div>
	@endif
@endsection

@section('scripts')
    <script src="/js/d3/d3.min.js">
    </script>
    <script src="/js/c3/c3.min.js">
    </script>
    <script type="text/javascript">
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
	                	window.location = "/projects/1/Selma Lagerlöf Project/word_comparison/" + d.word + "/{{str_replace('/', '-', $main->global_id)}}";
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
	                	window.location = "/projects/1/Selma Lagerlöf Project/word_comparison/" + d.word + "/{{str_replace('/', '-', $main->global_id)}}";
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
        });
    </script>
@endsection