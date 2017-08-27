<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="/assets/img/logo-fav.png">
  <title>@yield("title")</title>
  <link rel="stylesheet" type="text/css" href="/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css" />
  <link rel="stylesheet" type="text/css" href="/assets/lib/material-design-icons/css/material-design-iconic-font.min.css" />
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link rel="stylesheet" type="text/css" href="/assets/lib/summernote/summernote.css"/>
  <link rel="stylesheet" href="/assets/css/style.css" type="text/css" />
  <link rel="stylesheet" href="/css/custom.css" type="text/css" />
</head>
<body>
  <div class="container">
    <div class="bannder-game">
      <img src="http://zuzugame.com/public/style/thietky.jpg" alt="">
    </div>
    <ul class="nav navbar-nav menu">
      <li><a href="{{ route('home') }}" class="active">@lang("others.menu_home")</a></li>
      <li><a href="#chatbox">@lang("others.menu_chat_box")</a></li>
      <li><a href="{{ route('coin.create') }}">@lang("others.menu_coin")</a></li>
      <li><a href="{{ route('cards.create') }}">@lang("others.menu_payment")</a></li>
      <li><a href="{{ route('event.tichluy') }}">@lang("others.card_storage")</a></li>
      <li><a href="#support">@lang("others.menu_support")</a></li>
    </ul>
    <div class="row">
      <div class="col-md-3">
        @include("layouts.home._login")
        @include("layouts.home._list_server")
        @include("layouts.home._list_top")
      </div>
      <div class="col-md-9 ">
        @yield("content")
      </div>
    </div>
  </div>
  <script src="/assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
  <script src="/assets/js/main.js" type="text/javascript"></script>
  <script src="/assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="/assets/lib/summernote/summernote.min.js" type="text/javascript"></script>
  <script src="/assets/lib/summernote/summernote-ext-beagle.js" type="text/javascript"></script>
  <script src="/assets/lib/parsley/parsley.min.js" type="text/javascript"></script>
  <script src="/js/custom.js" type="text/javascript"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    //initialize the javascript
    $("#post-editor").summernote({height:150});
    App.init();
  });
  </script>
</body>
</html>
