<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
  header("Location: index.php");}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	unset($_SESSION["memberLevel"]);
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>作物管理</title>
	<!-- 最新編譯和最佳化的 CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<!-- 選擇性佈景主題 -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<!-- 最新編譯和最佳化的 JavaScript -->
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; font-family: 微軟正黑體;margin:30px">
<h1><img src="img/LOGO.png" alt="LOGO" width="80" height="50">歷史紀錄</h1>
<form name="" method="" action="">
<hr>
<div class="btn-group col-xs-12" role="group" style="font-size:18px;">
<input type="button" class="btn btn-info" style="width:50px;" value="左" onclick="location.href='history_left.php'">
<input type="button" class="btn btn-info" style="width:50px;" value="中" onclick="location.href='history_center.php'">
<input type="button" class="btn btn-info" style="width:50px;" value="右" onclick="location.href='history_right.php'">
</div>

<div class="col-xs-12 ">
  <input type="button" class="btn btn-info" name="Submit" value="回上一頁" onClick="window.history.back();">
</div>
<div class="col-xs-12">© 2016 腎藥蘭花管理系統 ©</div>
</form>
</body>
</html>