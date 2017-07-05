<!DOCTYPE html>
<html>
<head>
	<meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>環境異常警告</title>
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
<body style="text-align:left;font-size:18px;background-image: url(img/46505.png);background-attachment: fixed; font-family: 微軟正黑體;margin:30px">
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
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
      </ul>
    </div>
  </div>
</nav>
<br>
<h1><img src="img/LOGO.png" alt="LOGO" width="80" height="50">溫室環境監測</h1>
<h3>環境異常警告</h3>
<form name="" method="" action="">
<input type="button" size="12" value="溫室環境即時監測" onclick="location.href='溫室環境即時監測.php'">
<input type="button" size="12" value="歷史紀錄" onclick="location.href='History.php'">
<input type="button" size="12" value="回首頁" onclick="location.href='index.php'">
<hr>
	帳號:
	<input type="text" name="會員帳號" maxlength="" size="12">
	<br>
	密碼:
	<input type="text" name="會員密碼" maxlength="" size="12">
	<br>
	<input type="submit" name="submit" size="12" value="修改">
	<input type="reset" name="claer" size="12" value="清除">
	
</body>
</html>