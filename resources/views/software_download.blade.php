@extends('layouts.general')

@section('title', 'Download')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/cards.css">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <link rel="stylesheet" type="text/css" href="/css/download.css">
@endsection

@section('content')
  <header class="cd-header navbar-margin">
    <div class="container">
      <h3 class="text-center">
        The Nordic Digital Humanities lab develops open source software to use in
        research. Below you can find links to download and use our software. All
        of our software is covered under the <a href="https://www.gnu.org/licenses/gpl.txt">GNU General Public License</a>.
        Please cite all necessary entities when publishing results, or incorporating
        the provided software into new software.
      </h3>
    </div>
  </header>
  <main class="cd-main-content">
    <section class="cd-gallery">
      <div class="topic-modeller-container text-center">
        <div class="row">
          <div class="card-container manual-flip offset-lg-3 col-lg-6 offset-md-2 col-md-8 col-sm-12">
            <div class="card">
              <div class="front">
                <div class="cover-short">
                  <img src="../../images/card-header.png"/>
                </div>
                <div class="content">
                  <div class="main">
                    <h3 class="name">Scandinavian Topic Modeler</h3>
                    <a href="/files/topic-modeler-1.1.1.dmg" download>
                      <img class="thumbnail" id="stm-thumbnail" src="/images/app_icon.png" alt="Scandinavian Topic Modeler Icon"\>
                    </a>
                    <p class="card-content-front"> You can download the dmg for the OSX version of the
                      Scandinavian Topic Modeler by clicking in the icon above.
                      Unfortunately, there are not currently windows nor linux
                      versions of the program, but we hope to be releasing those
                      sometime in the near future. You can find the source code
                      for this software on <a href="https://github.com/BradyHammond/Topic_Modeler">github</a>.
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
                <div class="cover-short">
                  <img src="../../images/card-header.png"/>
                </div>
                <div class="content">
                  <div class="main">
                    <div class="header">
                      <h3 class="name">Scandinavian Topic Modeler</h3>
                    </div>
                    <p class="card-content-back">The Scandinavian Topic Modeler is a tool developed to
                      topic model English, Danish, Norwegian, and Swedish
                      corpora. The program was developed by Brigham Young
                      University's Nordic Digital Humanities Lab. It features a
                      GUI that allows the user to quickly customize and run
                      topic models. Topic models generated through the program
                      produce word clouds for each topic, scatterplots of topic
                      distribution, chunked passages (if applicable), and csv
                      files containing the models' raw data.
                    </p>
                  </div>
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
      </div>
    </section>
  </main>
@endsection

@section('scripts')
  <script src="/js/modernizr.js"></script>
  <script src="/js/jquery.mixitup.min.js"></script>
  <script src="/js/jquery.mixitup-pagination.min.js"></script>
  <script src="/js/main.js"></script>
  <script type="text/javascript" src="/dotdotdot/src/jquery.dotdotdot.js"></script>
  <script type="text/javascript">
    var elements = {};
    $(document).ready(function()
    {
      $(".name").dotdotdot({
        watch: true
      });

      $(".card-content-back").dotdotdot({
        watch: true
      });

      $(".card-content-front").dotdotdot({
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
