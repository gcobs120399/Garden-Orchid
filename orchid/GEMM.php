<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
  header("Location: index.php");
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
  unset($_SESSION["loginMember"]);
  unset($_SESSION["memberLevel"]);
  header("Location: index.php");
}

require_once("connMysql.php");
//左
$query_RecLeft = "SELECT * FROM `_left` ORDER BY date DESC";
$RecLeft = mysql_query($query_RecLeft);
$row_RecLeft=mysql_fetch_assoc($RecLeft);

//中
$query_RecCenter = "SELECT * FROM `_center` ORDER BY date DESC";
$RecCenter = mysql_query($query_RecCenter);
$row_RecCenter=mysql_fetch_assoc($RecCenter);

//右
$query_RecRight = "SELECT * FROM `_right` ORDER BY date DESC";
$RecRight = mysql_query($query_RecRight);
$row_RecRight=mysql_fetch_assoc($RecRight);
?>
<!DOCTYPE html>
<html>
<head>
  <meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title>溫室環境即時監測</title>
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
      <ul class="nav navbar-nav">
        <li><a href="member_center.php">首頁</a></li>
        <li><a href="GMM.php">溫室管理</a></li>
        <li class="active"><a href="SM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
      </ul>
    </div>
  </div>
</nav>
<br>
<h1><img src="img/LOGO.png" alt="LOGO" width="80" height="50">溫室環境監測</h1>
<h3>溫室環境即時監測</h3>
<form name="" method="" action="">
<input type="button" class="btn btn-info" size="12" value="環境異常警告" onclick="location.href='EAW.php'">
<input type="button" class="btn btn-info" size="12" value="歷史紀錄" onclick="location.href='history_left.php'">
<input type="button" class="btn btn-info" size="12" value="回首頁" onclick="location.href='index.php'">
<hr>
<div style="background-image: url(img/w60.gif);background: rgba(100%,100%,100%,0.6);" class="col-xs-12"><!--div放白色背景透明度60%開始-->
<div class="row col-xs-12" style="font-size:24px;">
  <div class="col-md-4">
    <table border="0px" align="center" style="text-align:center;">
    <form name="Lfrom">
      <tr>
      <td colspan="4">左邊</td>
      </tr>
      <tr>
        <td></td>
        <td>電池電壓/ </td>
        <td>環境溫度/ </td>
        <td>環境濕度 </td>
      </tr>
      <tr>
        <td>上</td>
        <td><!--左上方電池電壓-->

<div class="part">
  <canvas id="waterbubble1"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble1').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFE27C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecLeft["battery_1"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--左上方環境溫度-->

<div class="part">
  <canvas id="waterbubble2"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble2').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFBB7C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecLeft["temp_1"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--左上方環境濕度-->

