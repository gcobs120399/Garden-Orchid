<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: index.php");
}
$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
$RecMember = mysql_query($query_RecMember);
$row_RecMember=mysql_fetch_assoc($RecMember);//抓會員

$query_RecFlower = "SELECT * FROM `flower` WHERE `f_id`=".$_GET["id"];
$RecFlower = mysql_query($query_RecFlower);
$row_RecFlower=mysql_fetch_assoc($RecFlower);//抓花花
if(isset($_POST["action"])&&($_POST["action"]=="join")){
	if (isset($_POST['h_biology'])) {   //isset檢查變數是否設置
		 require_once 'MYSQL.php';
		$h_biology = $_POST['h_biology'];
		$h_leafNum = $_POST['h_leafNum'];
		$h_pedlength = $_POST['h_pedlength'];
		$h_bifNum = $_POST['h_bifNum'];
		$h_bifNum1 = $_POST['h_bifNum1'];
		$h_bifNum2 = $_POST['h_bifNum2'];
		$maturity = $_POST['maturity'];
		$h_username = $_POST['h_username'];
		$h_date=date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
		$h_on = $_POST['h_on'];
		$sql = "INSERT INTO `history`(`h_biology`,`h_leafNum`,`h_pedlength`,`h_bifNum`,`h_bifNum1` ,`h_bifNum2`,`maturity`,`h_username`,`h_date`,`h_on`) VALUES ('$h_biology','$h_leafNum','$h_pedlength','$h_bifNum' ,'$h_bifNum1','$h_bifNum2','$maturity','$h_username','$h_date','$h_on')";
		mysql_query($sql)or die(mysql_error());echo "新增成功";
		header("Location: CPDR_join.php?id=$h_on"); //新增完資料做網頁跳轉
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>腎藥蘭花管理系統</title>
	<script language="javascript">
function checkForm(){
	if(document.hform.f_biology.value==""){//注意表格名稱
		alert("請填寫品種!");
		document.hform.f_biology.focus();
		return false;
	}
	return confirm('確定送出嗎？');
}
</script>
	<!-- 最新編譯和最佳化的 CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

	<!-- 選擇性佈景主題 -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

	<!-- 最新編譯和最佳化的 JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>
<body style="text-align:center;font-size:18px;background: rgba(100%,100%,100%,0.6);;background-size: cover; font-family: 微軟正黑體;margin:30px" >
<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('資料新增成功。');
window.location.href='history.php';
</script>
<?php }?>
<div class="row col-xs-12 ">
	<h2><img src="img/LOGO.png" alt="LOGO" width="80" height="50">新增歷史紀錄</h2>
</div>
<hr>
	<table align="center"  style="font-size: 20px;">
	<form name="hform" method="post" onSubmit="return checkForm();" >
		<tr>
			<td><input type="hidden" name="h_username" maxlength="" size="14" id="h_username" readonly="readonly" value="<?php echo $row_RecMember["m_username"];?>"></td>
			<td><input type="hidden" name="h_on" maxlength="" size="14" id="h_on" readonly="readonly" value="<?php echo $row_RecFlower["f_id"]; ?> "></td>
		</tr>
		<tr>
			<td>品種:</td>
			<td><input type="text" name="h_biology" maxlength="" size="14" id="h_biology" readonly="readonly" value="<?php echo $row_RecFlower["f_biology"];?>"></td>
		</tr>
		<tr>
			<td>花梗長度:</td>
			<td><input type="text" name="h_pedlength"  size="14" id="h_pedlength"></td>
		</tr>
		<tr>
			<td>葉片數量:</td>
			<td><input type="text" name="h_leafNum"  size="14" id="h_leafNum"></td>
		</tr>
		<tr>
			<td>分岔數量:</td>
			<td><input type="text" name="h_bifNum"  size="14" id="h_bifNum" ></td>
		</tr>
		<tr>
			<td>第一分岔:</td>
			<td><input type="text" name="h_bifNum1"  size="14" id="h_bifNum1" ></td>
		</tr>
		<tr>
			<td>第二分岔:</td>
			<td><input type="text" name="h_bifNum2"  size="14" id="h_bifNum2" ></td>
		</tr>
		<tr>
			<td>成熟度(0.00~1):</td>
			<td><input type="text" name="maturity"  size="14" id="maturity" ></td>
		</tr>
		<tr>
			<td colspan="2">
			<script language="javascript">
				var Today=new Date();
				document.write("今天日期是 " + Today.getFullYear()+ " / " + (Today.getMonth()+1) + " / " + Today.getDate());</script>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="action" type="hidden" id="action" value="join">
            	<input type="submit" class="btn btn-info" name="Submit2" value="送出" style="font-size: 18px;">
            	<input type="reset" class="btn btn-info" name="Submit3" value="重設資料" style="font-size: 18px;">
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