<?php
include("MYSQL.php");
if (!@mysql_select_db("phpmember")) die("資料庫選擇失敗！");
if(isset($_POST["action"])&&($_POST["action"]=="update")){
      if (isset($_POST['h_biology'])) {   //isset檢查變數是否設置
        require_once 'MYSQL.php';
        $h_stems = $_POST['h_stems'];
        $h_leafsize = $_POST['h_leafsize'];
        $h_leafNum = $_POST['h_leafNum'];
        $h_pedlength = $_POST['h_pedlength'];
        $h_pedNum = $_POST['h_pedNum'];
        $h_bifNum = $_POST['h_bifNum'];
        $sql = "UPDATE `history` SET `h_stems`='{$h_stems}',`h_leafsize`='{$h_leafsize}',`h_leafNum`='{$h_leafNum}',`h_pedNum`='{$h_pedNum}',`h_bifNum`='{$h_bifNum}' WHERE `h_id`=".$_GET["id"];
        mysql_query($sql)or die(mysql_error());
        header("Location: PH2.php");
      }
    }
$sql_db = "SELECT * FROM `history` WHERE `h_id`=".$_GET["id"];
$result = mysql_query($sql_db);
$row_result=mysql_fetch_assoc($result);
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>腎藥蘭花管理系統</title>
	<!-- 最新編譯和最佳化的 CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<!-- 選擇性佈景主題 -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<!-- 最新編譯和最佳化的 JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script language="javascript">
function checkForm(){
	if(document.cmform.f_biology.value==""){//注意表格名稱要改到
		alert("請填寫品種!");
		document.cmform.f_biology.focus();
		return false;
	}
	return confirm('確定送出嗎？');
}
</script>
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; font-family: 微軟正黑體;margin:30px">
<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('資料修改成功。');
window.location.href='PH.php';
</script>
<?php }?>
<div>
	<h2><img src="img/LOGO.png" alt="LOGO" width="80" height="50">修改作物</h2>
</div>
<hr>
	<table align="center" >
	<form name="cmform" method="post" onSubmit="return checkForm();" >
		<tr>
			<td><input type="hidden" readonly="readonly" name="h_username" size="14" id="h_username" readonly="readonly" value="<?php echo $row_result["h_username"]; ?>"></td>
		</tr>
		<tr>
			<td>品種:</td>
			<td><input type="text" readonly="readonly" name="h_biology" size="14" id="h_biology" value="<?php echo $row_result["h_biology"];?>"></td>
		</tr>
		<tr>
			<td>莖高:</td>
			<td><input type="text" name="h_stems" size="14" id="h_stems" value="<?php echo $row_result["h_stems"]; ?>"></td>
		</tr>
		<tr>
			<td>葉片大小:</td>
			<td><input type="text" name="h_leafsize" size="14" id="h_leafsize" value="<?php echo $row_result["h_leafsize"]; ?>"></td>
		</tr>
		<tr>
			<td>葉片數量:</td>
			<td><input type="text" name="h_leafNum" size="14" id="h_leafNum" value="<?php echo $row_result["h_leafNum"]; ?>"></td>
		</tr>
		<tr>
			<td>花莖長度:</td>
			<td><input type="text" name="h_pedlength" size="14" id="h_pedlength" value="<?php echo $row_result["h_pedlength"]; ?>"></td>
		</tr>
		<tr>
			<td>花莖數量:</td>
			<td><input type="text" name="h_pedNum" size="14" id="h_pedNum" value="<?php echo $row_result["h_pedNum"]; ?>"></td>
		</tr>
		<tr>
			<td>分岔數:</td>
			<td><input type="text" name="h_bifNum" size="14" id="h_bifNum" value="<?php echo $row_result["h_bifNum"]; ?>"></td>
		</tr>
		<tr>
			<td colspan="2">
			    <input name="h_id" type="hidden" id="h_id" value="<?php echo $row_result["h_id"];?>">
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