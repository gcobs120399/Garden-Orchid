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
    $h_pedlength = $_POST['h_pedlength'];
    $h_leafNum = $_POST['h_leafNum'];
    $h_bifNum = $_POST['h_bifNum'];
    $h_bifNum1 = $_POST['h_bifNum1'];
    $h_bifNum2 = $_POST['h_bifNum2'];
    $maturity = $_POST['maturity'];
    $h_username = $_POST['h_username'];
    $h_date=date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));
    $h_on = $_POST['h_on'];
		$sql = "INSERT INTO `history`(`h_biology`,`h_leafNum`,`h_pedlength`,`h_bifNum`,`h_bifNum1` ,`h_bifNum2`,`maturity`,`h_username`,`h_date`,`h_on`) VALUES ('$h_biology','$h_leafNum','$h_pedlength','$h_bifNum' ,'$h_bifNum1','$h_bifNum2','$maturity','$h_username','$h_date','$h_on')";
		mysql_query($sql)or die(mysql_error());echo "新增成功";
	}
}
?>
<!DOCTYPE html>
<html lang="en-us">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>蘭花管理系統</title>
<head>
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
<style>
  body {
    font-size:18px;
    background:rgba(100%,100%,100%,0.6);
    background-size: cover;
    font-family: 微軟正黑體;
    margin:30px;
    background-attachment:fixed;
}

</style>
</head>
<body>
<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('資料新增成功。');
window.location.href='history.php';
</script>
<?php }?>
  <div>
     <h2 style="text-align:center;">新增歷史紀錄</h2>
        <form  name="hform" method="post" onSubmit="return checkForm();" style="font-size: 20px;">
        <div class="form-group">
          <input type="hidden" name="h_username" maxlength="" size="14" id="h_username" readonly="readonly" value="<?php echo $row_RecMember["m_username"];?>" style="font-size: 20px;">
		  <input type="hidden" name="h_on" maxlength="" size="14" id="h_on" readonly="readonly" value="<?php echo $row_RecFlower["f_id"]; ?> ">
        </div>
        <div class="form-group">
          <label for="biology">品種：</label>
          <input type="text" class="form-control" name="h_biology" size="14" id="h_biology" readonly="readonly" value="<?php echo $row_RecFlower["f_biology"];?>" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="biology">花梗長度:</label>
          <input type="text" class="form-control" name="h_pedlength"  size="14" id="h_pedlength"  style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="biology">葉片數量：</label>
          <input type="text" class="form-control" name="h_leafNum"  size="14" id="h_leafNum" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="biology">分岔數量:</label>
          <input type="text" class="form-control" name="h_bifNum"  size="14" id="h_bifNum" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="biology">第一分岔:</label>
          <input type="text" class="form-control" name="h_bifNum1"  size="14" id="h_bifNum1" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="biology">第二分岔:</label>
          <input type="text" class="form-control" name="h_bifNum2"  size="14" id="h_bifNum2" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="biology">成熟度(0.00~1):</label>
          <input type="text" class="form-control" name="maturity"  size="14" id="maturity" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <script language="javascript">
				var Today=new Date();
				document.write("今天日期是 " + Today.getFullYear()+ " 年 " + (Today.getMonth()+1) + " 月 " + Today.getDate() + " 日");</script>
        </div>
        <div class="form-group">
          <center>
          <input name="action" type="hidden" id="action" value="join">
            	<input type="submit" class="btn btn-info" name="Submit2" value="送出" style="font-size: 16px;">
            	<input type="reset" class="btn btn-info" name="Submit3" value="重設資料" style="font-size: 16px;"></center>
        </div>
        <div align="center">© 2016 農業物聯生產管理系統 ©</div>
      </form>
  </div>
</body>
</html>
