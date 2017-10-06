@extends('layouts.general')

@section('title', 'Blog')
@section('stylesheets')
  <link rel="stylesheet" type="text/css" href="/css/app.css">
  <link rel="stylesheet" type="text/css" href="/css/main.css">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
@endsection

@section('content')
	<header class="cd-header after-navbar">
		<div class="container">
			<h3 class="text-center">
				Research requires a great deal of time and effort. This blog serves to document the effort that went into the {{ $project->project_name }}. If you are interested in viewing the actual results of this research click the Project Page button below.
			</h3>
      <div class="text-center">
        @if ($project->view === null)
          <button type="button" class="btn btn-lg btn-primary" disabled>
            Project Page
          </button>
        @else
          <a class="btn btn-lg btn-primary" href="/projects/{{ $project->project_id }}/{{ $project->project_name }}">
            Project Page
          </a>
        @endif
      </div>
		</div>
	</header>
  <main class="cd-main-content">
    <div class="cd-tab-filter-wrapper">
      <div class="cd-tab-filter">
      </div>
    </div>
    <section class="cd-gallery">
      @if($post == null)
        <div class="blog-fail-message">It doesn't look like the post you're looking for exists.</div>
      @else
        <div class="text-center blog-entry-container">
          <div class="card text-left container blog-card" id="{{$post->blog_entry}}">
            <div class="card-body">
              <div class="card-date">
                {{date_format(new DateTime($post->last_updated), 'l, jS F Y g:iA')}}
              </div>
              <div class="card-title">{{$post->entry_title}}</div>
              @if($post->image_path != "")
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-5">
                    <image src="{{asset('storage' . str_replace('public', '', $post->image_path))}}" alt="Blog Image">
                  </div>
                  <div class="col-xs-12 col-sm-12 col-md-7">
                    <p class="card-content-full-text hidden">{{$post->entry_content}}</p>
                    <p>{{$post->entry_content}}</p>
                  </div>
                </div>
              @else
                <div>
                  <p class="card-content-full-text hidden">{{$post->entry_content}}</p>
                  <p>{{$post->entry_content}}</p>
                </div>
              @endif
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 blog-button-group">
                  @if(Auth::check())
                    <div class="btn-group btn-group-lg">
                      <button type="button" onclick="editBlogPost(this)" class="btn btn-default">
                        Edit
                      </button>
                      <button type="button" onclick="window.location.href='/blogs/{{$project->project_id}}/{{$project->project_name}}/sql_delete/{{$post->blog_entry}}'" class="btn btn-default">
                        Delete
                      </button>
                    </div>
                  @endif
                </div>
                <div class="col-md-6 blog-name">
                  –{{str_replace('_', ' ', $post->authors)}}
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
      @if(Auth::check())
        <div class="text-center input-container">
          <button class="btn btn-default btn-lg" onclick="showBlogInput(this)">
              Add a New Post
          </button>
        </div>
      @endif
    </section>
    <div class="cd-filter">
      <form id="filters">
        <div class="cd-filter-block">
          <ul class="cd-filter-content cd-filters list">
            <li>
              <input class="filter" type="radio" name="post" id="all" onClick="window.location='/blogs/{{ $project->project_id }}/{{ $project->project_name }}'">
              <label class="radio-label" for="all">All</label>
            </li>
            @foreach($entries as $entry)
              <li>
                @if($entry->blog_entry == $blog_entry)
                  <input class="filter" type="radio" name="post" id="entry_{{$entry->blog_entry}}" onClick="window.location='/blogs/{{ $project->project_id }}/{{ $project->project_name }}/{{ $entry->blog_entry }}'" checked>
                @else
                  <input class="filter" type="radio" name="post" id="entry_{{$entry->blog_entry}}" onClick="javascript:window.location='/blogs/{{ $project->project_id }}/{{ $project->project_name }}/{{ $entry->blog_entry }}'; return false;">
                @endif
                <label class="radio-label" for="entry_{{$entry->blog_entry}}">{{$entry->last_updated}}</label>
              </li>
            @endforeach
          </ul>
        </div>
      </form>
      <a href="#0" class="cd-close">Close</a>
    </div>
    <a href="#0" class="cd-filter-trigger">Posts</a>
  </main>
@endsection

