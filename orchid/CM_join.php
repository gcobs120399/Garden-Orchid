<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: index.php");}
$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
$RecMember = mysql_query($query_RecMember);
$row_RecMember=mysql_fetch_assoc($RecMember);
if(isset($_POST["action"])&&($_POST["action"]=="join")){
	if (isset($_POST['f_biology'])) {   //isset檢查變數是否設置
		 require_once 'MYSQL.php';
		$f_biology = $_POST['f_biology'];
		$f_username = $_POST['f_username'];
		$f_location = $_POST['f_location'];
		$f_date = date("Y-m-d");
		$sql = "INSERT INTO `flower`(`f_biology`,`f_username`,`f_location`,`f_date`) VALUES ('$f_biology','$f_username','$f_location','$f_date')";
		mysql_query($sql)or die(mysql_error());
		header("Location: CM.php?loginStats=1"); //新增完資料做網頁跳轉
	}
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
  unset($_SESSION["loginMember"]);
  unset($_SESSION["memberLevel"]);
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>腎藥蘭花管理系統</title>
	<!--呆的巡覽列-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./css/bootstrap.min.css" rel="stylesheet">
<!--<link href="./css/navbar-fixed-top.css" rel="stylesheet">造成網頁可以上下移動-->
<script src="./js/ie-emulation-modes-warning.js"></script> 
<link rel="icon" href="./img/title.png">
<!--呆-->

	<!-- 最新編譯和最佳化的 CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<!-- 選擇性佈景主題 -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<!-- 最新編譯和最佳化的 JavaScript -->
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script language="javascript">
function checkForm(){
	if(document.cmform.f_biology.value==""){//注意表格名稱
		alert("請填寫品種!");
		document.cmform.f_biology.focus();
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
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; font-family: 微軟正黑體;margin:30px"><?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('資料新增成功。');
window.location.href='CM.php';
</script>
<?php }?>
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
      <ul class="nav navbar-nav" style="font-size: 20px;">
        <li><a href="member_center.php">首頁</a></li>
        <li><a href="GMM.php">溫室管理</a></li>
        <li><a href="SM.php">設備管理</a></li>
        <li class="active"><a href="CM.php">作物管理</a></li>
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="prediction.php">生長預測</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
        <li><a href="member_update.php">修改資料</a></li>
        <li><a href="?logout=true">登出</a></li>
      </ul>
    </div>
  </div>
</nav>
<br><br><br>
<div class="row col-xs-12">
	<h1><img src="img/LOGO.png" alt="LOGO" width="80" height="50">新增作物</h1>
</div>
<hr>
<div class="col-xs-2 col-md-2"></div>
<div style="background: rgba(100%,100%,100%,0.6);" class="row col-xs-8 col-md-8"><!--div放白色背景透明度60%開始-->
	<table align="center"  style="font-size: 20px;">
	<form name="cmform" method="post" onSubmit="return checkForm();" >
		<tr>
			<td>帳號:</td>
			<td><input type="text" name="f_username" maxlength="" size="14" id="f_username" readonly="readonly" value="<?php echo $row_RecMember["m_username"];?>"></td>
		</tr>
		<tr>
			<td>品種:</td>
			<td><input type="text" name="f_biology" maxlength="" size="14" id="f_biology"></td>
		</tr>
		<tr>
			<td>位置：</td>
			<td><input type="radio" name="f_location" value="左"> 左<br>
			<input type="radio" name="f_location" value="中"> 中<br>
			<input type="radio" name="f_location" value="右"> 右<br></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="action" type="hidden" id="action" value="join">
            	<input type="submit" class="btn btn-info" name="Submit2" value="送出" style="font-size: 18px;">
            	<input type="reset" class="btn btn-info" name="Submit3" value="重設資料" style="font-size: 18px;">
				<input type="button" class="btn btn-info" name="Submit" value="回上一頁" onClick="window.history.back();" style="font-size: 18px;">
			</td>
		</tr>
		<tr>
    		<td align="center" colspan="2">© 2016 腎藥蘭花管理系統 ©</td>
  		</tr>
	</form>
</table>
<div class="col-xs-2 col-md-2"></div>
</div><!--div放白色背景透明度60%結束-->
</body>

</html>