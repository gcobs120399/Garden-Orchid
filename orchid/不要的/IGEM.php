<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
  //若帳號等級為 member 則導向會員中心

}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	unset($_SESSION["memberLevel"]);
	header("Location: index.php");
}

require_once("connMysql.php");
//左
$query_RecLeft = "SELECT * FROM `_left` ORDER BY date DESC";
$RecLeft = mysql_query($query_RecLeft);
$row_RecLeft=mysql_fetch_assoc($RecLeft);

//中
$query_RecCenter = "SELECT * FROM `_center` ORDER BY date DESC";
$RecCenter = mysql_query($query_RecCenter);
$row_RecCenter=mysql_fetch_assoc($RecCenter);

//右
$query_RecRight = "SELECT * FROM `_right` ORDER BY date DESC";
$RecRight = mysql_query($query_RecRight);
$row_RecRight=mysql_fetch_assoc($RecRight);
?>
<!DOCTYPE html>
<html>
<head>
	<meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>溫室環境即時監測</title>
	<!-- 最新編譯和最佳化的 CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<!-- 選擇性佈景主題 -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<!-- 最新編譯和最佳化的 JavaScript -->
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/abc.gif);background-size: cover; font-family: 微軟正黑體;margin:30px">
<h1>溫室環境監測</h1>
<h3>溫室環境即時監測</h3>
<form name="" method="" action="">
<input type="button" class="btn btn-info" size="12" value="環境異常警告" onclick="location.href='EAW.php'">
<input type="button" class="btn btn-info" size="12" value="回首頁" onclick="location.href='index.php'">
<hr>
<div class="row" style="font-size:24px;">
  <div class="col-md-4">
  	<table border="0px" align="center" style="text-align:center;">
  	<form name="Lfrom">
  		<tr>
  		<td colspan="4">左邊</td>
  		</tr>
  		<tr>
  			<td></td>
  			<td>電池電壓/ </td>
  			<td>環境溫度/ </td>
  			<td>環境濕度 </td>
  		</tr>
  		<tr>
  			<td>上</td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecLeft["battery_1"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecLeft["temp_1"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecLeft["humi_1"];?>"></td>
  		</tr>
  		<tr>
  			<td>下</td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecLeft["battery_2"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecLeft["temp_2"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecLeft["humi_2"];?>"></td>
  		</tr>
  		<tr>
  			<td colspan="4">　</td>
  		</tr>
  		<tr>
  			<td>光照度</td>
  		</tr>
  		<tr>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecLeft["light_1"];?>"></td>
  		</tr>
  	</form>
  </table>

  </div>
  <div class="col-md-4">
  	<table border="0px" align="center" style="text-align:center;">
  	<form name="Cform">
  		<tr><td colspan="4">中間</td></tr>
  		<tr>
  			<td></td>
  			<td>電池電壓/ </td>
  			<td>環境溫度/ </td>
  			<td>環境濕度</td>
  		</tr>
  		<tr>
  			<td>上</td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecCenter["battery_1"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecCenter["temp_1"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecCenter["humi_1"];?>"></td>
  		</tr>
  		<tr>
  			<td>中</td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecCenter["battery_2"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecCenter["temp_2"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecCenter["humi_2"];?>"></td>
  		</tr>
  		<tr>
  			<td>下</td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecCenter["battery_3"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecCenter["temp_3"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecCenter["humi_3"];?>"></td>
  		</tr>
  		<tr>
  			<td colspan="4">　</td>
  		</tr>
  		<tr>
  			<td>光照度</td>
  		</tr>
  		<tr>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecCenter["light_1"];?>"></td>
  		</tr>
  	</form>
  </table>
  <p>更新時間：<br>
	<?php echo $row_RecCenter["date"];?>
  </p>
  </div>
  <div class="col-md-4">
  	<table border="0px" align="center" style="text-align:center;">
  	<form name="Rfrom">
  		<tr><td colspan="4">右邊</td></tr>
  		<tr>
  			<td></td>
  			<td>電池電壓/ </td>
  			<td>環境溫度/ </td>
  			<td>環境濕度/ </td>
  		</tr>
  		<tr>
  			<td>上</td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecRight["battery_1"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecRight["temp_1"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecRight["humi_1"];?>"></td>
  		</tr>
  		<tr>
  			<td>下</td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecRight["battery_2"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecRight["temp_2"];?>"></td>
  			<td><input type="text" name="" id="" size="2px" readonly="readonly" value="<?php echo $row_RecRight["humi_2"];?>"></td>
  		</tr>
  		<tr>
  			<td colspan="4">　</td>
  		</tr>
  		<tr>
  			<td>光照度</td>
  		</tr>
  		<tr>
  			<td><input type="text" name="" id="" size="2px" value=""></td>
  		</tr>
  	</form>
  </table>
  </div>
</div>
</body>
</html>