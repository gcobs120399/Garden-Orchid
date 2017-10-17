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
//繫結登入會員資料
$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
$RecMember = mysql_query($query_RecMember);
$row_RecMember=mysql_fetch_assoc($RecMember);
//上傳檔案類型清單
$uptypes=array('image/jpg','image/jpeg','image/png','image/pjpeg','image/gif','image/bmp',
	'application/vnd.openxmlformats-officedocument.word</a>processingml.document',
	'application/pdf','application/msword</a>','image/x-png');
$max_file_size=2000000; //上傳檔案大小限制, 單位BYTE
$destination_folder="upload/"; //上傳檔路徑

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!is_uploaded_file($_FILES["upfile"]['tmp_name']))
		{/*//是否存在檔案
		echo "您還沒有選擇檔!";
		exit;*/
    if(isset($_POST["action"])&&($_POST["action"]=="join")){
    if (isset($_POST['p_text'])) {   //isset檢查變數是否設置
     require_once 'MYSQL.php';
    $p_text = ($_POST['p_text']);
    $p_title=$_POST['p_title'];
    $p_username = $_POST['p_username'];
    $date = $_POST['date'];
    $m_no = $_POST['m_no'];
    $sql = "INSERT INTO `picture`(`p_text` ,`p_username`, `p_title`,`date`,`m_no`) VALUES ('$p_text' ,'$p_username','$p_title','$date','$m_no')";
    mysql_query($sql)or die(mysql_error());
    header("Location: Diary.php?loginStats=1"); //新增完資料做網頁跳轉
  }
  else
  { echo"You did not upload any picture"; }}
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
if(isset($_POST["action"])&&($_POST["action"]=="join")){
  if (isset($_POST['p_text'])) {   //isset檢查變數是否設置
     require_once 'MYSQL.php';
    $p_text = ($_POST['p_text']);
    $p_title=$_POST['p_title'];
    $p_username = $_POST['p_username'];
    $date = $_POST['date'];
    $m_no = $_POST['m_no'];
    $sql = "INSERT INTO `picture`(`p_text` ,`p_username`, `p_title`,`date`,`m_no`,`filename`,`filepic`,`filesize`) VALUES ('$p_text' ,'$p_username','$p_title','$date','$m_no','$name','$dizhi','$size')";
    mysql_query($sql)or die(mysql_error());
    //header("Location: Diary.php"); //新增完資料做網頁跳轉
  }
  else
  { echo"You did not upload any picture"; }
  }
    }
}
$count=0;
?>
<!DOCTYPE html>
<html>
<head>
	<meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>腎藥蘭花管理系統</title>

<!--呆的巡覽列-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link href="./css/navbar-fixed-top.css" rel="stylesheet"> 
<script src="./js/ie-emulation-modes-warning.js"></script> 
<link rel="icon" href="./img/title.png">
<!--呆-->

	<!-- 最新編譯和最佳化的 CSS -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<!-- 選擇性佈景主題 -->
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<!-- 最新編譯和最佳化的 JavaScript -->
	<script type="js/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="css/htmleaf-demo.css">
	<link rel="stylesheet" type="text/css" href="css/calendar.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS-->
  <style type="text/css">
    p{/*自動斷行*/
    overflow : hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 5;
    -webkit-box-orient: vertical;
}
</style>
</head>
<body style="text-align:left;font-size:18px;background-image: url(img/46505.png);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">

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
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="prediction.php">生長預測</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li class="active"><a href="Diary.php">日誌</a></li>
      </ul>
    </div>
  </div>
</nav>
<br>
<br>
<h1 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="80" height="50">日誌</h1>
<!--<div style="text-align:center;">
  <input type="button" class="btn btn-info" size="12" value="溫室管理" onclick="location.href='GMM.php'">
  <input type="button" class="btn btn-info" size="12" value="設備管理" onclick="location.href='DMM.php'">
  <input type="button" class="btn btn-info" size="12" value="作物管理" onclick="location.href='CM.php'">
  <input type="button" class="btn btn-info" size="12" value="生產履歷" onclick="location.href='PH2.php'">
  <input type="button" class="btn btn-info" size="12" value="溫室環境監控" onclick="location.href='GEMM.php'">
  <input type="button" class="btn btn-info" size="12" value="日誌" onclick="location.href='Diary.php'">
