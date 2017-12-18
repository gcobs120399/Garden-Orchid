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


$data = "SELECT * FROM `history` WHERE `h_on`=1 ORDER BY h_jointime ASC LIMIT 0,10"; //查詢FROM 資料表 where 判斷式(府和判斷式的才搜尋"SELECT * FROM `history` WHERE `h_on`='".$_GET["select"]."' ORDER BY h_jointime ASC LIMIT 0,10"

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
print_r($data)

//
?>
<!DOCTYPE html>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $.getJSON("data_PH.php", function(json) {
                options.xAxis.categories = json[3]['data'];
                options.series[0] = json[0];
                options.series[1] = json[1];
                options.series[2] = json[2];
                chart = new Highcharts.chart(options);
            });
            var options = {
                chart: {
                    renderTo: 'container',
                    type: 'line',
                    marginRight: 130,//右外邊距
                    marginBottom: 120 //折線圖下外邊距
                },
                title: {
                    text: '作物生長紀錄',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: []
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
                    formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                            this.x +': '+ this.y;
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
                series: []
            }
        });
$(document).ready(function() {
  $.getJSON("data_PH1.php", function(json) {
                options.xAxis.categories = json[3]['data'];
                options.series[0] = json[0];
                options.series[1] = json[1];
                options.series[2] = json[2];
                chart = new Highcharts.chart(options);
            });
            var options = {
                chart: {
                    renderTo: 'container1',
                    type: 'line',
                    marginRight: 130,//右外邊距
                    marginBottom: 120 //折線圖下外邊距
                },
                title: {
                    text: '作物生長紀錄',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: []
                },
                yAxis: {
                    title: {
                        text: '數量'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                            this.x +': '+ this.y;
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
                series: []
            }
        });
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
</head>
<body style="text-align:left;font-size:18px;background-image: url(img/46503.jpg);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">
  <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto" class="col-xs-12"></div>
  <div id="container1" style="min-width: 400px; height: 400px; margin: 0 auto" class="col-xs-12"></div>








<footer style="text-align:center">© 2016 農業物聯生產管理系統 ©</footer>
</body>
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