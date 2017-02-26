@extends('layouts.general')

@section('title', 'Test')
@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" >
    <link rel="stylesheet" type="text/css" href="../../css/app.css"> 
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <link rel="stylesheet" type="text/css" href="../../css/cards.css">
@endsection

@section('content')
<!--===== JUMBOTRON =====-->
    <div class="jumbotron jumbotron-default-background after_navbar">
        <div class="container">
            <h3>
                Topic modeling uses statistical algorithms to discover the latent semantic structures in an extensive text body. This project focuses on the work of a single author, Selma Lagerlöf, to test the uses and limits of topic modeling. All of the topic models generated from this research are listed below. For your convenience we have included the following filters to help you find the topics you're looking for.
            </h3>
            <br>
            <div class="col-md-8 offset-md-2 col-sm-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">
                            Filters
                        </h3> 
                    </div> 
                    <div class="panel-body">
                        <div class="container">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <h4>
                                        Chunk Size
                                    </h4>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="1000-words" checked data-toggle="toggle">
                                                1000 Words
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="1500-words" checked data-toggle="toggle">
                                                1500 Words
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="2000-words" checked data-toggle="toggle">
                                                2000 Words
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <h4>
                                    Number of Topics
                                </h4>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="25-topics" checked data-toggle="toggle">
                                            25 Topics
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="40-topics" checked data-toggle="toggle">
                                            40 Topics
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="55-topics" checked data-toggle="toggle">
                                            55 Topics
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="70-topics" checked data-toggle="toggle">
                                            70 Topics
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <h4>
                                    Part of Speech
                                </h4>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="nouns-only" checked data-toggle="toggle">
                                           Noun Only
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="nouns-and-adjectives" checked data-toggle="toggle">
                                            Noun & Adj.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
 
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js">
    </script>
    <script>
        $(function() {
            $('#1000-words').bootstrapToggle();
        })
    </script>
@endsection