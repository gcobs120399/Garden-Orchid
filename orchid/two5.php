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
  if(document.cmform.f_biology.value==""){//注意表格名稱
    alert("請填寫品種!");
    document.cmform.f_biology.focus();
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
<body><?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('資料新增成功。');
window.location.href='two4.php';
</script>
<?php }?>
<!-- Sidebar -->
  <div class="w3-sidebar w3-bar-block w3-animate-left" style="display:none;z-index:5" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Close &times;</button>
    <a href="#" class="w3-bar-item w3-button">首頁</a>
    <a href="#" class="w3-bar-item w3-button">溫室管理</a>
    <a href="#" class="w3-bar-item w3-button">設備管理</a>
    <a href="#" class="w3-bar-item w3-button">作物管理</a>
    <a href="#" class="w3-bar-item w3-button">生產履歷</a>
    <a href="#" class="w3-bar-item w3-button">生長預測</a>
    <a href="#" class="w3-bar-item w3-button">溫室環境監控</a>
    <a href="#" class="w3-bar-item w3-button">日誌</a>
  </div>
  <!-- Page Content -->
  <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

  <div>
    <button class="w3-button w3-xlarge" onclick="w3_open()">&#9776;</button>
     <h2 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="65" height="40">新增作物</h2>
    <div class="dbg container"><!--div放白色背景透明度60%開始-->
        <form  name="cmform" method="post" onSubmit="return checkForm();">
        <div class="form-group">
          <label for="usr">帳號：</label>
          <input type="text" name="f_username" class="form-control" id="f_username" readonly="readonly" value="<?php echo $row_RecMember["m_username"];?>">
        </div>
        <div class="form-group">
          <label for="biology">品種：</label>
          <input type="text" class="form-control" name="f_biology" >
        </div>
        <div class="form-group">
          <label for="radio">位置：</label>
          <div class="radio" id="p1">
          <label><input type="radio" name="f_location" value="左">左</label><br>
          <label><input type="radio" name="f_location" value="中">中</label><br>
          <label><input type="radio" name="f_location" value="右">右</label>
          </div>
        </div>
        <div class="form-group">
          <center>
          <input name="action" type="hidden" id="action" value="join">
          <input type="submit" class="btn btn-info btn-sm" name="Submit2" value="送出">
          <input type="reset" class="btn btn-info btn-sm" name="Submit3" value="重設資料">
          <input type="button" class="btn btn-info btn-sm" name="Submit" value="回上一頁" onClick="window.history.back();"></center>
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
<!--
    <form name="cmform" method="post" onSubmit="return checkForm();">
    <p id="p1"><strong>帳號：</strong>
      <input type="text" name="f_username" maxlength="" size="14" id="f_username" readonly="readonly" value="<?php echo $row_RecMember["m_username"];?>">
    </p>
    <p id="p1"><strong>品種：</strong>
      <input type="text" name="f_biology" maxlength="" size="14" id="f_biology">
    </p>
    <p id="p1"><strong>位置：</strong><center>
      <input type="radio" name="f_location" value="左"> 左<br>
      <input type="radio" name="f_location" value="中"> 中<br>
      <input type="radio" name="f_location" value="右"> 右<br></center>
    </p>
    <p id="p1">
      <input name="action" type="hidden" id="action" value="join">
       <input type="submit" class="btn btn-info" name="Submit2" value="送出">
              <input type="reset" class="btn btn-info" name="Submit3" value="重設資料">
        <input type="button" class="btn btn-info" name="Submit" value="回上一頁" onClick="window.history.back();">
    </p>
    </form> -->