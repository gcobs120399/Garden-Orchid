<?php 
include("MYSQL.php");
if (!@mysql_select_db("phpmember")) die("資料庫選擇失敗！");
if (isset($_POST["action"])&&($_POST["action"]=="update")) {
	$sql_query="UPDATE `equipment` SET";
	$sql_query .="`e_id`='".$_POST["e_id"]."',";
	$sql_query .="`e_name`='".$_POST["e_name"]."',";
	$sql_query .="`e_num`='".$_POST["e_num"]."',";
	$sql_query .="`e_user`='".$_POST["e_user"]."',";
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
	<title>蘭花管理系統</title>
	<!-- 最新編譯和最佳化的 CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

	<!-- 選擇性佈景主題 -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

	<!-- 最新編譯和最佳化的 JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
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
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">
<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")) {?>
<script language="javascript">
alert('資料修改成功。');
window.location.href='SM.php';
</script>
<?php }?>
<div class="col-xs-12">
	<h2><img src="img/LOGO.png" alt="LOGO" width="80" height="50">修改耗材</h2>
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
    		<td align="center" colspan="2">© 2016 農業物聯生產管理系統 ©</td>
  		</tr>
		</form>
	</table>
</body>
</html>