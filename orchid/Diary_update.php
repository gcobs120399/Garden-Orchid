<?php
header("Content-Type: text/html; charset=utf-8;image/jpeg;image/gif;image/png");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
  if($_SESSION["memberLevel"]=="member" || $_SESSION["memberLevel"]=="admin"){
  }else{
    header("Location: Diary_view.php");
  }
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
  unset($_SESSION["loginMember"]);
  unset($_SESSION["memberLevel"]);
  header("Location: index.php");
}
$sql_db = "SELECT * FROM `picture` WHERE `p_id`=".$_GET["id"];
$result = mysql_query($sql_db);
$row_result=mysql_fetch_assoc($result);
//上傳檔案類型清單
$uptypes=array('image/jpg','image/jpeg','image/png','image/pjpeg','image/gif','image/bmp',
	'application/vnd.openxmlformats-officedocument.word</a>processingml.document',
	'application/pdf','application/msword</a>','image/x-png');
$max_file_size=2000000; //上傳檔案大小限制, 單位BYTE
$destination_folder="upload/"; //上傳檔路徑
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!is_uploaded_file($_FILES["upfile"]['tmp_name']))
		{//是否存在檔案
    if(isset($_POST["action"])&&($_POST["action"]=="update")){
      if (isset($_POST['p_text'])) {   //isset檢查變數是否設置
        require_once 'MYSQL.php';
        $p_text = $_POST['p_text'];
        $p_username = $_POST['p_username'];
        $date = $_POST['date'];
        $sql = "UPDATE `picture` SET `p_text`='{$p_text}', `p_username`='{$p_username}', `date`='{$date}' WHERE `p_id`=".$_GET["id"];
        mysql_query($sql)or die(mysql_error());
        header("Location: Diary.php?loginStats=1");
      }
    }
  }
  else{
      $file = $_FILES["upfile"];
if($max_file_size < $file["size"])
  {//檢查檔案大小
  echo "您選擇的檔太大了!";
  exit;}
if(!in_array($file["type"], $uptypes))
  {//檢查檔案類型
    echo "檔案類型不符!".$file["type"];
    exit;
  }
if(!file_exists($destination_folder))
  {
  mkdir($destination_folder);
  }
$filename=$file["tmp_name"];
$image_size = getimagesize($filename);
$pinfo=pathinfo($file["name"]);
$ftype=$pinfo['extension'];
$destination = $destination_folder.time().".".$ftype;
if (file_exists($destination) && $overwrite != true)
  {
    echo "同名檔已經存在了";
    exit;
  }
if(!move_uploaded_file ($filename, $destination))
{
  echo "移動檔出錯";
  exit;
}
$pinfo=pathinfo($destination);
$fname=$pinfo['basename'];
//將資料插入到資料庫中
$dizhi = "http://140.127.22.47/abc/"."$destination_folder"."$fname";//路徑
$name = $file['name'];//檔名
$size = $file["size"];//大小
if(isset($_POST["action"])&&($_POST["action"]=="update")){
  if (isset($_POST['p_text'])) {   //isset檢查變數是否設置
     require_once 'MYSQL.php';
    $p_text = $_POST['p_text'];
    $p_username = $_POST['p_username'];
    $date = $_POST['date'];
    $sql = "UPDATE `picture` SET `p_text`='{$p_text}', `p_username`='{$p_username}', `date`='{$date}', `filename`='{$name}', `filepic`='{$dizhi}', `filesize`='{$size}' WHERE `p_id`=".$_GET["id"];
    mysql_query($sql)or die(mysql_error());
      header("Location: Diary.php?loginStats=1");
  }
  else
  { echo"You did not upload any picture"; }
  }
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>腎藥蘭花管理系統</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./css/bootstrap.min.css" rel="stylesheet">
<script src="./js/ie-emulation-modes-warning.js"></script> 
<link rel="icon" href="./img/title.png">

  <!-- 最新編譯和最佳化的 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <!-- 選擇性佈景主題 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <!-- 最新編譯和最佳化的 JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
  <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
  <link rel="stylesheet" type="text/css" href="css/htmleaf-demo.css">
  <link rel="stylesheet" type="text/css" href="css/calendar.css">
  <link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS-->
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; font-family: 微軟正黑體;margin:30px">
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
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="prediction.php?select=10">生長預測</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li class="active"><a href="Diary.php">日誌</a></li>
        <li><a href="member_update.php">修改資料</a></li>
        <li><a href="?logout=true">登出</a></li>
      </ul>
    </div>
  </div>
</nav>
<br><br><br>
<h1 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="80" height="50">日誌修改</h1>
<hr>
<div style="background-image: url(img/w60.gif);background: rgba(100%,100%,100%,0.6);" class="col-xs-12"><!--div放白色背景透明度60%開始-->
</div>
<div class="row col-xs-12 ">
  <div class="col-md-1"></div>
  <div class="col-md-1"></div>
  <div class="col-md-1"></div>
  <div class="col-md-6">
    <div class="thumbnail">
    <form method="POST" Enctype="multipart/form-data" id="Dform" >
    <img alt="..." width="300" height="300" src="<?php echo $row_result['filepic']; ?>">
    <input name="upfile" type="file">
    <span style="text-align:left;color:red;font-size:14px;">如需更改圖片，請重新上傳檔案</span>
      <div class="caption" style="font-size: 20px;">
      <input type="text" name="p_title" id="p_title" value="<?php echo $row_result['p_title']; ?>"><br>
        <textarea rows="15" cols="60" name="p_text" id="p_text"><?php echo $row_result["p_text"]; ?></textarea><br>
        <input type="hidden" name="p_username" size="14" id="p_username" readonly="readonly" value="<?php echo $row_result["p_username"];?>">
		    <label for="date">日期</label>
		    <input type="text" placeholder="Date picker" id="date" name="date"><br>
        <input name="action" type="hidden" id="action" value="update">
        <input type="submit" name="Submit2" class="btn btn-info" value="送出" style="font-size: 16px;">
        <input type="reset" name="Submit3" class="btn btn-info" value="重設資料" style="font-size: 16px;">
        <input type="button" name="Submit" class="btn btn-info" value="回上一頁" onClick="window.history.back();" style="font-size: 16px;"></p>
      </div>
    </form>
    </div>
  </div>
  <div class="col-md-1"></div>
  <div class="col-md-1"></div>
  <div class="col-md-1"></div>
</div>
<div class="col-xs-12 col-md-2"></div>
<div class="col-xs-12 col-md-8" style="text-align: center;">© 2016 腎藥蘭花管理系統 ©</div>
<div class="col-xs-12 col-md-2"></div>
</body>
<script type="text/javascript">/*這為左邊菜單的JS，來源http://codepen.io/vkbansal/pen/QbapGz*/
  'use strict';
var burger = document.getElementById('burger-button');
burger.addEventListener('click', function (e) {
    e.preventDefault();
    document.body.classList.toggle('open');
    burger.classList.toggle('open');
});
</script>
<script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/locale/zh-cn.js"></script>
<script src="js/es6.js"></script>
<script>
	'use strict';
	$(function () {
		'use strict';
		$('#date').DatePicker({
		    startDate: moment()
		});
	});
</script>
</html>