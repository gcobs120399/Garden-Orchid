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
  if(document.cmform.gh_name.value==""){//注意表格名稱
    alert("請填寫溫室名稱!");
    document.cmform.gh_name.focus();
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
    float:left;
    position: fixed; left: 20%;
  }
  #p1{padding-left: 25px;}
</style>
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; font-family: 微軟正黑體;margin:30px"><?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('資料修改成功。');
window.location.href='GMM.php';
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
        <li class="active"><a href="GMM.php">溫室管理</a></li>
        <li><a href="SM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li><a href="PH.php?select=1">生產履歷</a></li>
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
     <h1 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="65" height="40">修改溫室</h1>
    <div class="dbg container"><!--div放白色背景透明度60%開始-->
        <form  name="cmform" method="post" onSubmit="return checkForm();" style="font-size: 20px;">
        <div class="form-group">
          <label for="gh_user">帳號：</label>
          <input type="hidden" name="gh_id" class="form-control" id="gh_id" value="<?php echo $row_result["gh_id"];?>">
          <input type="text" name="gh_user" class="form-control" id="gh_user" readonly="readonly" value="<?php echo $row_result["gh_user"];?>" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="gh_name">溫室名稱：</label>
          <input type="text" class="form-control" name="gh_name" value="<?php echo $row_result["gh_name"];?>" style="font-size: 20px;">
        </div>

		<div class="form-group">
          <label for="gh_num">溫室單位：</label>
          <input type="text" class="form-control" name="gh_num" value="<?php echo $row_result["gh_num"];?>" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="gh_add">溫室地址：</label>
          <input type="text" class="form-control" name="gh_add" value="<?php echo $row_result["gh_add"];?>" style="font-size: 20px;">
        </div>

        <div class="form-group">
          <label for="gh_data">溫室建置日：</label>
          <input type="text" class="form-control" name="gh_data" value="<?php echo $row_result["gh_data"];?>" style="font-size: 20px;">
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