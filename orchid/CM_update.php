<?php
include("MYSQL.php");
if (!@mysql_select_db("phpmember")) die("資料庫選擇失敗！");
if(isset($_POST["action"])&&($_POST["action"]=="update")){
      if (isset($_POST['f_biology'])) {   //isset檢查變數是否設置
        require_once 'MYSQL.php';
        $f_biology = $_POST['f_biology'];
        $f_username = $_POST['f_username'];
        $sql = "UPDATE `flower` SET `f_biology`='{$f_biology}', `f_username`='{$f_username}' WHERE `f_id`=".$_GET["id"];
        mysql_query($sql)or die(mysql_error());
        header("Location: CM.php?loginStats=1");
      }
    }
if(isset($_POST["action"])&&($_POST["action"]=="update")){
      if (isset($_POST['f_biology'])) {   //isset檢查變數是否設置
        require_once 'MYSQL.php';
        $f_biology = $_POST['f_biology'];
        $f_username = $_POST['f_username'];
        $sql = "UPDATE `history` SET `h_biology`='{$f_biology}' WHERE `h_on`=".$_GET["id"];
        mysql_query($sql)or die(mysql_error());
        header("Location: CM.php?loginStats=1");
      }
    }
$sql_db = "SELECT * FROM `flower` WHERE `f_id`=".$_GET["id"];
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
	<title>農業物聯生產管理系統</title>
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
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">
<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('資料修改成功。');
window.location.href='CM.php';
</script>
<?php }?>
<div class="row col-xs-12">
	<h2><img src="img/LOGO.png" alt="LOGO" width="80" height="50">修改作物</h2>
</div>
<hr>
<div style="background: rgba(100%,100%,100%,0.6);" class="row col-xs-8 col-md-8"><!--div放白色背景透明度60%開始-->
	<table align="center" >
	<form name="cmform" method="post" onSubmit="return checkForm();" >
		<tr>
			<td>帳號:</td>
			<td><input type="text" name="f_username"  size="14" id="f_username" readonly="readonly" value="<?php echo $row_result["f_username"]; ?>"></td>
		</tr>
		<tr>
			<td>品種:</td>
			<td><input type="text" name="f_biology"  size="14" id="f_biology" value="<?php echo $row_result["f_biology"];?>"></td>
		</tr>
		<tr >
			<td colspan="2">
			    <input name="f_id" type="hidden" id="f_id" value="<?php echo $row_result["f_id"];?>">
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
</div><!--div放白色背景透明度60%結束-->
</body>
</html>