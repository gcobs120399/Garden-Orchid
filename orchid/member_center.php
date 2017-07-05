<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();

//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
  header("Location: index.php");
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
  unset($_SESSION["loginMember"]);
  unset($_SESSION["memberLevel"]);
  header("Location: index.php");
}
//繫結登入會員資料
$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
$RecMember = mysql_query($query_RecMember);
$row_RecMember=mysql_fetch_assoc($RecMember);
?>
<html lang="en">
<head>
<title>蘭花管理系統</title>
<!--呆的巡覽列-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link href="./css/navbar-fixed-top.css" rel="stylesheet"> 
<!--[if lt IE 9]><script src=~/Scripts/AssetsBS3/ie8-responsive-file-warning.js></script><![endif]-->
<script src="./js/ie-emulation-modes-warning.js"></script> 
<link rel="icon" href="./img/title.png">
<!--[if lt IE 9]><script src=https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js></script><script src=https://oss.maxcdn.com/respond/1.4.2/respond.min.js></script><![endif]-->
<!--呆-->

  <!-- 最新編譯和最佳化的 CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <!-- 選擇性佈景主題 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <!-- 最新編譯和最佳化的 JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
  <link href="style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS+頂端-->
</head>
<body style="text-align:left;font-size:18px;background-image: url(img/46505.png);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">

<!--巡覽列black-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header"> 
     <a class="navbar-brand" href="member_center.php" style="font-size: 24pt;">應用物聯網技術之蘭園智慧生產管理與知識系統</a>
    </div>
  </div>
</nav>
<!--巡覽列white-->
<nav class="navbar navbar-default navbar-fixed-top" style="top: 50px;" role="navigation">
  <div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> 
          <span class="sr-only">Toggle navigation</span> 
          <span class="icon-bar"></span> 
          <span class="icon-bar"></span> 
          <span class="icon-bar"></span> 
        </button>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="member_center.php">首頁</a></li>
        <li><a href="GMM.php">溫室管理</a></li>
        <li><a href="SM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="prediction.php">生長預測</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class=" col-xs-2 col-md-2">
 <!--旁邊菜單nav_burger
 <nav class="burger">
      <a href="#" class="burger__button" id="burger-button">
        <span class="burger__button__icon"></span>
      </a>
      <ul class="burger__menu">
        <li><a href="member_center.php">首頁</a></li>
        <li><a href="GMM.php">溫室管理</a></li>
        <li><a href="DMM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
      </ul>
    </nav>-->
</div>


<div class="container col-xs-8 col-md-8">
  <!--內文-->
    <h1 style="text-align:center;">應用物聯網技術之蘭園智慧生產管理與知識系統</h1>
    <!--按鈕
    <div style="text-align:center;">
      <input type="button" class="btn btn-info btn-lg" size="300" value="溫室管理" onclick="location.href='GMM.php'">
      <input type="button" class="btn btn-info btn-lg" size="12" value="設備管理" onclick="location.href='SM.php'">
      <input type="button" class="btn btn-info btn-lg" size="12" value="作物管理" onclick="location.href='CM.php'">
      <input type="button" class="btn btn-info btn-lg" size="12" value="生產履歷" onclick="location.href='PH2.php'">
      <input type="button" class="btn btn-info btn-lg" size="12" value="溫室環境監控" onclick="location.href='GEMM.php'">
      <input type="button" class="btn btn-info btn-lg" size="12" value="日誌" onclick="location.href='Diary.php'">
    </div>-->

    <hr>
    <div style="background: rgba(100%,100%,100%,0.6); margin: 0 auto;"><!--div放白色背景透明度60%開始-->

        <div style="text-align: center"><h3><img src="img/LOGO.png" alt="LOGO" width="80" height="50">會員系統</h3></div>
      
        <div style="margin-left:0px auto;margin-right:0px auto;">
          <div style="display: table-cell;vertical-align: middle;">
            <p class="title">歡迎光臨網站會員系統</p>
              <p class="heading"> 本會員系統擁有以下的功能：</p>
              <ol>
                <li>免費加入會員 。</li>
                <li>每個會員可修改本身資料。</li>
                <li>若是遺忘密碼，會員可由系統發出電子信函通知。</li>
                <li>管理者可以修改、刪除會員的資料。</li>
              </ol>
              <p class="heading">請各位會員遵守以下規則： </p>
              <ol>
                <li> 遵守政府的各項有關法律法規。</li>
                <li> 不得在發佈任何色情非法， 以及危害國家安全的言論。</li>
                <li>嚴禁連結有關政治， 色情， 宗教， 迷信等違法訊息。</li>
                <li> 承擔一切因您的行為而直接或間接導致的民事或刑事法律責任。</li>
                <li> 互相尊重， 遵守互聯網絡道德；嚴禁互相惡意攻擊， 漫罵。</li>
                <li> 管理員擁有一切管理權力。</li>
              </ol>
          </div>

              <div style="display: table-cell;vertical-align: middle;">
                <p class="heading"><strong>會員系統</strong></p>
                <p><strong><?php echo $row_RecMember["m_name"];?></strong> 您好。</p>
                <p>您總共登入了 <?php echo $row_RecMember["m_login"];?> 次。<br>
                    本次登入的時間為：<br>
                <?php echo $row_RecMember["m_logintime"];?></p>
                <a href="member_update.php">修改資料</a> | <a href="?logout=true">登出系統</a>
              </div>
        </div>

  <footer align="center">
    © 2016 農業物聯生產管理系統 ©
  </footer>
</div><!--div放白色透明度60%結束-->

  
</div>
<!--呆的巡覽列-->
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/ie10-viewport-bug-workaround.js"></script>
<!--呆-->
</body>


<script type="text/javascript">/*這為左邊菜單的JS，來源http://codepen.io/vkbansal/pen/QbapGz*/
  'use strict';
var burger = document.getElementById('burger-button');
burger.addEventListener('click', function (e) {
    e.preventDefault();
    document.body.classList.toggle('open');
    burger.classList.toggle('open');
});
</script>
</html>