@section('scripts')
  <script src="/js/modernizr.js"></script>
  <script src="/js/jquery.mixitup.min.js"></script>
  <script src="/js/jquery.mixitup-pagination.min.js"></script>
  <script src="/js/main.js"></script>
  <script type="text/javascript">

    @if (Auth::check())
      var original_elements = {};
      function editBlogPost(element)
      {
        var card = element.parentNode.parentNode.parentNode.parentNode.parentNode;
        var parent = card.parentNode;
        var date = element.parentNode.parentNode.parentNode.parentNode.children[0].innerHTML;
        var title = element.parentNode.parentNode.parentNode.parentNode.children[1].innerHTML;
        var image_path = "http://placehold.it/200x100?text=Upload+Image";
        var content = "";
        var file_name = "Click To Choose File";
        if(typeof element.parentNode.parentNode.parentNode.parentNode.children[2].children[0].children[0] !== "undefined")
        {
          image_path = element.parentNode.parentNode.parentNode.parentNode.children[2].children[0].children[0].src;
          file_name = image_path.substring(image_path.lastIndexOf("/") + 1, image_path.length);
          content = element.parentNode.parentNode.parentNode.parentNode.children[2].children[1].children[0].innerHTML;
        }

        else
        {
          content = element.parentNode.parentNode.parentNode.parentNode.children[2].children[0].innerHTML;
        }

        var author = element.parentNode.parentNode.parentNode.parentNode.children[3].children[1].innerHTML.trim();
        if(author != "–{{Auth::user()->first_name}} {{Auth::user()->last_name}}")
        {
          author = author + ", {{Auth::user()->first_name}} {{Auth::user()->last_name}}";
        }

        var edit_card = '<form class="form-horizontal" id="' + card.id + '" role="form" ' +
        'method="POST" action="/blogs/{{$project->project_id}}/{{$project->project_name}}/sql_update/' + author.substring(1).replace(/\s/g , "_") + '/' + card.id + '" enctype="multipart/form-data">' +
        '{{ csrf_field() }}<div class="card text-left container blog-card">' +
        '<div class="card-body"><div class="card-date">'+ date +
        '</div><div class="row"><div class="col-xs-12 col-sm-12 col-md-12">' +
        '<input name="title" type="text" class="form-control title-input" ' +
        'placeholder="Enter Title" value="' + title + '"></div></div><div class="row"><div ' +
        'class="col-xs-12 col-sm-12 col-md-5"><table id="images" class="table ' +
        'table-striped table-bordered table-hover upload-table"><thead><tr>' +
        '<td class="text-center" id="upload-header">Upload File</td></tr>' +
        '</thead><tbody><tr><td class="text-center" id="upload-body"><div ' +
        'class="image-upload"><label for="file" class="file-label"><img ' +
        'src="http://placehold.it/200x100?text=Upload+Image" class="img-thumbnail" rel="tooltip" ' +
        'data-toggle="tooltip" data-trigger="hover" data-placement="right" ' +
        'data-html="true" data-title="' + file_name + '"></label><input ' +
        'type="file" name="uploaded_images" size="20" multiple="" id="file" ' +
        'onchange="fileSelected(this)"><p class="text-mute" id="file-name">' +
        file_name + '</p></div></td></tr></tbody></table></div><div ' +
        'class="col-xs-12 col-sm-12 col-md-7"><textarea name="content" ' +
        'class="form-control content-input" placeholder="Enter Content">' +
        content + '</textarea></div></div><div class="row"><div class="col-xs-12 ' +
        'col-sm-12 col-md-6 blog-button-group"><div class="btn-group ' +
        'btn-group-lg"><button type="submit" value="Submit" ' +
        'form="' + card.id + '" class="btn btn-default">Submit</button><button ' +
        'type="button" onclick="restart()" class="btn btn-default">Clear' +
        '</button><button type="button" onclick="closeEdit(this, ' + card.id + ')" class="btn ' +
        'btn-default">Cancel</button></div></div><div class="col-md-6 blog-name">' +
        author + '</div></div></div></div></form>';
        original_elements[card.id]=card;
        $(card).replaceWith(edit_card);
      }

      function closeEdit(element, index)
      {
        $("#" + index).replaceWith(original_elements[index]);
      }
      function showBlogInput(element)
      {
        var parent = element.parentNode;
        var text = element.innerHTML;

        saved_element = element.outerHTML;
        element.remove();

        var csrf_field = '{{ csrf_field() }}'
        csrf_field.replace(/"/g, "'");

        var date_object = new Date();
        var day_of_week;
        var month;
        var hour;
        var minute;
        var am_pm;
        switch (date_object.getDay())
        {
          case 0:
            day_of_week = "Sunday";
            break;
          case 1:
            day_of_week = "Monday";
            break;
          case 2:
            day_of_week = "Tuesday";
            break;
          case 3:
            day_of_week = "Wednesday";
            break;
          case 4:
            day_of_week = "Thursday";
            break;
          case 5:
            day_of_week = "Friday";
            break;
          case 6:
            day_of_week = "Saturday";
        }

        switch (date_object.getMonth())
        {
          case 0:
            month = "January";
            break;
          case 1:
            month = "February";
            break;
          case 2:
            month = "March";
            break;
          case 3:
            month = "April";
            break;
          case 4:
            month = "May";
            break;
          case 5:
            month = "June";
            break;
          case 6:
            month = "July";
            break;
          case 7:
            month = "August";
            break;
          case 8:
            month = "September";
            break;
          case 9:
            month = "October";
            break;
          case 10:
            month = "November";
            break;
          case 11:
            month = "December";
        }

        switch (date_object.getHours())
        {
          case 0:
            hour = "12";
            am_pm = "AM";
            break;
          case 1:
            hour = "01";
            am_pm = "AM";
            break;
          case 2:
            hour = "02";
            am_pm = "AM";
            break;
          case 3:
            hour = "03";
            am_pm = "AM";
            break;
          case 4:
            hour = "04";
            am_pm = "AM";
            break;
          case 5:
            hour = "05";
            am_pm = "AM";
            break;
          case 6:
            hour = "06";
            am_pm = "AM";
            break;
          case 7:
            hour = "07";
            am_pm = "AM";
            break;
          case 8:
            hour = "08";
            am_pm = "AM";
            break;
          case 9:
            hour = "09";
            am_pm = "AM";
            break;
          case 10:
            hour = "10";
            am_pm = "AM";
            break;
          case 11:
            hour = "11";
            am_pm = "AM";
          case 12:
            hour = "12";
            am_pm = "PM";
            break;
          case 13:
            hour = "01";
            am_pm = "PM";
            break;
          case 14:
            hour = "02";
            am_pm = "PM";
            break;
          case 15:
            hour = "03";
            am_pm = "PM";
            break;
          case 16:
            hour = "04";
            am_pm = "PM";
            break;
          case 17:
            hour = "05";
            am_pm = "PM";
            break;
          case 18:
            hour = "06";
            am_pm = "PM";
            break;
          case 19:
            hour = "07";
            am_pm = "PM";
            break;
          case 20:
            hour = "08";
            am_pm = "PM";
            break;
          case 21:
            hour = "09";
            am_pm = "PM";
            break;
          case 22:
            hour = "10";
            am_pm = "PM";
            break;
          case 23:
            hour = "11";
            am_pm = "PM";
        }

        minute = "0" + date_object.getMinutes();
        minute = minute.substr(minute.length-2);
        var day = date_object.getDate();
        var year = date_object.getFullYear();

        var test = '<form class="form-horizontal" id="blog-input" role="form" ' +
        'method="POST" action="/blogs/{{$project->project_id}}/{{$project->project_name}}/sql_update/{{Auth::user()->first_name . "_" . Auth::user()->last_name}}" enctype="multipart/form-data">' +
        '{{ csrf_field() }}<div class="card text-left container blog-card">' +
        '<div class="card-body"><div class="card-date">'+ day_of_week + ', ' +
        day + ' ' + month + ' ' +year + ' ' + hour + ':' + minute + ' ' + am_pm +
        '</div><div class="row"><div class="col-xs-12 col-sm-12 col-md-12">' +
        '<input name="title" type="text" class="form-control title-input" ' +
        'placeholder="Enter Title"></div></div><div class="row"><div ' +
        'class="col-xs-12 col-sm-12 col-md-5"><table id="images" class="table ' +
        'table-striped table-bordered table-hover upload-table"><thead><tr>' +
        '<td class="text-center" id="upload-header">Upload File</td></tr>' +
        '</thead><tbody><tr><td class="text-center" id="upload-body"><div ' +
        'class="image-upload"><label for="file" class="file-label"><img ' +
        'src="http://placehold.it/200x100" class="img-thumbnail" rel="tooltip" ' +
        'data-toggle="tooltip" data-trigger="hover" data-placement="right" ' +
        'data-html="true" data-title="Click To Choose File"></label><input ' +
        'type="file" name="uploaded_images" size="20" multiple="" id="file" ' +
        'onchange="fileSelected(this)"><p class="text-mute" id="file-name">' +
        'Click To Choose File</p></div></td></tr></tbody></table></div><div ' +
        'class="col-xs-12 col-sm-12 col-md-7"><textarea name="content" ' +
        'class="form-control content-input" placeholder="Enter Content">' +
        '</textarea></div></div><div class="row"><div class="col-xs-12 ' +
        'col-sm-12 col-md-6 blog-button-group"><div class="btn-group ' +
        'btn-group-lg"><button type="submit" value="Submit" ' +
        'form="blog-input" class="btn btn-default">Submit</button><button ' +
        'type="button" onclick="restart()" class="btn btn-default">Restart' +
        '</button><button type="button" onclick="cancel()" class="btn ' +
        'btn-default">Cancel</button></div></div><div class="col-md-6 blog-name">' +
        '–{{Auth::user()->first_name}} ' +
        '{{Auth::user()->last_name}}</div></div></div></div></form>';
        $(parent).append(test);
      };
    @endif

    function cancel()
    {
      $("#blog-input").replaceWith("<div class='text-center input-container'>" +
        "<button class='btn btn-default btn-lg' onclick='showBlogInput(this)'>" +
        "Add a New Post</button></div>");
    };

    function restart()
    {
      $("#file").val("");
      $("#file-name").html("Click to Choose File");
      $(".title-input").val("");
      $(".content-input").val("");
    }

    function fileSelected(element)
    {
      var file_name = $(element).val();
      if (file_name == "")
      {
        $("#file-name").html("Click to Choose File");
      }

      else
      {
        file_name = file_name.substring(file_name.lastIndexOf("\\") + 1, file_name.length);
        $("#file-name").html(file_name);
      }
    };
  </script>
@endsection
