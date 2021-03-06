@extends('layouts.general')

@section('title', 'Lagerlöf Individual Topic')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/lagerlöf.css">
@endsection

@section('content')
  <div class="jumbotron jumbotron-default-background navbar-margin">
    <div class="container text-center">
      <h1 id="individual-header">
        {{substr($main->chunk_size, 0, 4) . ' Word Chunks'}}
        @if(strpos($main->chunk_size, 'NA'))
          {{'(Nouns and Adjectives), '}}
        @else
          {{'(Nouns), '}}
        @endif
        {{$main->topic_id . '/' . $main->topic_number}}
      </h1>
      <div class="col-sm-3 col-xs-12"></div>
      <div class="col-sm-6 col-xs-12">
        @if($main->topic_name != "")
          <h2 class="pointer no-margin" @if(Auth::check()) id="{{$main->global_id}}" onclick="showInput(this)" @endif>
            {{$main->topic_name}}
          </h2>
        @else
          @if(Auth::check())
            <button id="{{$main->global_id}}" class="btn btn-default btn-lg" onclick="showInput(this)">
              Add a Topic Name
            </button>
          @endif
        @endif
      </div>
      <div class="col-sm-3 col-xs-12"></div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="col-xs-12 col-md-4 column-equal-height">
      <div class="panel panel-primary">
        <div class="panel-heading text-center">
          Visualizations
        </div>
        <div class="panel-body visualizations text-left">
          <image class="img-responsive img-rounded individual-image" src="{{'/images/lagerlöf/' . $images->scatterplot}}"></image>
          <image class="img-responsive img-rounded individual-image" src="{{'/images/lagerlöf/' . $images->word_cloud}}"></image>
          <image class="img-responsive img-rounded individual-image" src="{{'/images/lagerlöf/' . $images->unique_word_cloud}}"></image>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-md-4 column-equal-height">
      <table class="table table-striped">
        <thead class="table">
          <tr>
            <th class="text-center">
              Topic Words
            </th>
            <th class="text-center">
              Word Rank
            </th>
            <th class="text-center">
              Word Weight
            </th>
          </tr>
        </thead>
        <tbody class="text-center">
          @foreach($words as $word)
            <tr>
              <td>
                @php
                  $chunk_size = substr($main->where('global_id', $main->global_id)->first()->chunk_size, 0, 4);
                  $part_of_speech = '';
                  if(strpos($main->where('global_id', $main->global_id)->first()->chunk_size, 'NA'))
                  {
                    $part_of_speech = 'NA';
                  }
                  else
                  {
                    $part_of_speech = 'N';
                  }
                  $topic_number = $main->where('global_id', $main->global_id)->first()->topic_number;
                @endphp
                <a class="grey-text" href="/projects/1/Selma%20Lagerlöf%20Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/{{$topic_number}}/{{$word->word}}">
                  {{$word->word}}
                </a>
              </td>
              <td>{{$word->rank}}</td>
              <td>{{$word->weight}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="col-xs-12 col-md-4 column-equal-height">
      <div class="panel panel-primary">
        <div class="panel-heading text-center">
          Relevant Passages
        </div>
        <div class="panel-body relevant-passages">
          <table class="table">
            <tbody>
              @foreach($chunk_names as $name)
                <tr>
                  <td>
                    <div class="pie-chart" data-weight-1="{{$name->weight}}" data-weight-2="{{1 - $name->weight}}"></div>
                  </td>
                  <td class="align-middle">
                    <a class="grey-text" data-passage-path="{{substr($chunk_links->where('global_id', $name->global_id)->where('rank', $name->rank)->first()->name, 1)}}" data-chunk-size="{{$main->chunk_size}}" onclick="getPassage(this)">
                      {{$name->name}}
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="panel panel-primary">
        <div class="panel-heading text-center">
            Passage viewer
        </div>
        <div class="panel-body passage-viewer" type="text">
          <div id="passage-viewer"></div>
          <div class="text-center top-margin-sm">
            <button class="btn btn-default btn-sm top-margin-sm hidden" id="passage-viewer-clear" onclick="clearViewer()">
              Clear
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center bottom-margin-sm">
      <button class="btn btn-default btn-lg" onclick="toTopics()">
          Return to Topics
      </button>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="//cdnjs.cloudflare.com/ajax/libs/d3/4.7.2/d3.min.js"></script>
  <script src="https://d3js.org/d3.v4.min.js"></script>
  <script src="/js/d3pie.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
  <script type="text/javascript">
    var elements = {};

    function showInput(object)
    {
      var parent = object.parentNode;
      var text = object.innerHTML;

      elements[object.id] = object.outerHTML;
      object.remove();

      var csrf_field = '{{ csrf_field() }}'
      csrf_field.replace(/"/g, "'");

      if(text.trim() == "Add a Topic Name")
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

    $(document).ready(function()
    {
      var pie_charts = document.getElementsByClassName("pie-chart");
      for(var i = 0; i < pie_charts.length; i++)
      {
        makePieChart(pie_charts[i], pie_charts[i].getAttribute('data-weight-1'), pie_charts[i].getAttribute('data-weight-2'));
      }
    });

    $(function()
    {
      $('.column-equal-height').matchHeight();
    });

    function makePieChart(object, weight_1, weight_2)
    {
      var pie = new d3pie(object,
      {
        "size":
        {
          "canvasHeight": 50,
          "canvasWidth": 50,
          "pieInnerRadius": "43%",
          "pieOuterRadius": "100%"
        },
        "data":
        {
          "sortOrder": "value-desc",
          "content":
          [
            {
              "value": (parseFloat(weight_2)),
              "color": "#7db9e8"
            },

            {
              "value": (parseFloat(weight_1)),
              "color": "#002255"
            }
          ]
        },
        "labels":
        {
          "outer":
          {
            "format": "none"
          },
          "inner":
          {
            "format": "none"
          },
          "mainLabel":
          {
            "fontSize": 11
          },
          "percentage":
          {
            "color": "#ffffff",
            "decimalPlaces": 0
          },
          "value":
          {
            "color": "#adadad",
            "fontSize": 11
          },
          "lines":
          {
            "enabled": false
          },
          "truncation":
          {
            "enabled": true
          }
        },
        "effects":
        {
          "pullOutSegmentOnClick":
          {
            "effect": "linear",
            "speed": 400,
            "size": 8
          }
        },
        "misc":
        {
          "gradient":
          {
            "enabled": true,
            "percentage": 100
          }
        }
      });
    }

    function getPassage(object)
    {
      var absolute_path = "/texts/Passages/";

      if(object.getAttribute("data-chunk-size").indexOf('1000') >= 0)
      {
        absolute_path = absolute_path + "1000";
      }

      else if(object.getAttribute("data-chunk-size").indexOf('1500') >= 0)
      {
        absolute_path = absolute_path + "1500";
      }

      else
      {
        absolute_path = absolute_path + "2000";
      }

      var relative_path = object.getAttribute("data-passage-path");
      document.getElementById("passage-viewer").innerHTML = "";
      $("#passage-viewer-clear").removeClass("hidden");
      $("#passage-viewer").load(absolute_path + relative_path);
    };

      function clearViewer()
      {
        $("#passage-viewer-clear").addClass("hidden");
        document.getElementById("passage-viewer").innerHTML = "";
      }

      function toTopics()
      {
        var part_of_speech;

        if(document.getElementById("individual-header").innerHTML.includes('NA'))
        {
          part_of_speech = 'NA';
        }

        else
        {
          part_of_speech = 'N';
        }

        window.location.href = '/projects/1/Selma Lagerlöf Project?chunk_size={{substr($main->chunk_size, 0, 4)}}&topic_number={{$main->topic_number}}&part_of_speech=' + part_of_speech;
      }
  </script>
@endsection