</div>-->
<hr>
<div class="col-xs-2 col-md-2"></div>
<!--旁邊菜單nav_burger
<div class="col-xs-2 col-md-2">
 <nav class="burger">
      <a href="#" class="burger__button" id="burger-button">
        <span class="burger__button__icon"></span>
      </a>
      <ul class="burger__menu">
        <li><a href="member_center.php">首頁</a></li>
        <li><a href="GMM.php">溫室管理</a></li>
        <li><a href="DMM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
      </ul>
    </nav>
</div>-->

  <div class=" col-xs-8 col-md-8">
    <div class="thumbnail">
    <form method="POST" Enctype="multipart/form-data" id="Dform" >
      <input name="upfile" type="file">
      <div class="caption" style="text-align:center;">
      <input type="hidden" name="m_no" id="m_no" value="<?php echo $row_RecMember["m_id"];?>">
      <input type="text" name="p_title" size="14" id="p_title" placeholder="標題"><br>
        <textarea rows="4" cols="60" wrap="virtual" name="p_text" id="p_text" placeholder="您在做什麼..."></textarea><br>
        <input type="hidden" name="p_username" size="14" id="p_username" readonly="readonly" value="<?php echo $row_RecMember["m_username"];?>">
		<label for="date">日期</label>
		<input type="text" placeholder="Date picker" id="date" name="date">
        <input name="action" type="hidden" id="action" value="join"> &nbsp
        <input type="submit" class="btn btn-default" name="Submit" value="送出"><p>
      </div>
    </form>
    </div>
<?php
include("MYSQL.php"); //資料庫連線套用
$data = "SELECT * FROM picture WHERE `p_username`='".$_SESSION["loginMember"]."'ORDER BY `p_time` DESC"; //查詢FROM 資料表 where 判斷式(府和判斷式的才搜尋
$resultub = mysql_query($data);
while($rowub = mysql_fetch_array($resultub)){ //顯示資料
?>
      <div class="thumbnail">
      <?php if($rowub['filepic']!=""){?>
        <img alt="..." onMouseOver="this.width=this.width*1.5;this.height=this.height*1.5" onMouseOut="this.width=this.width/1.5;this.height=this.height/1.5" width="300" height="300" src="<?php echo $rowub['filepic']; ?>">
      <?php } ?>
      <div class="caption">
        <a style="color:black;font-weight:border;" href="Diary1.php?id=<?php echo $rowub["p_id"];?>"><h3 style="text-align:center;"><?php echo $rowub['p_title']; ?></h3></a>
        <p>
        <?php  echo nl2br($rowub['p_text']); ?>
        </p>
        <span style="font-size:14px;"><?php echo $rowub['p_time']; ?></span><br>
<?php
include("MYSQL.php"); //資料庫連線套用
$data1 = "SELECT * FROM message"; //查詢FROM 資料表 where 判斷式(府和判斷式的才搜尋
$resultub1 = mysql_query($data1);
while($rowub1 = mysql_fetch_array($resultub1)){ //顯示資料
?>
  <?php if($rowub1['s_on'] == $rowub['p_id']){?>
    <?php $count=$count+1;?>
  <?php }?>
<?php }?>
        <span style="font-size:18px;font-weight:border;color:blue;">(<?php echo $count; ?>則留言)</span>
        <?php $count=0;?>
        <p style="text-align:center;"><a class="btn btn-default" role="button" href="Diary1.php?id=<?php echo $rowub["p_id"];?>">READ MORE</a>
      </div>
    </div>
<?php }?>
</div>

<div class="col-xs-12 col-md-12" style="text-align: center;">© 2016 腎藥蘭花管理系統 ©</div>

<div id="gotop">˄</div>

<!--呆的巡覽列-->
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/ie10-viewport-bug-workaround.js"></script>
<!--呆-->

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

	$("#gotop").click(function(){/*至頂按鈕*/
    jQuery("html,body").animate({
        scrollTop:0
    },1000);
});
$(window).scroll(function() {/*至頂按鈕*/
    if ( $(this).scrollTop() > 300){
        $('#gotop').fadeIn("fast");
    } else {
        $('#gotop').stop().fadeOut("fast");
    }
});
</script>
</html>