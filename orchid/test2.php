<?php
header("Content-Type: text/html; charset=utf-8;image/jpeg;image/gif;image/png");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
  header("Location: index.php");}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
  unset($_SESSION["loginMember"]);
  unset($_SESSION["memberLevel"]);
  header("Location: index.php");}

$beginYesterday=date("Y-m-d 00:00:00", mktime(0, 0, 0, date('m'), date('d')-1, date('Y')));

$endYesterday=date("Y-m-d 23:59:59", mktime(0, 0, 0, date('m'), date('d')-1, date('Y')));
$query_RecYesterday = "SELECT * FROM `_center` WHERE `C_time` BETWEEN '$beginYesterday' AND '$endYesterday' ORDER BY `C_time` ASC";
$RecYesterday = mysql_query($query_RecYesterday);
$row_RecYesterday=mysql_fetch_assoc($RecYesterday);

$x=array();$i=0;$sum=0;//計算溫度
$x1=array();$sum1=0;//計算濕度
$x2=array();$sum2=0;//計算日照
while($row_RecYesterday=mysql_fetch_assoc($RecYesterday)){
  $x[$i]=$row_RecYesterday["temp_2"];
  $x1[$i]=$row_RecYesterday["humi_2"];
  $x2[$i]=$row_RecYesterday["light_1"];
  $i=$i+1;}
for($j=0;$j<=46;$j++){
$sum=$sum+$x[$j];
$sum1=$sum1+$x1[$j];
$sum2=$sum2+$x2[$j];
}
if(isset($_POST["action"])&&($_POST["action"]=="join")){
  if (isset($_POST['temp_1'])) {   //isset檢查變數是否設置
     require_once 'MYSQL.php';
    $temp_1 = $_POST['temp_1'];
    $humi_1 = $_POST['humi_1'];
    $light_1 = $_POST['light_1'];
    $date = date("Y-m-d 00:00:00", mktime(0, 0, 0, date('m'), date('d')-1, date('Y')));
    $sql = "INSERT INTO `avg`(`temp_1`,`humi_1`,`light_1`,`date`) VALUES ('$temp_1','$humi_1','$light_1','$date')";
    mysql_query($sql)or die(mysql_error());
    header("Location: test2.php?loginStats=1"); //新增完資料做網頁跳轉
  }
}
$query_RecTime = "SELECT * FROM `avg` ORDER BY `time` DESC";
$RecTime = mysql_query($query_RecTime);
$row_RecTime=mysql_fetch_assoc($RecTime);

?>
<!DOCTYPE html>
<html>
<head>
  <meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title>蘭花管理系統</title>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link href="./css/navbar-fixed-top.css" rel="stylesheet"> 
<script src="./js/ie-emulation-modes-warning.js"></script> 
<link rel="icon" href="./img/title.png">


  <!-- 最新編譯和最佳化的 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <!-- 選擇性佈景主題 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <!-- 最新編譯和最佳化的 JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS+頂端-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/calendar.css"><!--日期選擇器-->
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <style type="text/css">
${demo.css}
    </style>
    <script type="text/javascript">
$(function () {
    Highcharts.chart('container', {
        title: {
            text: '生長預測',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: ['第一天', '第二天', '第三天', '第四天']
        },
        yAxis: {
            title: {
                text: '公分'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '公分'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: '預測莖高',
            data: [35.3, 35.25,35.275 , 35.34]
        }, {
          name: '莖高',
            data: [35.3, 35.25, 35.275]
        }]
    });
});
    </script>
</head>

<body style="text-align:left;font-size:18px;background-image: url(img/46505.png);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">

<!--巡覽列black-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header"> 
     <a class="navbar-brand" href="member_center.php" style="font-size: 24pt;">應用物聯網技術之蘭園智慧生產管理與知識系統</a>
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
        <li class="active"><a href="prediction.php">生長預測</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
      </ul>
    </div>
  </div>
</nav>

<br>
<h1 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="80" height="50">作物預測紀錄</h1>
<hr>
<div>
<form name="avgform" method="post" onSubmit="return checkForm();" >
<?php echo round(($sum/46),2);?>/<?php echo round(($sum1/46),2);?>/<?php echo round(($sum2/46),2);?>
<input type="hidden" name="temp_1" size="14" id="temp_1" value="<?php echo round(($sum/46),2);?>">
<input type="hidden" name="humi_1" size="14" id="humi_1" value="<?php echo round(($sum1/46),2);?>">
<input type="hidden" name="light_1" size="14" id="light_1" value="<?php echo round(($sum2/46),2);?>">

<input name="action" type="hidden" id="action" value="join">
<input type="submit" class="btn btn-info" name="Submit2" value="更新資料"><br>
最後更新時間：<?php echo $row_RecTime["time"];?>
</form?>
<div>

<div class="col-xs-2 col-md-2">
</div>
<div class="col-xs-8 col-md-8"><!--內文-->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type=”text/javascript” src=”http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js”></script>
<script type=”text/javascript” src=”http://www.hcharts.cn/demo/js/highcharts.js”></script>
<script type=”text/javascript” src=”http://www.hcharts.cn/demo/js/exporting.js”></script>
<div class="col-xs-4 col-md-4">
  <div class="thumbnail" style="text-align:center;">
    <form action="" name="sort1" method="get">
      <select name="select" onChange="submit()">
      <option value="4">蘭花D</option>
        <option value="4">蘭花D</option>
      </select>
    </form>
  </div>
</div>
</div>

<div class="col-xs-12 col-md-12">
  <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div><!--折線圖-->
</div>
<div class="col-xs-2 col-md-2"></div>
<div class="col-xs-8 col-md-8">
<footer style="text-align:center">© 2016 農業物聯生產管理系統 ©</footer>
</div>
<div class="col-xs-2 col-md-2"></div>




<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/ie10-viewport-bug-workaround.js"></script>


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
</html>