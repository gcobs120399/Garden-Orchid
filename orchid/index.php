<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入，若有登入則重新導向
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
  //若帳號等級為 member 則導向會員中心
  if($_SESSION["memberLevel"]=="member"){
    header("Location: member_center.php");
  //否則則導向管理中心
  }else{
    header("Location: member_admin.php");
  }
}
//執行會員登入
if(isset($_POST["username"]) && isset($_POST["passwd"])){
  //繫結登入會員資料
  $query_RecLogin = "SELECT * FROM `memberdata` WHERE `m_username`='".$_POST["username"]."'";
  $RecLogin = mysql_query($query_RecLogin);
  //取出帳號密碼的值
  $row_RecLogin=mysql_fetch_assoc($RecLogin);
  $username = $row_RecLogin["m_username"];
  $passwd = $row_RecLogin["m_passwd"];
  $level = $row_RecLogin["m_level"];
  //比對密碼，若登入成功則呈現登入狀態
  if(md5($_POST["passwd"])==$passwd){
    //計算登入次數及更新登入時間
    $query_RecLoginUpdate = "UPDATE `memberdata` SET `m_login`=`m_login`+1, `m_logintime`=NOW() WHERE `m_username`='".$_POST["username"]."'";
    mysql_query($query_RecLoginUpdate);
    //設定登入者的名稱及等級
    $_SESSION["loginMember"]=$username;
    $_SESSION["memberLevel"]=$level;
    //使用Cookie記錄登入資料
    if(isset($_POST["rememberme"])&&($_POST["rememberme"]=="true")){
      setcookie("remUser", $_POST["username"], time()+365*24*60);
      setcookie("remPass", $_POST["passwd"], time()+365*24*60);
    }else{
      if(isset($_COOKIE["remUser"])){
        setcookie("remUser", $_POST["username"], time()-100);
        setcookie("remPass", $_POST["passwd"], time()-100);
      }
    }
    //若帳號等級為 member 則導向會員中心
    if($_SESSION["memberLevel"]=="member"){
      header("Location: member_center.php");
    //否則則導向管理中心
    }else{
      header("Location: member_admin.php");
    }
  }else{
    header("Location: index.php?errMsg=1");
  }
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>腎藥蘭花管理系統</title>
<link rel="icon" href="./img/title.png">
<!--呆-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./css/bootstrap.min.css" rel="stylesheet">
<!--<link href="./css/navbar-fixed-top.css" rel="stylesheet">造成網頁可以上下移動-->
<!--[if lt IE 9]><script src=~/Scripts/AssetsBS3/ie8-responsive-file-warning.js></script><![endif]-->
<script src="./js/ie-emulation-modes-warning.js"></script> 
<!--[if lt IE 9]><script src=https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js></script><script src=https://oss.maxcdn.com/respond/1.4.2/respond.min.js></script><![endif]-->
<!--呆-->

  <!-- 最新編譯和最佳化的 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <!-- 選擇性佈景主題 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <!-- 最新編譯和最佳化的 JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS-->
</head>
<body style="text-align:left;font-size:18px;background-image: url(img/46505.png);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">

<!--巡覽列nav-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> 
        <span class="sr-only">Toggle navigation</span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span> 
      </button> 
      <a class="navbar-brand" href="index.php">基於物聯網與KNN技術之腎藥蘭園監測及智慧生產管理系統</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">首頁</a></li>
        <li><a href="Diary_c.php">日誌</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php">登入 </a></li>
      <li><a href="member_join.php">註冊</a></li>
      </ul>
    </div>
  </div>
</nav>
<br><br>
<h1 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="80" height="50">基於物聯網與KNN技術之腎藥蘭園監測及智慧生產管理系統</h1>
<div class="col-xs-2"></div>
<div style="background: rgba(100%,100%,100%,0.6);" class="col-xs-12"><!--div放白色背景透明度60%開始-->
<table width="550" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td class="tdbline"><h2>會員系統</h2></td>
  </tr>
  <tr>
    <td class="tdbline">
    <table width="100%" border="5">
      <tr valign="top">
        <!--<td class="tdrline"><p class="title">歡迎光臨農業物聯生產管理系統</p>
          <p>感謝各位來到腎藥蘭花管理系統， 所有的會員功能都必須經由登入後才能使用，請您在右方視窗中執行登入動作。</p>
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
          </ol></td>-->
        <td width="200">
        <div class="boxtl col-xs-12"></div><div class="boxtr"></div>
  <div class="col-xs-12"><?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
    <div class="col-xs-12"><font color="red">登入帳號或密碼錯誤！</font></div>
    <?php }?>
    <p class="heading" style="font-size: 28px; text-align: center;">登入會員系統</p>
    <form name="form1" method="post" action="" style="font-size: 20px; text-align: center;">
    <p><strong>帳號：</strong>
      <input name="username" type="text" id="username" value="<?php if(isset($_COOKIE["remUser"])){echo $_COOKIE["remUser"];}?>">
    </p>
    <p><strong>密碼：</strong>
      <input name="passwd" type="password" id="passwd" value="<?php if(isset($_COOKIE["remPass"])){echo $_COOKIE["remPass"];}?>">
    </p>
    <p>
      <input name="rememberme" type="checkbox" id="rememberme" value="true" checked>記住我的帳號密碼。</p>
    <p align="center" >
      <input type="submit" name="button" class="btn btn-info" id="button" value="登入系統">
    </p>
    </form>
    <!--p align="center" style="font-size: 20px; text-align: center;"><a href="admin_passmail.php">忘記密碼，補寄密碼信。</a></p>-->
    <hr size="1">
    <p class="heading" style="font-size: 20px;">還沒有會員帳號?</p>
    <p  style="font-size: 20px;">註冊帳號免費又容易</p>
    <p align="right" style="font-size: 20px;"><a href="member_join.php">馬上申請會員</a></p>
</div>
    <div class="col-xs-12"></div><div class="col-xs-12"></div></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td align="center" background="images/album_r2_c1.jpg" class="trademark" style="font-size: 18px;">© 2016 腎藥蘭花管理系統 ©</td>
  </tr>
</table>
</div><!--div放白色背景透明度60%結束-->
<!--呆-->
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
