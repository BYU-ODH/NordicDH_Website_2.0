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
<!--===== PAGE SETUP =====-->
    <header class="cd-header after_navbar text-center">
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
                {{substr($topic->chunk_size, 0, 4)}} NA {{$topic->topic_number}}">
                @else
                    <div class="card-container manual-flip col-md-4 col-sm-12 
                {{substr($topic->chunk_size, 0, 4)}} N {{$topic->topic_number}}">
                @endif
                    <div class="card">
                        <div class="front">
                            <div class="cover-short">
                                <img src="../../images/card-header.png"/>
                            </div>
                            <div class="content">
                                <div class="main">
                                    <h3 class="name">
                                        @if($topic->topic_name != " " && $topic->topic_name != null)
                                            {{ $topic->topic_name }}
                                        @else
                                            To Be Determined
                                        @endif
                                    </h3>
                                    <p class="topic">
                                        {{substr($topic->chunk_size, 0, 4) . ' Word Chunks'}}
                                        @if (strpos($topic->chunk_size, 'NA'))
                                            {{'(Nouns and Adjectives), '}}
                                        @else
                                            {{'(Nouns), '}}
                                        @endif
                                        {{$topic->topic_id . '/' . $topic->topic_number}}
                                    </p>
                                    <div class="image">
                                        <img src="../../images/lagerlöf/{{$images->where('global_id', $topic->global_id)->first()->word_cloud}}" alt="Word Cloud">
                                    </div>
                                </div>
                                <div class="footer">
                                </div>
                            </div>
                        </div>
                        <div class="back">
                            <div class="header">
                                <h5 class="motto">
                                </h5>
                            </div>
                            <div class="content">
                                <div class="main">
                                    
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
                <div class="cd-filter-block">
                    <h4>Search</h4>                   
                    <div class="cd-filter-content">
                        <input type="search" placeholder="Search Topics ...">
                    </div> 
                </div>
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
        $(document).ready(function()
        {
            $(".name").dotdotdot({
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
    </script>
@endsection