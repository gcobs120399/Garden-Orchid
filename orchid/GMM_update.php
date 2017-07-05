<?php 
include("MYSQL.php");
if (!@mysql_select_db("phpmember")) die("資料庫選擇失敗！");
if (isset($_POST["action"])&&($_POST["action"]=="update")) {
	$sql_query="UPDATE `greenhouse` SET";
	$sql_query .="`gh_id`='".$_POST["gh_id"]."',";
	$sql_query .="`gh_name`='".$_POST["gh_name"]."',";
	$sql_query .="`gh_num`='".$_POST["gh_num"]."',";
	$sql_query .="`gh_add`='".$_POST["gh_add"]."',";
	$sql_query .="`gh_data`='".$_POST["gh_data"]."',";
	$sql_query .="`gh_user`='".$_POST["gh_user"]."' ";//注意最後一個是有空白 而不是逗號
	$sql_query .="WHERE `gh_id`=".$_POST["gh_id"];
	mysql_query($sql_query);
	header("Location: GMM.php?loginStats=1");//必須加上 ?
}
$sql_db = "SELECT * FROM `greenhouse` WHERE `gh_id`=".$_GET["id"];
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
  		if (document.gmmform.gh_name.value=="") {//注意表格的名稱
  			alert("請填寫溫室名稱！");
  			document.gmmform.gh_name.focus();
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
window.location.href='GMM.php';
</script>
<?php }?>
<div class="col-xs-12">
	<h2><img src="img/LOGO.png" alt="LOGO" width="80" height="50">修改溫室</h2>
</div>
<hr>
	<table align="center">
		<form name="gmmform" method="post" onSubmit="return checkForm();">
			<tr>
			<td>帳號:</td>
			<td><input type="text" name="gh_user"  size="14" id="gh_user" readonly="readonly" value="<?php echo $row_result["gh_user"]; ?>"></td>
		</tr>
		<tr>
			<td>溫室名稱：</td>
			<td><input type="text" name="gh_name"  size="14" id="gh_name" value="<?php echo $row_result["gh_name"];?>"></td>
		</tr>
		<tr>
			<td>溫室單位：</td>
			<td><input type="text" name="gh_num"  size="14" id="gh_num" value="<?php echo $row_result["gh_num"]; ?>"></td>
		</tr>
		<tr>
			<td>溫室地址：</td>
			<td><input type="text" name="gh_add"  size="14" id="gh_add" value="<?php echo $row_result["gh_add"]; ?>"></td>
		</tr>
		<tr>
			<td>溫室建置日：</td>
			<td><input type="date" name="gh_data" size="14" value="<?php echo $row_result["gh_data"]; ?>"></td>
		</tr>
		<tr></tr>
		<tr >
			<td colspan="2">
			    <input name="gh_id" type="hidden" id="gh_id" value="<?php echo $row_result["gh_id"];?>">
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