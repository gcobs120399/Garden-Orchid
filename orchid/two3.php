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
<!DOCTYPE html>
<html>
<title>腎藥蘭花管理系統</title>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-indigo.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="https://fonts.googleapis.com/css?family=Fira+Sans:900" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="icon" href="./img/title.png">

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./css/bootstrap.min.css" rel="stylesheet">


<script src="./js/ie-emulation-modes-warning.js"></script> 



  <!-- 最新編譯和最佳化的 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <!-- 選擇性佈景主題 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <!-- 最新編譯和最佳化的 JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS-->

</head>
<style>
body,p,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
    background-image: url(img/4.jpg);
    min-height: 100%;
    background-position: center;
    background-size: cover;
}

p{font-family: 'Fira Sans', sans-serif;}
#ayy {filter:alpha(opacity=90);-moz-opacity:0.9;opacity:0.9; -khtml-opacity: 0.9; display:none; margin:auto; width:300px; 
    height:350px; background-Color:white; border:3px solid #717171; 
    float:left;  position: fixed; top: 30%;left: 40%;}
#p1{padding-left: 50px;}
#clo {float:right; margin:0px 0px 10px 0; }
#but{background:white;opacity: 0.9;border:0px none;}

</style>
<body>


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> 
        <span class="sr-only">Toggle navigation</span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span> 
      </button> 
      <a class="navbar-brand" href="">基於物聯網與KNN技術之腎藥蘭園監測及智慧生產管理系統</a>
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

<div class="bgimg w3-display-container w3-animate-opacity" id="main" style="margin-left: 0px;">

  <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top" style="color: black;"><img src="img/LOGO.png" alt="LOGO" width="80" height="50"><b>
腎藥蘭花管理系統</h1>
    <hr class="w3-border-white" style="margin:auto;width:100%">
    <p class=" w3-center w3-text-black" style="font-size:30px"><button class="w3-btn w3-border w3-round-large"  onclick="document.getElementById('id01').style.display='block'" ><b>Login</button></p>
  </div>
</div>

<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:450px">
  
      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
        <img src="img/img_avatar4.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
      </div>

      <form name="form" class="w3-container" method="post" action="">
      <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
        <font color="red">登入帳號或密碼錯誤！</font>
      <?php }?>
        <div class="w3-section" >
          <label><b>帳號：</b></label>
          <input class="w3-input w3-border w3-margin-bottom" name="username" type="text" id="username" value="<?php if(isset($_COOKIE["remUser"])){echo $_COOKIE["remUser"];}?>" required>
          <label><b>密碼：</b></label>
          <input class="w3-input w3-border" name="passwd" type="password" id="passwd" required value="<?php if(isset($_COOKIE["remPass"])){echo $_COOKIE["remPass"];}?>">
          <input class="w3-check w3-margin-top" name="rememberme" type="checkbox" checked="checked">記住帳號密碼</p>
          <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">登入系統</button>
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <!--<span class="w3-right w3-padding w3-hide-small"><a href="admin_passmail.php">忘記密碼</a></span>&nbsp; &nbsp;-->
        <span class="w3-right w3-padding w3-hide-small"><a href="member_join.php"align="right">註冊</a>
      </div>
    </div>
  </div>
<!-- 下面是显示模板 

  <div id="ayy">
  <div id="clo">
  <button onClick="forclose();" id="but">X</button>
  </div>
    <div width="300" height="100" class="content">
      <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
    <font color="red">登入帳號或密碼錯誤！</font>
    <?php }?>
    <p class="heading" id="p1">登入會員系統</p>
    <form name="form1" method="post" action="">
    <p id="p1"><strong>帳號：</strong>
      <br>
      <input name="username" type="text" id="username" value="<?php if(isset($_COOKIE["remUser"])){echo $_COOKIE["remUser"];}?>">
    </p>
    <p id="p1"><strong>密碼：</strong><br>
      <input name="passwd" type="password" id="passwd" value="<?php if(isset($_COOKIE["remPass"])){echo $_COOKIE["remPass"];}?>">
    </p>
    <p id="p1">
      <input name="rememberme" type="checkbox" id="rememberme" value="true" checked>記住帳號密碼</p>
    <p align="center">
      <input type="submit" name="button" class="btn btn-info" id="button" value="登入系統">
    </p>
    </form>
    <hr size="1">
    <p align="center"><a href="admin_passmail.php">忘記密碼</a>&nbsp; &nbsp;
    <a href="member_join.php"align="right">註冊</a></p>
</div>
</div>-->
<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "180px";
  document.getElementById("mySidebar").style.width = "180px";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
function forfopen() {
var div = document.getElementById("ayy");
div.style.display = "block";
}

function forclose() {
document.getElementById("ayy").style.display = "none";
}
</script>
</body>
</html>