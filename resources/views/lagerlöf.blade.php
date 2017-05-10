@extends('layouts.general')

@section('title', 'Lagerlöf')
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="../../css/cards.css">
    <link rel="stylesheet" type="text/css" href="../../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/app.css"> 
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
@endsection

@section('content')
    <header class="cd-header after-navbar text-center">
        <div class="col-md-8 offset-md-2 col-sm-12">
            <h3>
                Topic modeling uses statistical algorithms to discover the latent semantic structures in an extensive text body. This project focuses on the work of a single author, Selma Lagerlöf, to test the uses and limits of topic modeling. All of the topic models generated from this research are listed below. For your convenience we have included filters to help you find the topics you're looking for.
            </h3>
        </div>
    </header>
    <main class="cd-main-content">
        <div class="cd-tab-filter-wrapper">
            <div class="cd-tab-filter">
            </div>
        </div>
        <div class="text-center">
            {{$main->links()}}
        </div>
        <section class="cd-gallery">
            @foreach($main as $topic)
                @if (strpos($topic->chunk_size, 'NA'))
                    <div class="card-container manual-flip col-md-4 col-sm-12 
                {{substr($topic->chunk_size, 0, 4)}} NA {{$topic->topic_number}} {{$topic->name}}">
                @else
                    <div class="card-container manual-flip col-md-4 col-sm-12 
                {{substr($topic->chunk_size, 0, 4)}} N {{$topic->topic_number}} {{$topic->name}}">
                @endif
                    <div class="card">
                        <div class="front">
                            <div class="cover-short">
                                <img src="../../images/card-header.png"/>
                            </div>
                            <div class="content">
                                <div class="main">
                                    <div>
                                        <h3 class="name" @if(Auth::check()) id="{{$topic->global_id}}"onclick="showInput(this)" @endif>
                                            @if($topic->topic_name != " " && $topic->topic_name != null)
                                                {{ $topic->topic_name }}
                                            @else
                                                To Be Determined
                                            @endif
                                        </h3>
                                    </div>
                                    <p class="topic">
                                        <a class="gray-link" href="/projects/1/Selma%20Lagerlöf%20Project/{{str_replace('/', '-', $topic->global_id)}}">
                                        {{substr($topic->chunk_size, 0, 4) . ' Word Chunks'}}
                                        @if (strpos($topic->chunk_size, 'NA'))
                                            {{'(Nouns and Adjectives), '}}
                                        @else
                                            {{'(Nouns), '}}
                                        @endif
                                        {{$topic->topic_id . '/' . $topic->topic_number}}
                                        </a>
                                    </p>
                                    <div class="word-cloud">
                                        <img src="../../images/lagerlöf/{{$images->where('global_id', $topic->global_id)->first()->word_cloud}}" alt="Word Cloud">
                                    </div>
                                    <p class="words">
                                    @php
                                        $word_list = $words->where('global_id', $topic->global_id)->pluck('word');
                                        $words_size = count($word_list);
                                        $chunk_size = substr($topic->chunk_size, 0, 4);
                                        $part_of_speech = '';

                                        if(strpos($topic->chunk_size, 'NA'))
                                        {
                                            $part_of_speech = 'NA';
                                        }

                                        else
                                        {
                                            $part_of_speech = 'N';
                                        }

                                        $topic_number = $topic->topic_number;
                                    @endphp
                                    @foreach($word_list as $word)
                                        <a class="gray-link" href="/projects/1/Selma%20Lagerlöf%20Project/word_comparison/{{$chunk_size}}/{{$part_of_speech}}/{{$topic_number}}/{{$word}}">
                                        @if($word_list[$words_size -1] != $word)
                                            {{$word}},
                                        @else
                                            {{$word}}
                                        @endif
                                        </a>
                                    @endforeach
                                    </p>
                                </div>
                                <div class="footer">
                                    <button class="btn btn-simple" onclick="rotateCard(this)">
                                        Click to Rotate
                                        <span class="glyphicon glyphicon-share-alt">
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="back">
                            <div class="header">
                                <h5 class="motto">
                                    <a class="gray-link" href="/projects/1/Selma%20Lagerlöf%20Project/{{str_replace('/', '-', $topic->global_id)}}">
                                        {{substr($topic->chunk_size, 0, 4) . ' Word Chunks'}}
                                        @if (strpos($topic->chunk_size, 'NA'))
                                            {{'(Nouns and Adjectives), '}}
                                        @else
                                            {{'(Nouns), '}}
                                        @endif
                                        {{$topic->topic_id . '/' . $topic->topic_number}}
                                    </a>
                                </h5>
                            </div>
                            <div class="content">
                                <div class="main">
                                    <div class="scatter-plot">
                                        <img src="../../images/lagerlöf/{{$images->where('global_id', $topic->global_id)->first()->scatterplot}}" alt="Scatter Plot">
                                    </div>
                                    <p class="chunks">
                                        @php
                                            $chunk_list = $chunks->where('global_id', $topic->global_id)->pluck('name');
                                            $chunks_size = count($chunk_list);
                                        @endphp
                                        @foreach($chunk_list as $path)
                                                @php
                                                    $chunk = $path;
                                                    $chunk = str_replace("_", " ", $chunk);
                                                    $chunk = str_replace("./", "", $chunk);
                                                    $chunk = str_replace(".txt", "", $chunk);
                                                    $chunk = str_replace("LagerlofS", "", $chunk);
                                                    $chunk = str_replace("of", " of ", $chunk);
                                                    $chunk = preg_replace("/\d{4}/", "", $chunk);
                                                    $chunk = str_replace("Gosta Berlings Saga", "Gösta Berlings Saga", $chunk);
                                                    $chunk = str_replace("Osynliga Lankar", "Osynliga Länkar", $chunk);
                                                    $chunk = str_replace("Korkarlen", "Körkarlen", $chunk);
                                                    $chunk = str_replace("Troll Och Mann", "Troll Och Männ", $chunk);
                                                    $chunk = str_replace("Marbacka", "Mårbacka", $chunk);
                                                    $chunk = str_replace("Lowenskoldska R", "Löwensköldska", $chunk);
                                                    $chunk = str_replace("Charlotte Lowenskold", "Charlotte Löwensköld", $chunk);
                                                    $chunk = str_replace("Anna Svard", "Anna Svärd", $chunk);
                                                    $chunk = str_replace("Fran Skilda Tider", "Från Skilda Tider", $chunk);
                                                @endphp
                                            @if($chunk_list[$chunks_size - 1] != $path)
                                                {{$chunk}},
                                            @else
                                                {{$chunk}}
                                            @endif
                                        @endforeach
                                    </p>
                                </div>
                                <div class="footer">
                                    <button class="btn btn-simple" onclick="rotateCard(this)">
                                        Click to Rotate
                                        <span class="glyphicon glyphicon-share-alt">
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="gap"></div>
            <div class="gap"></div>
            <div class="gap"></div>
        </section>
        <div class="cd-filter">
            <form id="filters">
                <!--<div class="cd-filter-block">
                    <h4>Search</h4>                   
                    <div class="cd-filter-content">
                        <input type="search" placeholder="Search Topics ...">
                    </div> 
                </div>-->
                <div class="cd-filter-block">
                    <h4>Chunk Size</h4>
                    <ul class="cd-filter-content cd-filters list">
                    @php
                        $topic_number = request('topic_number');
                        $chunk_size = request('chunk_size');
                        $part_of_speech = request('part_of_speech');
                    @endphp
                        <li>
                            @if($chunk_size == 1000 || $chunk_size == '')
                                <input class="filter" data-filter=".1000" type="radio" name="chunks-size" id="1000-words" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>'1000', 'topic_number'=>request('topic_number'), 'part_of_speech'=>request('part_of_speech')]) }}'" checked>
                            @else
                                <input class="filter" data-filter=".1000" type="radio" name="chunks-size" id="1000-words" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>'1000', 'topic_number'=>request('topic_number'), 'part_of_speech'=>request('part_of_speech')]) }}'">
                            @endif

                            <label class="radio-label" for="1000-words">1000 Words</label>
                        </li>
                        <li>
                            @if($chunk_size == 1500)
                                <input class="filter" data-filter=".1500" type="radio" name="chunks-size" id="1500-words" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>'1500', 'topic_number'=>request('topic_number'), 'part_of_speech'=>request('part_of_speech')]) }}'" checked>
                            @else
                                <input class="filter" data-filter=".1500" type="radio" name="chunks-size" id="1500-words" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>'1500', 'topic_number'=>request('topic_number'), 'part_of_speech'=>request('part_of_speech')]) }}'">
                            @endif
                            <label class="radio-label" for="1500-words">1500 Words</label>
                        </li>
                        <li>
                            @if($chunk_size == 2000)
                                <input class="filter" data-filter=".2000" type="radio" name="chunks-size" id="2000-words" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>'2000', 'topic_number'=>request('topic_number'), 'part_of_speech'=>request('part_of_speech')]) }}'" checked>
                            @else
                                <input class="filter" data-filter=".2000" type="radio" name="chunks-size" id="2000-words" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>'2000', 'topic_number'=>request('topic_number'), 'part_of_speech'=>request('part_of_speech')]) }}'">
                            @endif
                            <label class="radio-label" for="2000-words">2000 Words</label>
                        </li>
                    </ul>
                </div>
                <div class="cd-filter-block">
                    <h4>Number of Topics</h4>
                    <ul class="cd-filter-content cd-filters list">
                        <li>
                            @if($topic_number == '25' || $topic_number == '')
                                <input class="filter" data-filter=".25" type="radio" name="topic-number" id="25-topics" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>request('chunk_size'), 'topic_number'=>'25', 'part_of_speech'=>request('part_of_speech')]) }}'" checked>
                            @else
                                <input class="filter" data-filter=".25" type="radio" name="topic-number" id="25-topics" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>request('chunk_size'), 'topic_number'=>'25', 'part_of_speech'=>request('part_of_speech')]) }}'">
                            @endif
                            <label class="radio-label" for="25-topics">25 Topics</label>
                        </li>
                        <li>
                            @if($topic_number == '40')
                                <input class="filter" data-filter=".40" type="radio" name="topic-number" id="40-topics" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>request('chunk_size'), 'topic_number'=>'40', 'part_of_speech'=>request('part_of_speech')]) }}'" checked>
                            @else
                                <input class="filter" data-filter=".40" type="radio" name="topic-number" id="40-topics" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>request('chunk_size'), 'topic_number'=>'40', 'part_of_speech'=>request('part_of_speech')]) }}'">
                            @endif
                            <label class="radio-label" for="40-topics">40 Topics</label>
                        </li>
                        <li>
                            @if($topic_number == '55')
                                <input class="filter" data-filter=".55" type="radio" name="topic-number" id="55-topics" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>request('chunk_size'), 'topic_number'=>'55', 'part_of_speech'=>request('part_of_speech')]) }}'" checked>
                            @else
                                <input class="filter" data-filter=".55" type="radio" name="topic-number" id="55-topics" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>request('chunk_size'), 'topic_number'=>'55', 'part_of_speech'=>request('part_of_speech')]) }}'">
                            @endif
                            <label class="radio-label" for="55-topics">55 Topics</label>
                        </li>
                        <li>
                            @if($topic_number == '70')
                                <input class="filter" data-filter=".70" type="radio" name="topic-number" id="70-topics" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>request('chunk_size'), 'topic_number'=>'70', 'part_of_speech'=>request('part_of_speech')]) }}'" checked>
                            @else
                                <input class="filter" data-filter=".70" type="radio" name="topic-number" id="70-topics" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>request('chunk_size'), 'topic_number'=>'70', 'part_of_speech'=>request('part_of_speech')]) }}'">
                            @endif
                            <label class="radio-label" for="70-topics">70 Topics</label>
                        </li>
                    </ul>
                </div>
                <div class="cd-filter-block">
                    <h4>Part of Speech</h4>
                    <ul class="cd-filter-content cd-filters list">
                        <li>
                            @if($part_of_speech == 'N' || $part_of_speech == '')
                                <input class="filter" data-filter=".N" type="radio" name="part-of-speech" id="noun" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>request('chunk_size'), 'topic_number'=>request('topic_number'), 'part_of_speech'=>'N']) }}'" checked>
                            @else
                                <input class="filter" data-filter=".N" type="radio" name="part-of-speech" id="noun" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>request('chunk_size'), 'topic_number'=>request('topic_number'), 'part_of_speech'=>'N']) }}'">
                            @endif
                            <label class="radio-label" for="noun">Noun</label>
                        </li>
                        <li>
                            @if($part_of_speech == 'NA')
                                <input class="filter" data-filter=".NA" type="radio" name="part-of-speech" id="noun-and-adj" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>request('chunk_size'), 'topic_number'=>request('topic_number'), 'part_of_speech'=>'NA']) }}'" checked>
                            @else
                                <input class="filter" data-filter=".NA" type="radio" name="part-of-speech" id="noun-and-adj" onClick="window.location='{{ route('individual.project', ['project_id'=>1, 'project_name'=>'Selma Lagerlöf Project', 'chunk_size'=>request('chunk_size'), 'topic_number'=>request('topic_number'), 'part_of_speech'=>'NA']) }}'">
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
    <script type="text/javascript" src="/dotdotdot/src/jquery.dotdotdot.js">
    </script>
    <script type="text/javascript">
        var elements = {};
        $(document).ready(function()
        {
            $(".name").dotdotdot({
                watch: true
            });

            $(".words").dotdotdot({
                watch: true
            });

            $(".chunks").dotdotdot({
                watch: true
            });
        });

        function rotateCard(button)
        {
            var $card = $(button).closest('.card-container');
            console.log($card);
            if($card.hasClass('hover'))
            {
                $card.removeClass('hover');
            } 

            else 
            {
                $card.addClass('hover');
            }
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
    </script>
@endsection