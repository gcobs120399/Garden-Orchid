<?php 
include("MYSQL.php");
if (!@mysql_select_db("phpmember")) die("資料庫選擇失敗！");
if (isset($_POST["action"])&&($_POST["action"]=="update")) {
	$sql_query="UPDATE `equipment` SET";
	$sql_query .="`e_id`='".$_POST["e_id"]."',";
	$sql_query .="`e_name`='".$_POST["e_name"]."',";
	$sql_query .="`e_num`='".$_POST["e_num"]."',";
	$sql_query .="`e_user`='".$_POST["e_user"]."',";
	$sql_query .="`e_money`='".$_POST["e_money"]."',";
	$sql_query .="`e_pattern`='".$_POST["e_pattern"]."' ";//注意最後一個是有空白 而不是逗號
	$sql_query .="WHERE `e_id`=".$_POST["e_id"];
	mysql_query($sql_query);
	header("Location: SM.php?loginStats=1");//必須加上 ?
}
$sql_db = "SELECT * FROM `equipment` WHERE `e_id`=".$_GET["id"];
$result = mysql_query($sql_db);
$row_result=mysql_fetch_assoc($result);
require_once("MYSQL.php");
session_start();
//檢查登入
if (!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")) {
	header("Location: index.php");
}
//執行登出
if (isset($_GET["logout"]) && ($_GET["logout"]=="true")) {
	unset($_SESSION["loginMember"]);
	unset($_SESSION["memberLevel"]);
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>腎藥蘭花管理系統</title>
	<!-- 最新編譯和最佳化的 CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

	<!-- 選擇性佈景主題 -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

	<!-- 最新編譯和最佳化的 JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <!--呆的巡覽列-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./css/bootstrap.min.css" rel="stylesheet">
<!--<link href="./css/navbar-fixed-top.css" rel="stylesheet">造成網頁可以上下移動-->
<script src="./js/ie-emulation-modes-warning.js"></script> 
<link rel="icon" href="./img/title.png">
<!--呆-->

  <script type="text/javascript">
  	function checkForm(){
  		if (document.smform.e_name.value=="") {//注意表格的名稱
  			alert("請填寫設備名稱！");
  			document.smform.e_name.focus();
  			return false;
  		}
  		return confirm('確定送出嗎？');
  	}
  </script>
  <link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS+頂端-->
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; background-attachment: fixed; font-family: 微軟正黑體;margin:30px">

<!--巡覽列black-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header"> 
     <a class="navbar-brand" href="member_center.php" style="font-size: 24pt;">基於物聯網與KNN技術之腎藥蘭園監測及智慧生產管理系統</a>
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
        <li><a href="member_center.php">首頁</a></li>
        <li><a href="GMM.php">溫室管理</a></li>
        <li class="active"><a href="SM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="prediction.php">生長預測</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
      </ul>
    </div>
  </div>
</nav>
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">
<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")) {?>
<script language="javascript">
alert('資料修改成功。');
window.location.href='SM.php';
</script>
<?php }?>
<br><br><br>
<div class="col-xs-12">
	<h2><img src="img/LOGO.png" alt="LOGO" width="80" height="50">修改設備</h2>
</div>
<hr>
	<table align="center">
		<form name="smform" method="post" onSubmit="return checkForm();">
			<tr>
			<td>帳號:</td>
			<td><input type="text" name="e_user"  size="14" id="e_user" readonly="readonly" value="<?php echo $row_result["e_user"]; ?>"></td>
		</tr>
		<tr>
			<td>設備名稱:</td>
			<td><input type="text" name="e_name"  size="14" id="e_name" value="<?php echo $row_result["e_name"];?>"></td>
		</tr>
		<tr>
			<td>設備數量:</td>
			<td><input type="text" name="e_num"  size="14" id="e_num" value="<?php echo $row_result["e_num"]; ?>"></td>
		</tr>
		<tr>
			<td>設備數量:</td>
			<td><input type="text" name="e_money"  size="14" id="e_money" value="<?php echo $row_result["e_money"]; ?>"></td>
		</tr>
		<tr>
			<td>型態:</td>
			<td>
			<input type="radio" name="e_pattern" value="耗材" <?php if($row_result["e_pattern"]=="耗材") echo "checked";?>> 耗材<br>
			<input type="radio" name="e_pattern" value="資材" <?php if($row_result["e_pattern"]=="資材") echo "checked";?>> 資材<br>
			</td>
		</tr>
		<tr></tr>
		<tr >
			<td colspan="2">
			    <input name="e_id" type="hidden" id="e_id" value="<?php echo $row_result["e_id"];?>">
				<input name="action" type="hidden" id="action" value="update">
            	<input type="submit" name="Submit2" class="btn btn-info" value="送出">
            	<input type="reset" name="Submit3" class="btn btn-info" value="重設資料">
				<input type="button" name="Submit" class="btn btn-info" value="回上一頁" onClick="window.history.back();">
			</td>
		</tr>
		<tr></tr>
		<tr>
    		<td align="center" colspan="2">© 2016 腎藥蘭花管理系統 ©</td>
  		</tr>
		</form>
	</table>
</body>
</html>