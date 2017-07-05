<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
  header("Location: index.php");}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
  unset($_SESSION["loginMember"]);
  unset($_SESSION["memberLevel"]);
  header("Location: index.php");
}
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
    //右邊上方監控
    $(document).ready(function() {
            var options = {
                chart: {
                    renderTo: 'container',
                    type: 'line',
                    marginRight: 130,//右外邊距
                    marginBottom: 120 //折線圖下外邊距

                },
                title: {
                    text: '右邊上方監控',
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
                        text: '右邊上方設備'
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
            $.getJSON("data_right.php", function(json) {
                options.xAxis.categories = json[3]['data'];
                options.series[0] = json[0];
                options.series[1] = json[1];
                options.series[2] = json[2];
                chart = new Highcharts.Chart(options);
            });
        });
        //右邊下方監控
$(document).ready(function() {
            var options = {
                chart: {
                    renderTo: 'container1',
                    type: 'line',
                    marginRight: 130,//右外邊距
                    marginBottom: 120 //折線圖下外邊距

                },
                title: {
                    text: '右邊下方監控',
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
                        text: '右邊下方設備'
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
            $.getJSON("data_right1.php", function(json) {
                options.xAxis.categories = json[3]['data'];
                options.series[0] = json[0];
                options.series[1] = json[1];
                options.series[2] = json[2];
                chart = new Highcharts.Chart(options);
            });
        });
    </script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
      <script src="http://code.highcharts.com/modules/exporting.js"></script>
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; font-family: 微軟正黑體;margin:30px">
<h1><img src="img/LOGO.png" alt="LOGO" width="80" height="50">歷史紀錄</h1>
<form name="" method="" action="">
<hr>
<div style="background-image: url(img/w60.gif);background: rgba(100%,100%,100%,0.6);"><!--div放白色背景透明度60%開始-->

<div class="btn-group col-xs-12" role="group" style="font-size:18px;">
<input type="button" class="btn btn-info" style="width:50px;" value="左" onclick="location.href='history_left.php'">
<input type="button" class="btn btn-info" style="width:50px;" value="中" onclick="location.href='history_center.php'">
<input type="button" class="btn btn-primary" style="width:50px;" value="右" onclick="location.href='history_right.php'">
</div>

<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto" class="col-xs-12"></div>
<hr>
<div id="container1" style="min-width: 400px; height: 400px; margin: 0 auto" class="col-xs-12"></div>
<div class="col-xs-12">
  <input type="button" class="btn btn-info" size="12" value="回首頁" onclick="location.href='index.php'">
</div>
    <footer>© 2016 農業物聯生產管理系統 ©</footer>
</form>

</div><!--div放白色背景透明度60%結束-->
</body>
</html>