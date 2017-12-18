<?php
include("MYSQL.php");
if (!@mysql_select_db("phpmember")) die("資料庫選擇失敗！");
if(isset($_POST["action"])&&($_POST["action"]=="update")){
      if (isset($_POST['f_biology'])) {   //isset檢查變數是否設置
        require_once 'MYSQL.php';
        $f_biology = $_POST['f_biology'];
        $f_username = $_POST['f_username'];
        $f_location = $_POST['f_location'];
        $f_act = $_POST['f_act'];
        $sql = "UPDATE `flower` SET `f_biology`='{$f_biology}', `f_username`='{$f_username}', `f_location`='{$f_location}', `f_act`='{$f_act}' WHERE `f_id`=".$_GET["id"];
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
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; font-family: 微軟正黑體;margin:30px"><?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('資料修改成功。');
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
     <h2 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="65" height="40">新增作物</h2>
    <div class="dbg container"><!--div放白色背景透明度60%開始-->
        <form  name="cmform" method="post" onSubmit="return checkForm();" style="font-size: 20px;">
        <div class="form-group">
          <label for="usr">帳號：</label>
          <input type="text" name="f_username" class="form-control" id="f_username" readonly="readonly" value="<?php echo $row_RecMember["m_username"];?>" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="biology">品種：</label>
          <input type="text" class="form-control" name="f_biology" value="<?php echo $row_result["f_biology"];?>" style="font-size: 20px;">
        </div>
        <div class="form-group">
          <label for="radio">位置：</label>
          <div class="radio" id="p1">
          <label><input type="radio" name="f_location" value="左" <?php if($row_result["f_location"]=="左") echo "checked";?>>左</label><br>
          <label><input type="radio" name="f_location" value="中" <?php if($row_result["f_location"]=="中") echo "checked";?>>中</label><br>
          <label><input type="radio" name="f_location" value="右" <?php if($row_result["f_location"]=="右") echo "checked";?>>右</label>
          </div>
        </div>
        <div class="form-group">
          <label for="radio">狀態：</label>
          <div class="radio" id="p1">
          <label><input type="radio" name="f_act" value="種植中" <?php if($row_result["f_act"]=="種植中") echo "checked";?>>種植中</label><br>
          <label><input type="radio" name="f_act" value="已採收" <?php if($row_result["f_act"]=="已採收") echo "checked";?>>已採收</label>
          </div>
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