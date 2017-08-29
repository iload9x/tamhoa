<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <link rel="Shortcut Icon" href="favicon.ico" />
  <link rel="Bookmark" href="favicon.ico" />
  <script src="/{{ \App\Helpers\AssetHelper::path() }}assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="/{{ \App\Helpers\AssetHelper::path() }}game/js/swfobject.js" type="text/javascript"></script>
  <script src="/{{ \App\Helpers\AssetHelper::path() }}game/js/rightclick.js" type="text/javascript"></script>
  <script src="/{{ \App\Helpers\AssetHelper::path() }}game/js/swffit.js" type="text/javascript"></script>
  <link rel="stylesheet" href="/{{ \App\Helpers\AssetHelper::path() }}game/css/style.css">
  <script type="text/javascript">
    $(document).ready(function() {
      $("#flashcontent").height($(window).height() - $(".playgame-menu").height() - 3);
    });
  </script>
  <title>{{ $info_server["title"] }} - TamHoa2.Top</title>
  <script type="text/javascript">
    function navigateToSignIn(){window.onbeforeunload=null;window.location.href='/';}
    var flashvars = {
    enterAccount:"{{ $info_server['enterAccount'] }}",
    matkhau:"{{ md5($info_server['enterAccount']) }}",
    enterIp:"{{ $info_server['ip'] }}",
    enterPort:"{{ $info_server['port'] }}",
    serverId:"1",
    fileUrl:"/{{ \App\Helpers\AssetHelper::path() }}client/",
    rechargeUrl:"/",
    bbsUrl:"/",
    homeUrl:"/"};
    var params = {
    menu:"false",scale:"noScale"};
    swfobject.embedSWF("/{{ \App\Helpers\AssetHelper::path() }}client/dynamic/version0/GameLoader.swf", "customRightClick", "100%", "100%", "9.0.0", "expressInstall.swf", flashvars, params);
  </script>
</head>
<body bgcolor="#000000" style="margin:0;height:100vh;">
  <div class="playgame-menu">
    <ul class="menu">
      @include("layouts.home._menu_items")
    </ul>
  </div>
  <div id="flashcontent" scroll="no" onload="RightClick.init();" style="height: 100%">
  <div id="customRightClick">
    <p>FLASH quá cũ, Hãy cập nhật để chơi</p>
    <p><a href="http://www.adobe.com/go/getflashplayer">
      <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
    </a></p>
  </div>
  </div>
</body>
</html>
