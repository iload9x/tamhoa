<i>
  


  
</i>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <link rel="Shortcut Icon" href="favicon.ico" />
  <link rel="Bookmark" href="favicon.ico" />
  <script src="/game/js/swfobject.js" type="text/javascript"></script>
  <script src="/game/js/rightclick.js" type="text/javascript"></script>
  <script src="/game/js/swffit.js" type="text/javascript"></script>
  <title>{{ $info_server["title"] }} - TamHoa2.Top</title>
  <script type="text/javascript">
    function navigateToSignIn(){window.onbeforeunload=null;window.location.href='/';}
    var flashvars = {
    enterAccount:"{{ $info_server['enterAccount'] }}",
    matkhau:"{{ md5($info_server['enterAccount']) }}",
    enterIp:"{{ $info_server['ip'] }}",
    enterPort:"{{ $info_server['port'] }}",
    serverId:"1",
    fileUrl:"/client/",
    rechargeUrl:"/",
    bbsUrl:"/",
    homeUrl:"/"};
    var params = {
    menu:"false",scale:"noScale"};
    swfobject.embedSWF("/client/dynamic/version0/GameLoader.swf", "customRightClick", "100%", "100%", "9.0.0", "expressInstall.swf", flashvars, params);
  </script>
</head>
<body id="flashcontent" scroll="no" onload="RightClick.init();" bgcolor="#000000" style="margin:0;height:100vh;"><div class="se-pre-con" id="se-pre-con"></div>
  <div id="customRightClick">
    <p>FLASH quá cũ, Hãy cập nhật để chơi</p>
    <p><a href="http://www.adobe.com/go/getflashplayer">
      <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
    </a></p>
  </div>
  <div style="display:block;position:absolute;z-order=-100"></div>
</body>
</html>