<div class="part">
  <canvas id="waterbubble3"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble3').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#73DAE9',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecLeft["humi_1"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

      </tr>
      <tr>
        <td colspan="4">　</td>
      </tr>
      <tr>
        <td>下</td>
        <td><!--左下方電池電壓-->

<div class="part">
  <canvas id="waterbubble4"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble4').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFE27C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecLeft["battery_2"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--左下方環境溫度-->

<div class="part">
  <canvas id="waterbubble5"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble5').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFBB7C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecLeft["temp_2"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--左下方環境濕度-->

<div class="part">
  <canvas id="waterbubble6"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble6').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#73DAE9',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecLeft["humi_2"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

      </tr>
    </form>
  </table>

  </div>
  <div class="col-md-4">
    <table border="0px" align="center" style="text-align:center;">
    <form name="Cform">
      <tr><td colspan="4">中間</td></tr>
      <tr>
        <td></td>
        <td>電池電壓/ </td>
        <td>環境溫度/ </td>
        <td>環境濕度</td>
      </tr>
      <tr>
        <td>上</td>
        <td><!--中間上方電池電壓-->

<div class="part">
  <canvas id="waterbubble7"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble7').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFE27C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecCenter["battery_1"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--中間上方環境溫度-->

<div class="part">
  <canvas id="waterbubble8"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble8').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFBB7C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecCenter["temp_1"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--中間上方環境濕度-->

<div class="part">
  <canvas id="waterbubble9"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble9').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#73DAE9',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecCenter["humi_1"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

      </tr>
      <tr>
        <td colspan="4">　</td>
      </tr>
      <tr>
        <td>中</td>
        <td><!--中間中方電池電壓-->

<div class="part">
  <canvas id="waterbubble10"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble10').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFE27C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecCenter["battery_2"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--中間中方環境溫度-->

<div class="part">
  <canvas id="waterbubble11"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble11').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFBB7C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecCenter["temp_2"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--中間中方環境濕度-->

<div class="part">
  <canvas id="waterbubble12"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble12').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFE27C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecCenter["humi_2"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

      </tr>
      <tr>
        <td colspan="4">　</td>
      </tr>
      <tr>
        <td>下</td>
        <td><!--中間下方電池電壓-->

<div class="part">
  <canvas id="waterbubble13"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble13').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFE27C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecCenter["battery_3"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--中間下方環境溫度-->

<div class="part">
  <canvas id="waterbubble14"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble14').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFBB7C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecCenter["temp_3"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--中間下方環境濕度-->

<div class="part">
  <canvas id="waterbubble15"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble15').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#73DAE9',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecCenter["humi_3"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

      </tr>
      <tr>
        <td colspan="4">　</td>
      </tr>
      <tr>
        <td>光照度</td>
        <td colspan="3"><input type="text" name="" id="" size="2px" readonly="readonly" style="border:0px;" value="<?php echo $row_RecCenter["light_1"];?>"><!--中間光照度--></td>
      </tr>
    </form>
  </table>
  <p>更新時間：<br>
  <?php echo $row_RecCenter["date"];?>
  </p>
  </div>
  <div class="col-md-4">
    <table border="0px" align="center" style="text-align:center;">
    <form name="Rfrom">
      <tr><td colspan="4">右邊</td></tr>
      <tr>
        <td></td>
        <td>電池電壓/ </td>
        <td>環境溫度/ </td>
        <td>環境濕度/ </td>
      </tr>
      <tr>
        <td>上</td>
        <td><!--右邊上方電池電壓-->

<div class="part">
  <canvas id="waterbubble16"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble16').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFE27C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecRight["battery_1"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--右邊上方環境溫度-->

<div class="part">
  <canvas id="waterbubble17"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble17').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFBB7C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecRight["temp_1"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--右邊上方環境濕度-->

<div class="part">
  <canvas id="waterbubble18"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble18').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#73DAE9',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecRight["humi_1"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

      </tr>
      <tr>
        <td colspan="4">　</td>
      </tr>
      <tr>
        <td>下</td>
        <td><!--右邊下方電池電壓-->

<div class="part">
  <canvas id="waterbubble19"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble19').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFE27C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecRight["battery_2"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--右邊下方環境溫度-->

<div class="part">
  <canvas id="waterbubble20"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble20').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#FFBB7C',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecRight["temp_2"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

        <td><!--右邊下方環境濕度-->

<div class="part">
  <canvas id="waterbubble21"></canvas>
</div>
    <!-- 下方為水球插件 -->
  <script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
  <script src="js/waterbubble.js" type="text/javascript"></script>
  <script type="text/javascript">
    $('#waterbubble21').waterbubble({
        radius: 50,
        lineWidth: 5,
        data: 0.5,
        waterColor: '#73DAE9',
        textColor: 'rgba(06, 85, 128, 0.8)',
        txt: '<?php echo $row_RecRight["humi_2"];?>',
        font: 'bold 30px "Microsoft YaHei"',
        wave: true,
        animation: true
    });
  </script>
  <!-- 上方為水球插件 -->
</div></td>

      </tr>
    </form>
  </table>
  </div>
</div>

</div><!--div放白色背景透明度60%結束-->
</body>
</html>