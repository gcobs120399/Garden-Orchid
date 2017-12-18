<?php
header("Content-Type: text/html; charset=utf-8;image/jpeg;image/gif;image/png");
require_once("MYSQL.php");
session_start();
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
  //若帳號等級為 member 則導向會員中心
  if($_SESSION["memberLevel"]=="admin"){
    header("Location: CM_admin.php");}
}//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
  unset($_SESSION["loginMember"]);
  unset($_SESSION["memberLevel"]);
  header("Location: index.php");}

$query_RecHis = "SELECT * FROM `flower` WHERE `f_id`='".$_GET["select"]."'";
$RecHis = mysql_query($query_RecHis);
$row_RecHis=mysql_fetch_assoc($RecHis);//抓作物名稱

include("MYSQL.php"); //这个文件是写了访问mysql权限的，自然我就不会列出
$data = "SELECT * FROM `history` WHERE `h_on`='".$_GET["select"]."' ORDER BY h_jointime DESC LIMIT 0,10"; // get select 抓下拉式表單的值(value裡)，ORDER BY h_jointime DESC是以h_jointime做遞減排序，LIMIT 0,10 從第0筆資料開始抓10筆
$resultub = mysql_query($data);
while ($row = mysql_fetch_array($resultub)){

    $time[]=$row["h_jointime"];
    $h_stems[]=intval($row["h_stems"]);
    $h_leafsize[]=intval($row["h_leafsize"]);
    $h_leafNum[]=intval($row["h_leafNum"]);
    $h_pedlength[]=intval($row["h_pedlength"]);
    $h_pedNum[]=intval($row["h_pedNum"]);
    $h_bifNum[]=intval($row["h_bifNum"]);
}
$time = json_encode($time); //调用函数json_encode生成json数据。
$data = array(array("name"=>"莖高","data"=>$h_stems),array("name"=>"葉片大小","data"=>$h_leafsize),array("name"=>"葉片數量","data"=>$h_leafNum),array("name"=>"花梗長度","data"=>$h_pedlength),array("name"=>"花梗數量","data"=>$h_pedNum),array("name"=>"分岔數","data"=>$h_bifNum));
$data = json_encode($data);
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title>作物管理</title>
  <!-- 最新編譯和最佳化的 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <!-- 選擇性佈景主題 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <!-- 最新編譯和最佳化的 JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS+頂端-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>


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
  <body style="text-align:left;font-size:18px;background-image: url(img/46503.jpg);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">
<h1 style="text-align:center;">作物歷史紀錄</h1>
<hr>
<div style="background-image: url(img/w60.gif);background: rgba(100%,100%,100%,0.6);" class="col-xs-12"><!--div放白色背景透明度60%開始-->
    <nav class="burger">
      <a href="#" class="burger__button" id="burger-button">
        <span class="burger__button__icon"></span>
      </a>
      <ul class="burger__menu">
    <li><a href="GMM.php">溫室管理</a></li>
    <li><a href="SM.php">設備管理</a></li>
    <li><a href="CM.php">作物管理</a></li>
    <li><a href="PH2.php">生產履歷</a></li>
    <li><a href="GEMM.php">溫室環境監控</a></li>
    <li><a href="Diary.php">日誌</a></li>
      </ul>
    </nav>
</div>
<div class="row col-xs-12">
  <div class="col-xs-12 col-md-2"></div>
  <div class="col-xs-12 col-md-8">


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
  <div class="col-xs-12 col-md-4">
    <div class="col-xs-12 thumbnail" style="text-align:center;">
    <form action="" name="sort1" method="get">
      <select name="select" onChange="submit()"><!--onChange="submit()"是選擇完立刻送出，傳下拉式選單的value值到折線圖-->
      <option value=""></option><!--必須預設一個空白的，否則將選不到作物的第一筆-->
        <?php while ($rowub = mysql_fetch_array($resultub)):?>
        <option value="<?php echo $rowub["f_id"];?>"><?php echo $rowub["f_biology"];?></option>
        <?php endwhile?>
      </select>
    </form>
    </div>
    <span><?php echo $row_RecHis["f_biology"];?></span><!--最上方抓作物名稱的指令用在這-->
</div>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto" class="col-xs-12"></div>
<div class="col-xs-12 col-md-2"></div>
<div class="col-xs-12 col-md-8" style="text-align:center">© 2016 農業物聯生產管理系統 ©</div>
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

