<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: index.php");
}
if(isset($_POST["action"])&&($_POST["action"]=="join")){
	if (isset($_POST['temp_1'])) {   //isset檢查變數是否設置
		 require_once 'MYSQL.php';
		$temp_1 = $_POST['temp_1'];
		$humi_1 = $_POST['humi_1'];
		$temp_2 = $_POST['temp_2'];
		$humi_2 = $_POST['humi_2'];
		$light_1 = $_POST['light_1'];
		$sql = "INSERT INTO `_center`(`temp_1`, `humi_1`,`temp_2`,`humi_2`,`light_1`) VALUES ('$temp_1','$humi_1','$temp_2','$humi_2','$light_1')";
		mysql_query($sql)or die(mysql_error());echo "新增成功";
		header("Location: GH_join.php?loginStats=1"); //新增完資料做網頁跳轉
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>蘭花管理系統</title>
	<!-- 最新編譯和最佳化的 CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

	<!-- 選擇性佈景主題 -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

	<!-- 最新編譯和最佳化的 JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body style="text-align:center;font-size:18px;background: rgba(100%,100%,100%,0.6);;background-size: cover; font-family: 微軟正黑體;margin:30px" >

<div class="row col-xs-12 ">
	<h2><img src="img/LOGO.png" alt="LOGO" width="80" height="50">新增歷史紀錄</h2>
</div>
<hr>
	<table align="center" >
	<form name="ghform" method="post"  >
		<tr>
			<td>環境溫度(上):</td>
			<td><input type="text" name="temp_1" maxlength="" size="14" id="temp_1" value=""></td>
		</tr>
		<tr>
			<td>環境濕度(上):</td>
			<td><input type="text" name="humi_1" maxlength="" size="14" id="humi_1" value=""></td>
		</tr>
		<tr>
			<td>環境溫度(下):</td>
			<td><input type="text" name="temp_2"  size="14" id="temp_2" ></td>
		</tr>
		<tr>
			<td>環境濕度(下):</td>
			<td><input type="text" name="humi_2"  size="14" id="humi_2"></td>
		</tr>
		<tr>
			<td>日照度:</td>
			<td><input type="text" name="light_1"  size="14" id="light_1"></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="action" type="hidden" id="action" value="join">
            	<input type="submit" class="btn btn-info" name="Submit2" value="送出">
            	<input type="reset" class="btn btn-info" name="Submit3" value="重設資料">
			</td>
		</tr>
		<tr></tr>
		<tr>
    		<td align="center" colspan="2">© 2016 農業物聯生產管理系統 ©</td>
  		</tr>
	</form>
</table>
</body>
</html>