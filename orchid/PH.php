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
$beginWeek=date("Y-m-d", mktime(0, 0, 0, date('m'), date('d')-7, date('Y')));

$endWeek=date("Y-m-d", mktime(0, 0, 0, date('m'), date('d'), date('Y')));

include("MYSQL.php"); //这个文件是写了访问mysql权限的，自然我就不会列出LIMIT
$count="SELECT * FROM `history` WHERE `h_on`='".$_GET["select"]."'";//計算歷史紀錄ㄉ筆數
$reCount = mysql_query($count);
$num = mysql_num_rows($reCount);
if($num<10){//計算限制的筆數
  $num1=0;
}else{
  $num1=$num-10;
}
$data = "SELECT * FROM `history` WHERE `h_on`='".$_GET["select"]."' ORDER BY `h_id` ASC limit $num1,10"; //查詢FROM 資料表 where 判斷式
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
            text: '生長紀錄',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: <?php echo $time; ?>
        },
        yAxis: {
            title: {
                text: '公分(數量)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
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
          <?php echo $data; ?>
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
      <ul class="nav navbar-nav">
        <li><a href="member_center.php">首頁</a></li>
        <li><a href="GMM.php">溫室管理</a></li>
        <li><a href="SM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li class="active"><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="prediction.php">生長預測</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
      </ul>
    </div>
  </div>
</nav>

<br>
<h1 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="80" height="50">作物歷史紀錄</h1>
<hr>

<div class="col-xs-2 col-md-2">
<!--旁邊菜單nav_burger
 <nav class="burger">
      <a href="#" class="burger__button" id="burger-button">
        <span class="burger__button__icon"></span>
      </a>
      <ul class="burger__menu">
        <li><a href="member_center.php">首頁</a></li>
        <li><a href="GMM.php">溫室管理</a></li>
        <li><a href="DMM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li><a href="PH2.php">生產履歷</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
      </ul>
    </nav>-->
</div>
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
  <div class="thumbnail" style="text-align:center;">
    <form action="" name="sort1" method="get">
      <select name="select" onChange="submit()">
      <option value=""><?php echo $row_RecFlo["f_biology"];?></option>
        <?php while ($rowub = mysql_fetch_array($resultub)):?>
        <option value="<?php echo $rowub["f_id"];?>"><?php echo $rowub["f_biology"];?></option>
        <?php endwhile?>
      </select>
    </form>
  </div>
</div>
<!--
<div class="col-xs-4 col-md-4">
<form>
  <table>
    <tr>
      <td>莖高：</td>
      <td><?php echo $row_RecHis["h_stems"];?></td>
    </tr>
    <tr>
      <td>葉片大小(CM)：</td>
      <td><?php echo $row_RecHis["h_leafsize"];?></td>
    </tr>
    <tr>
      <td>葉片數量：</td>
      <td><?php echo $row_RecHis["h_leafNum"];?></td>
    </tr>
    <tr>
      <td>花梗長度(CM)：</td>
      <td><?php echo $row_RecHis["h_pedlength"];?></td>
    </tr>
    <tr>
      <td>花梗數量：</td>
      <td><?php echo $row_RecHis["h_pedNum"];?></td>
    </tr>
    <tr>
      <td>分岔數：</td>
      <td><?php echo $row_RecHis["h_bifNum"];?></td>
    </tr>
    <tr>
      <td>第一分岔：</td>
      <td><?php echo $row_RecHis["h_bifNum1"];?></td>
    </tr>
    <tr>
      <td>第二分岔：</td>
      <td><?php echo $row_RecHis["h_bifNum2"];?></td>
    </tr>
    <tr>
      <td>日期：</td>
      <td><input type="text" placeholder="Date picker" id="date1" name="date1" onChange="submit()"></td>
    </tr>
  </table>
</form>
</div>
-->
</div>

<div class="col-xs-12 col-md-12">
  <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div><!--折線圖-->
</div>
<div class="col-xs-2 col-md-2"></div>
<div class="col-xs-8 col-md-8">
<footer style="text-align:center">© 2016 腎藥蘭花管理系統 ©</footer>
</div>
<div class="col-xs-2 col-md-2"></div>



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
<!--這段是影響圖表數度
<script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/locale/zh-cn.js"></script>
<script src="js/es6.js"></script>
<script>
	'use strict';
	$(function () {
		'use strict';
		$('#date1').DatePicker({
		    startDate: moment()
		});
	});
</script>-->
</html>