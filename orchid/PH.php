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
$query_RecFlo = "SELECT * FROM `flower` WHERE `f_id`='".$_GET["select"]."' ";
$RecFlo = mysql_query($query_RecFlo);
$row_RecFlo=mysql_fetch_assoc($RecFlo);

include("MYSQL.php"); //这个文件是写了访问mysql权限的，自然我就不会列出
$count="SELECT * FROM `history` WHERE `h_on`='".$_GET["select"]."'";//計算歷史紀錄ㄉ筆數
$reCount = mysql_query($count);
$tenday = mysql_num_rows($reCount);
if($tenday<10){//計算限制的筆數
  $tenday1=0;}
  else{$tenday1=$tenday-10;}
$data = "SELECT * FROM `history` WHERE `h_on`='".$_GET["select"]."' ORDER BY `h_id` ASC limit $tenday1,10"; //查詢FROM 資料表 where 判斷式
$resultub = mysql_query($data);
while ($row = mysql_fetch_array($resultub)){
    $time[]=$row["h_date"];
    $h_leafNum[]=intval($row["h_leafNum"]);
    $h_pedlength[]=intval($row["h_pedlength"]);
    $h_bifNum[]=intval($row["h_bifNum"]);
    $h_bifNum1[]=intval($row["h_bifNum1"]);
    $h_bifNum2[]=intval($row["h_bifNum2"]);
    $maturity[]=intval($row["maturity"]);
}
$time = json_encode($time); //调用函数json_encode生成json数据。
$data = array(array("name"=>"葉片數量","data"=>$h_leafNum),array("name"=>"花梗長度","data"=>$h_pedlength),array("name"=>"分岔數","data"=>$h_bifNum),array("name"=>"第一分岔","data"=>$h_bifNum1),array("name"=>"第二分岔","data"=>$h_bifNum2),array("name"=>"成熟度","data"=>$maturity));
$data = json_encode($data);

$count1="SELECT * FROM `history` WHERE `h_on`='".$_GET["select"]."'";//計算歷史紀錄ㄉ筆數
$reCount1 = mysql_query($count1);
$thirtyday = mysql_num_rows($reCount1);
if($thirtyday<15){//計算限制的筆數
  $thirtyday1=0;}
  else{$thirtyday1=$thirtyday-15;}
$data1 = "SELECT * FROM `history` WHERE `h_on`='".$_GET["select"]."' ORDER BY `h_id` ASC limit $thirtyday1,15"; //查詢FROM 資料表 where 判斷式
$resultub1 = mysql_query($data1);
while ($row1 = mysql_fetch_array($resultub1)){
    $time_1[]=$row1["h_date"];
    $h_leafNum_1[]=intval($row1["h_leafNum"]);
    $h_pedlength_1[]=intval($row1["h_pedlength"]);
    $h_bifNum_1[]=intval($row1["h_bifNum"]);
    $h_bifNum1_1[]=intval($row1["h_bifNum1"]);
    $h_bifNum2_1[]=intval($row1["h_bifNum2"]);
    $maturity_1[]=intval($row1["maturity"]);
}
$time1 = json_encode($time_1); //调用函数json_encode生成json数据。
$data1 = array(array("name"=>"葉片數量","data"=>$h_leafNum_1),array("name"=>"花梗長度","data"=>$h_pedlength_1),array("name"=>"分岔數","data"=>$h_bifNum_1),array("name"=>"第一分岔","data"=>$h_bifNum1_1),array("name"=>"第二分岔","data"=>$h_bifNum2_1),array("name"=>"成熟度","data"=>$maturity_1));
$data1 = json_encode($data1);
$data2 = "SELECT * FROM `history` WHERE `h_on`='".$_GET["select"]."' ORDER BY `h_id` "; //查詢FROM 資料表 where 判斷式
$resultub2 = mysql_query($data2);
while ($row2 = mysql_fetch_array($resultub2)){
    $time_2[]=$row2["h_date"];
    $h_leafNum_2[]=intval($row2["h_leafNum"]);
    $h_pedlength_2[]=intval($row2["h_pedlength"]);
    $h_bifNum_2[]=intval($row2["h_bifNum"]);
    $h_bifNum1_2[]=intval($row2["h_bifNum1"]);
    $h_bifNum2_2[]=intval($row2["h_bifNum2"]);
    $maturity_2[]=intval($row2["maturity"]);
}
$time2 = json_encode($time_2); //调用函数json_encode生成json数据。
$data2 = array(array("name"=>"葉片數量","data"=>$h_leafNum_2),array("name"=>"花梗長度","data"=>$h_pedlength_2),array("name"=>"分岔數","data"=>$h_bifNum_2),array("name"=>"第一分岔","data"=>$h_bifNum1_2),array("name"=>"第二分岔","data"=>$h_bifNum2_2),array("name"=>"成熟度","data"=>$maturity_2));
$data2 = json_encode($data2);
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
    <script language="javascript">
    function deletesure(){
      if (confirm('\n您確定要刪除此筆資料嗎?\n刪除後無法恢復!\n')) return true;
      return false;
    }
