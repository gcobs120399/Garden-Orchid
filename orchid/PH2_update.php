<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: index.php");
}


$query_RecFlower = "SELECT * FROM `history` WHERE `h_id`=".$_GET["id"];
$RecFlower = mysql_query($query_RecFlower);
$row_RecFlower=mysql_fetch_assoc($RecFlower);//抓花花

if(isset($_POST["action"])&&($_POST["action"]=="update")){
      if (isset($_POST['h_id'])) {   //isset檢查變數是否設置
        require_once 'MYSQL.php';
        $h_pedlength = $_POST['h_pedlength'];
        $h_leafNum = $_POST['h_leafNum'];
        $h_bifNum = $_POST['h_bifNum'];
        $h_bifNum1 = $_POST['h_bifNum1'];
        $h_bifNum2 = $_POST['h_bifNum2'];
		$maturity = $_POST['maturity'];
        $sql = "UPDATE `history` SET `h_pedlength`='{$h_pedlength}',`h_leafNum`='{$h_leafNum}',`h_bifNum`='{$h_bifNum}',`h_bifNum1`='{$h_bifNum1}',`h_bifNum2`='{$h_bifNum2}',`maturity`='{$maturity}' WHERE `h_id`=".$_GET["id"];
        mysql_query($sql)or die(mysql_error());
        header("Location: window.history.back();");
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
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">
<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('資料修改成功。');
window.location.href='history.php';
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
      <ul class="nav navbar-nav">
        <li><a href="member_center.php">首頁</a></li>
        <li><a href="GMM.php">溫室管理</a></li>
        <li><a href="SM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li class="active"><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="prediction.php">生長預測</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
        <li><a href="?logout=true">登出</a></li>
      </ul>
    </div>
  </div>
</nav>
<br><br><br>
<div class="row col-xs-12 ">
	<h2><img src="img/LOGO.png" alt="LOGO" width="80" height="50">修改歷史紀錄</h2>
</div>
<hr>
	<table align="center" >
	<form name="hform" method="post" onSubmit="return checkForm();" >
		<tr>
			<td><input type="hidden" name="h_on" maxlength="" size="14" id="h_on" readonly="readonly" value="<?php echo $row_RecFlower["h_id"]; ?> "></td>
		</tr>
		<tr>
			<td>品種:</td>
			<td><?php echo $row_RecFlower["h_biology"]; ?></td>
		</tr>
		<tr>
			<td>花梗長度:</td>
			<td><input type="text" name="h_pedlength" value="<?php echo $row_RecFlower["h_pedlength"]; ?>" size="14" id="h_pedlength"></td>
		</tr>
		<tr>
			<td>葉片數量:</td>
			<td><input type="text" name="h_leafNum" value="<?php echo $row_RecFlower["h_leafNum"]; ?>" size="14" id="h_leafNum"></td>
		</tr>
		<tr>
			<td>分岔數量:</td>
			<td><input type="text" name="h_bifNum" value="<?php echo $row_RecFlower["h_bifNum"]; ?>" size="14" id="h_bifNum" ></td>
		</tr>
		<tr>
			<td>第一分岔:</td>
			<td><input type="text" name="h_bifNum1" value="<?php echo $row_RecFlower["h_bifNum1"]; ?>" size="14" id="h_bifNum1" ></td>
		</tr>
		<tr>
			<td>第二分岔:</td>
			<td><input type="text" name="h_bifNum2" value="<?php echo $row_RecFlower["h_bifNum2"]; ?>" size="14" id="h_bifNum2" ></td>
		</tr>
		<tr>
			<td>成熟度(0.00~1):</td>
			<td><input type="text" name="maturity" value="<?php echo $row_RecFlower["maturity"]; ?>" size="14" id="maturity" ></td>
		</tr>
		<tr>
			<td>日期:</td>
			<td><?php echo $row_RecFlower["h_date"]; ?></td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="h_id" type="hidden" id="h_id" value="<?php echo $row_result["h_id"];?>">
				<input name="action" type="hidden" id="action" value="update">
            	<input type="submit" class="btn btn-info" name="Submit2" value="送出">
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