<?php
header("Content-Type: text/html; charset=utf-8;image/jpeg;image/gif;image/png");
require_once("MYSQL.php");
session_start();
$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_id`=".$_GET["id"];
$RecMember = mysql_query($query_RecMember);
$row_RecMember=mysql_fetch_assoc($RecMember);
$count=0;
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
<!--巡覽列nav-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> 
        <span class="sr-only">Toggle navigation</span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span> 
      </button> 
      <a class="navbar-brand" href="">基於物聯網與KNN技術之腎藥蘭園監測及智慧生產管理系統</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="index.php">首頁</a></li>
        <li class="active"><a href="Diary_c.php">日誌</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php">登入 </a></li>
      <li><a href="member_join.php">註冊</a></li> 
      </ul>
    </div>
  </div>
</nav>
<br>
<h1 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="80" height="50"><?php echo $row_RecMember['m_name']?>的日誌</h1>
<div style="background-image: url(img/w60.gif);background: rgba(100%,100%,100%,0.6);" class="col-xs-12 "><!--div放白色背景透明度60%開始-->
</div>
<div class="row col-xs-12 ">
  <div class="col-md-2"></div>
  <div class="col-md-8">
<?php
include("MYSQL.php"); //資料庫連線套用
$data = "SELECT * FROM `picture` WHERE `m_no`='".$_GET["id"]."'ORDER BY `p_time` DESC"; //查詢FROM 資料表 where 判斷式(府和判斷式的才搜尋
$resultub = mysql_query($data);
while($rowub = mysql_fetch_array($resultub)){ //顯示資料
?>
      <div class="thumbnail">
      <?php if($rowub['filepic']!=""){?>
        <img alt="..." onMouseOver="this.width=this.width*1.5;this.height=this.height*1.5" onMouseOut="this.width=this.width/1.5;this.height=this.height/1.5" width="400" height="300" src="<?php echo $rowub['filepic']; ?>">
      <?php } ?>
      <div class="caption">
        <h3 style="text-align:center;"><?php echo $rowub['p_title']; ?></h3>
        <div style="">
          <p style="font-size: 20px;">
          <?php  echo nl2br($rowub['p_text']); ?>
          </p>
        </div>
        <span style="font-size:16px;"><?php echo $rowub['p_time']; ?></span><br>
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
        <p style="text-align:center;"><a class="btn btn-default" role="button" href="Diary_view1.php?id=<?php echo $rowub["p_id"];?>">READ MORE</a>
      </div>
    </div>
<?php }?>
  </div>
  <div class="col-md-2"></div>
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
<!--<script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>造成日誌一直轉-->
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