</script>
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
            text: '近十天生長紀錄',
            x: -20, //center
            style:{
                fontSize:'24px'
              }
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: <?php echo $time; ?>,
            labels:{
              style:{
                fontSize:'16px'
              }
            }
        },
        yAxis: {
            title: {
                text: '公分(數量)',
                style:{
                fontSize:'18px'
              }
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }],
            labels:{
              style:{
                fontSize:'20px'
              }
            }
        },
        tooltip: {
            valueSuffix: '公分(數量)',
            style:{
                fontSize:'20px'
              }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series:
          <?php echo $data; ?>
    });
});
$(function () {
    Highcharts.chart('container1', {
        title: {
            text: '近十五天生長紀錄',
            x: -20, //center
            style:{
                fontSize:'24px'
              }
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: <?php echo $time1; ?>,
            labels:{
              style:{
                fontSize:'18px'
              }
            }
        },
        yAxis: {
            title: {
                text: '公分(數量)',
                style:{
                fontSize:'16px'
              }
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }],
            labels:{
              style:{
                fontSize:'20px'
              }
            }
        },
        tooltip: {
            valueSuffix: '公分(數量)',
            style:{
                fontSize:'20px'
              }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series:
          <?php echo $data1; ?>
    });
});
$(function () {
    Highcharts.chart('container2', {
        title: {
            text: '全部生長紀錄',
            x: -20, //center
            style:{
                fontSize:'24px'
              }
        },
        subtitle: {
            text: '',
            x: -20,
            style:{
                fontSize:'20px'
              }
        },
        xAxis: {
            categories: <?php echo $time2; ?>,
            labels:{
              style:{
                fontSize:'16px'
              }
            }
        },
        yAxis: {
            title: {
                text: '公分(數量)',
                style:{
                fontSize:'18px'
              }
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }],
            labels:{
              style:{
                fontSize:'20px'
              }
            }
        },
        tooltip: {
            valueSuffix: '公分(數量)'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series:
          <?php echo $data2; ?>
    });
});
    </script>
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
<h1 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="80" height="50">作物歷史紀錄</h1>
<hr>
<div class="col-xs-2 col-md-2"></div>
<div class="col-xs-8 col-md-8"><!--內文-->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type=”text/javascript” src=”http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js”></script>
<script type=”text/javascript” src=”http://www.hcharts.cn/demo/js/highcharts.js”></script>
<script type=”text/javascript” src=”http://www.hcharts.cn/demo/js/exporting.js”></script>
<?php
include("MYSQL.php"); //資料庫連線套用
$data = "SELECT * FROM `flower` WHERE `f_username`='".$_SESSION["loginMember"]."'"; //查詢FROM 資料表 where 判斷式(府和判斷式的才搜尋
$resultub = mysql_query($data);
?>
<div class="col-xs-4 col-md-4">
  <div class="thumbnail" style="text-align:center; font-size: 20px">
    <form action="" name="sort1" method="get">
      <select name="select" onChange="submit()">
      <option value=""><?php echo $row_RecFlo["f_biology"];?></option>
        <?php while ($rowub = mysql_fetch_array($resultub)):?>
        <option value="<?php echo $rowub["f_id"];?>"><?php echo $rowub["f_biology"];?></option>
        <?php endwhile?>
      </select>
      <a href="PH2.php?id=<?php echo $row_RecFlo["f_id"];?>">觀看列表</a>
    </form>
  </div>
</div>
</div>
<div class="col-xs-12 col-md-12">
  <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div><!--近10天折線圖-->
  <br>
  <div id="container1" style="min-width: 400px; height: 400px; margin: 0 auto"></div><!--30天折線圖-->
  <br>
  <div id="container2" style="min-width: 400px; height: 400px; margin: 0 auto"></div><!--全部折線圖-->
</div>
<div class="col-xs-2 col-md-2"></div>
<div class="col-xs-8 col-md-8">
<footer style="text-align:center">© 2016 腎藥蘭花管理系統 ©</footer>
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