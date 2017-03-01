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
       <section class="cd-gallery">
            @foreach($main as $topic)
                @if (strpos($topic->chunk_size, 'NA'))
                    <div class="mix card-container manual-flip col-md-3 col-sm-12 
                {{substr($topic->chunk_size, 0, 4)}} NA {{$topic->topic_number}}">
                @else
                    <div class="mix card-container manual-flip col-md-4 col-sm-12 
                {{substr($topic->chunk_size, 0, 4)}} N {{$topic->topic_number}}">
                @endif
                    <div class="card">
                        <div class="front">
                            <div class="cover">
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
                                    <p class="profession">

                                    </p>
                                </div>
                                <div class="footer">
                                    <div class="rating">
                                    </div>
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
            <div class="mixitup-page-list"></div>
            <div class="cd-fail-message">
                No results found
            </div>
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
                        <li>
                            <input class="filter" data-filter=".1000" type="radio" name="chunks-size" id="1000-words" checked>
                            <label class="radio-label" for="1000-words">1000 Words</label>
                        </li>
                        <li>
                            <input class="filter" data-filter=".1500" type="radio" name="chunks-size" id="1500-words">
                            <label class="radio-label" for="1500-words">1500 Words</label>
                        </li>
                        <li>
                            <input class="filter" data-filter=".2000" type="radio" name="chunks-size" id="2000-words">
                            <label class="radio-label" for="2000-words">2000 Words</label>
                        </li>
                        <li>
                            <input class="filter" data-filter=".all" type="radio" name="chunks-size" id="all-topics" checked>
                            <label class="radio-label" for="all-topics">All</label>
                        </li>
                    </ul>
                </div>
                <div class="cd-filter-block">
                    <h4>Number of Topics</h4>
                    <ul class="cd-filter-content cd-filters list">
                        <li>
                            <input class="filter" data-filter=".25" type="radio" name="topic-number" id="25-topics">
                            <label class="radio-label" for="25-topics">25 Topics</label>
                        </li>
                        <li>
                            <input class="filter" data-filter=".40" type="radio" name="topic-number" id="40-topics">
                            <label class="radio-label" for="40-topics">40 Topics</label>
                        </li>
                        <li>
                            <input class="filter" data-filter=".55" type="radio" name="topic-number" id="55-topics">
                            <label class="radio-label" for="55-topics">55 Topics</label>
                        </li>
                        <li>
                            <input class="filter" data-filter=".70" type="radio" name="topic-number" id="70-topics">
                            <label class="radio-label" for="70-topics">70 Topics</label>
                        </li>
                        <li>
                            <input class="filter" data-filter=".all" type="radio" name="topic-number" id="all-topics" checked>
                            <label class="radio-label" for="all-topics">All</label>
                        </li>
                    </ul>
                </div>
                <div class="cd-filter-block">
                    <h4>Part of Speech</h4>
                    <ul class="cd-filter-content cd-filters list">
                        <li>
                            <input class="filter" data-filter=".N" type="radio" name="part-of-speech" id="noun" checked>
                            <label class="radio-label" for="noun">Noun</label>
                        </li>
                        <li>
                            <input class="filter" data-filter=".NA" type="radio" name="part-of-speech" id="noun-and-adj">
                            <label class="radio-label" for="noun-and-adj">Noun and Adj.</label>
                        </li>
                        <li>
                            <input class="filter" data-filter=".all" type="radio" name="part-of-speech" id="all-topics" checked>
                            <label class="radio-label" for="all-topics">All</label>
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
    <script type="text/javascript">
        
        var radioFilter = 
        {

            $filters: null,
            groups: [],
            outputArray: [],
            outputString: '',
            init: function()
            {
                var self = this;
                self.$filters = $('#filters');
                self.$container = $('.cd-gallery');
                self.$filters.find('.cd-filter-block').each(function()
                {
                    self.groups.push(
                    {
                        $buttons: $(this).find('.filter'),
                        active: ''
                    });
                });

                self.bindHandlers();
            },

            bindHandlers: function()
            {
                var self = this;
                self.$filters.on('click', '.filter', function(e)
                {
                    e.preventDefault();
                    var $button = $(this);
                    $button.hasClass('active') ?
                    $button.removeClass('active') : $button.addClass('active').siblings('.filter').removeClass('active');
                    $button.hasClass('active') ?
                    $button.prop('checked', false) : $button.prop('checked', true).siblings('.filter').prop('checked', false);
                    self.parseFilters();
                });
            },
            
            parseFilters: function()
            {
                var self = this;
                for(var i = 0, group; group = self.groups[i]; i++)
                {
                    group.active = group.$buttons.filter('.active').attr('data-filter') || '';
                }
        
                self.concatenate();
            },
            
            concatenate: function()
            {
                var self = this;
                self.outputString = '';
        
                for(var i = 0, group; group = self.groups[i]; i++)
                {
                    self.outputString += group.active;
                }
        
                !self.outputString.length && (self.outputString = 'all'); 
                console.log(self.outputString); 

                if(self.$container.mixItUp('isLoaded'))
                {
                    self.$container.mixItUp('filter', self.outputString);
                }
            }
        };
      
        $(function()
        {
            radioFilter.init();
            
            $('.cd-gallery').mixItUp(
            {
                controls: 
                {
                    enable: false
                },
                callbacks: 
                {
                    onMixFail: function()
                    {
                        alert('No items were found matching the selected filters.');
                    }
                },
                pagination: 
                {
                    limit: 30
                }
            });
        });
    </script>
@endsection