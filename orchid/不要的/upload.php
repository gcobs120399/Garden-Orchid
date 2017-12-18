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
?>
<html>
<head>
	<meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>作物管理</title>
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
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/abc.gif);background-size: cover; font-family: 微軟正黑體;margin:30px">
<h1 style="text-align:center;">日誌</h1>
<div style="text-align:center;">
  <input type="button" class="btn btn-info" size="12" value="溫室管理" onclick="location.href='GMM.php'">
  <input type="button" class="btn btn-info" size="12" value="設備管理" onclick="location.href='DMM.php'">
  <input type="button" class="btn btn-info" size="12" value="作物管理" onclick="location.href='CM.php'">
  <input type="button" class="btn btn-info" size="12" value="生產履歷" onclick="location.href='PH.php'">
  <input type="button" class="btn btn-info" size="12" value="溫室環境監控" onclick="location.href='GEMM.php'">
  <input type="button" class="btn btn-info" size="12" value="日誌" onclick="location.href='Diary.php'">
</div>
<hr>
<div style="background-image: url(img/w60.gif);background: rgba(100%,100%,100%,0.6);"><!--div放白色背景透明度60%開始-->
    <nav class="burger">
      <a href="#" class="burger__button" id="burger-button">
        <span class="burger__button__icon"></span>
      </a>
      <ul class="burger__menu">
        <li><a href="GMM.php">溫室管理</a></li>
        <li><a href="DMM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li><a href="PH.php">生產履歷</a></li>
        <li><a href="GEMM.php">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
      </ul>
    </nav>
</div>
<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-1"></div>
  <div class="col-md-1"></div>
  <div class="col-md-6">
    <div class="thumbnail">

    <form method="POST" enctype="multipart/form-data" id="Dform" >
    <!--action="upload.php"-->
      <input name="upfile" type="file">

      <div class="caption">
        <textarea rows="4" cols="50" name="p_text" id="p_text" placeholder="您在做什麼..."></textarea><br>
        <input type="hidden" name="p_username" size="14" id="p_username" readonly="readonly" value="<?php echo $row_RecMember["m_username"];?>">
		<label for="date">日期</label>
		<input type="text" placeholder="Date picker" id="date" name="date">
        <input name="action" type="hidden" id="action" value="join">
        <input type="submit" class="btn btn-default" name="Submit" value="送出"></p>
      </div>
      </form>
    </div>
  </div>
  <div class="col-md-1"></div>
  <div class="col-md-1"></div>
  <div class="col-md-1"></div>
</div>
<!--<form enctype="multipart/form-data" method="post" name="upform">
上傳檔案:

<input type="submit" value="上傳"><br>

允許上傳的檔案類型為:<?php echo implode(',',$uptypes)?>
</form>-->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (!is_uploaded_file($_FILES["upfile"]['tmp_name']))
		{//是否存在檔案
		echo "您還沒有選擇檔!";
		exit;}
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
/*echo " <font color=red>已經成功上傳</font><br>完整位址: <font color=blue>HTTP://localhost/abc/".$destination_folder.$fname."</font><br>";
echo "<br> 大小:".$file["size"]." bytes";
echo '<br>';*/
//將資料插入到資料庫中
$dizhi = "HTTP://localhost/abc/"."$destination_folder"."$fname";//路徑
$name = $file['name'];//檔名
$size = $file["size"];//大小
/*$sql = "INSERT INTO `excel`(`id`,`dizhi`,`name`) values ('Null','$dizhi','$name')";
mysql_query($sql);*/

if(isset($_POST["action"])&&($_POST["action"]=="join")){
	if (isset($_POST['p_text'])) {   //isset檢查變數是否設置
		 require_once 'MYSQL.php';
		$p_text = $_POST['p_text'];
		$p_username = $_POST['p_username'];
		$date = $_POST['date'];

		$sql = "INSERT INTO `picture`(`p_text` ,`p_username`,`date`,`filename`,`filepic`) VALUES ('$p_text' ,'$p_username','$date','$name','$dizhi')";
mysql_query($sql)or die(mysql_error());
		header("Location: Diary.php"); //新增完資料做網頁跳轉
	}
	else
	{ echo"You did not upload any picture"; }

	}






//echo "資料插入成功";
}


?>
</body>
<div id="gotop">˄</div>
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

	$("#gotop").click(function(){
    jQuery("html,body").animate({
        scrollTop:0
    },1000);
});
$(window).scroll(function() {
    if ( $(this).scrollTop() > 300){
        $('#gotop').fadeIn("fast");
    } else {
        $('#gotop').stop().fadeOut("fast");
    }
});
</script>
</html>