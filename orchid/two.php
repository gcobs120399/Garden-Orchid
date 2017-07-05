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
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-indigo.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="https://fonts.googleapis.com/css?family=Fira+Sans:900" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,p,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
    background-image: url(img/4.jpg);
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
.p{font-family: 'Fira Sans', sans-serif;font-size:30px}
.button4 {
    background-color: transparent;
    color: black;
    border: 2px solid #D3D3D3;
    padding: 7.5px 15px 7.5px 15px;
    text-align: center;
     cursor: pointer;
    border-radius:10%;
}
.button4:hover {background-color: #D3D3D3;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
  border-radius:10%;
  opacity: 0.75;
    filter: alpha(opacity=75); /* For IE8 and earlier */}


hr.style-eight {
    padding: 0px;
    border: none;
    border-top: thin solid #F0F0F0;
    color: #F0F0F0;
    text-align: center;
    width:100%
}
hr.style-eight:after {
    content: "";
    display: inline-block;
    position: relative;
    top: -0.8em;
    font-size: 50px;
    padding: 0px 3px 0px 3px;
    background: transparent;
}
</style>
<body>
<!--菜單-->
<div class="w3-sidebar w3-light-grey w3-card-4 w3-animate-left" style="width: 200px; display: none;" id="mySidebar">
  <div class="w3-ba">
  <span class="w3-bar-item w3-padding-16">Close</span>
  <button onclick="w3_close()" class="w3-bar-item w3-button w3-right w3-padding-16" title="close Sidebar">×</button>
  </div>
  <div class="w3-bar-block">
  <a class="w3-bar-item w3-button w3-green" href="javascript:void(0)">Home</a>
  <a class="w3-bar-item w3-button" href="javascript:void(0)">About</a>
  <a class="w3-bar-item w3-button" href="javascript:void(0)">Contact</a>
  <div class="w3-dropdown-hover">
    <a class="w3-button" href="javascript:void(0)">Dropdown <i class="fa fa-caret-down"></i></a>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a class="w3-bar-item w3-button" href="javascript:void(0)">Link 1</a>
      <a class="w3-bar-item w3-button" href="javascript:void(0)">Link 2</a>
      <a class="w3-bar-item w3-button" href="javascript:void(0)">Link 3</a>
    </div>
  </div>
  <a class="w3-bar-item w3-button" href="javascript:void(0)">Support</a>
  </div>
</div>


<div class="bgimg w3-display-container w3-animate-opacity" id="main" style="margin-left: 0px;">
  <div class="w3-container w3-display-container">
    <span title="open Sidebar" style="display: inline-block;" id="openNav" class="w3-button w3-transparent w3-display-topleft w3-xlarge" onclick="w3_open()">☰</span>
  </div>
  <div class="w3-display-middle">
    <h1 class="w3-jumbo w3-animate-top"><img src="img/LOGO.png" alt="LOGO" width="80" height="50"><b>
BGWPM．KS</h1>
    <hr class="style-eight">
    <!--<p class=" w3-center w3-text-black" style="font-size:30px"><button class="w3-btn w3-border w3-round-large"><b>Login</button></p>-->
    <p class=" w3-center w3-text-black p"><button class=" button4"><b>login</button></p>
  </div>
</div>

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
</script>
</body>
</html>
