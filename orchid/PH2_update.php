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
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
  unset($_SESSION["loginMember"]);
  unset($_SESSION["memberLevel"]);
  header("Location: index.php");
}
if(isset($_POST["action"])&&($_POST["action"]=="update")){
      if (isset($_POST['h_id'])) {   //isset檢查變數是否設置
        require_once 'MYSQL.php';
        $h_pedlength = $_POST['h_pedlength'];
        $h_leafNum = $_POST['h_leafNum'];
        $h_bifNum = $_POST['h_bifNum'];
        $h_bifNum1 = $_POST['h_bifNum1'];
        $h_bifNum2 = $_POST['h_bifNum2'];
		$maturity = $_POST['maturity'];
		$h_on = $_POST['h_on'];
        $sql = "UPDATE `history` SET `h_pedlength`='{$h_pedlength}',`h_leafNum`='{$h_leafNum}',`h_bifNum`='{$h_bifNum}',`h_bifNum1`='{$h_bifNum1}',`h_bifNum2`='{$h_bifNum2}',`maturity`='{$maturity}' WHERE `h_id`=".$_GET["id"];
        mysql_query($sql)or die(mysql_error());
        header("Location: PH2.php?id=$h_on");
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
<title>腎藥蘭花管理系統</title>
<link rel="icon" href="./img/title.png">
<head>
  <script language="javascript">
function checkForm(){
  if(document.cmform.h_biology.value==""){//注意表格名稱
    alert("請填寫品種!");
    document.cmform.h_biology.focus();
    return false;
  }
  return confirm('確定送出嗎？');
}
</script>
<style>
  body {
    font-size:18px;
    background-image: url(img/60.png);
    background-size: cover;
     font-family: 微軟正黑體;
     background-attachment:fixed;
}
  .dbg{
    background: rgba(100%,100%,100%,0.6);
    width:60%;
    float:center;
  }
  #p1{padding-left: 25px;}
</style>
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; font-family: 微軟正黑體;margin:30px"><?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('資料修改成功。');
window.location.href='PH2.php';
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
        <li><a href="CM.php">作物管理</a></li>
        <li class="active"><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="prediction.php?select=10">生長預測</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
        <li><a href="member_update.php">修改資料</a></li>
        <li><a href="?logout=true">登出</a></li>
      </ul>
    </div>
  </div>
</nav>
<br><br><br>
  <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
  <div>
    <!--<button class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>-->
     <h1 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="65" height="40">修改歷史紀錄</h1>
    <div class="dbg container"><!--div放白色背景透明度60%開始-->
        <form  name="cmform" method="post" onSubmit="return checkForm();" style="font-size: 20px;">
        <div class="form-group">
          <label for="h_biology">品種：</label>
          <input type="hidden" name="h_on" class="form-control" id="h_on" value="<?php echo $row_RecFlower["h_on"];?>">
          <input type="hidden" name="h_id" class="form-control" id="h_id" value="<?php echo $row_RecFlower["h_id"];?>">
          <input type="text" name="h_biology" class="form-control" id="h_biology" readonly="readonly" value="<?php echo $row_RecFlower["h_biology"];?>" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="h_pedlength">花梗長度：</label>
          <input type="text" class="form-control" name="h_pedlength" value="<?php echo $row_RecFlower["h_pedlength"];?>" style="font-size: 20px;">
        </div>
		<div class="form-group">
          <label for="h_leafNum">葉片數量：</label>
          <input type="text" class="form-control" name="h_leafNum" value="<?php echo $row_RecFlower["h_leafNum"];?>" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="h_bifNum">分岔數量：</label>
          <input type="text" class="form-control" name="h_bifNum" value="<?php echo $row_RecFlower["h_bifNum"];?>" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="h_bifNum1">第一分岔長度：</label>
          <input type="text" class="form-control" name="h_bifNum1" value="<?php echo $row_RecFlower["h_bifNum1"];?>" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="h_bifNum2">第二分岔長度：</label>
          <input type="text" class="form-control" name="h_bifNum2" value="<?php echo $row_RecFlower["h_bifNum2"];?>" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="maturity">成熟度：</label>
          <input type="text" class="form-control" name="maturity" value="<?php echo $row_RecFlower["maturity"];?>" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="h_date">日期：</label>
          <input type="text" class="form-control" name="h_date" value="<?php echo $row_RecFlower["h_date"];?>" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <center>
          <input name="action" type="hidden" id="action" value="update">
          <input type="submit" class="btn btn-info btn-sm" name="Submit2" value="送出" style="font-size: 18px;">
          <input type="reset" class="btn btn-info btn-sm" name="Submit3" value="重設資料" style="font-size: 18px;">
          <input type="button" class="btn btn-info btn-sm" name="Submit" value="回上一頁" onClick="window.history.back();" style="font-size: 18px;"></center>
          <br><div>© 2016 腎藥蘭花管理系統 ©</div>
        </div>
      </form>
    </div><!--div放白色背景透明度60%結束-->
  </div>
<script>
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>
</body>
</html>