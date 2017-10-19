<!DOCTYPE html>
<html>
<head>
	<meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
	<title>設備管理</title>
	<!-- 最新編譯和最佳化的 CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<!-- 選擇性佈景主題 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
<!-- 最新編譯和最佳化的 JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS+頂端-->
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; font-family: 微軟正黑體;margin:30px">
<h1><img src="img/LOGO.png" alt="LOGO" width="80" height="50">設備管理</h1>
<form name="會員資料" method="" action="">
<hr>
<div style="background-image: url(img/w60.gif);background: rgba(100%,100%,100%,0.6);" class="col-xs-12"><!--div放白色背景透明度60%開始
    <nav class="burger">
      <a href="#" class="burger__button" id="burger-button">
        <span class="burger__button__icon"></span>
      </a>
      <ul class="burger__menu">
        <li><a href="GMM.php">溫室管理</a></li>
        <li><a href="SM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="GEMM.php">溫室環境監控</a></li>
      </ul>
    </nav>-->
<div class="col-xs-12">
<img src="img/CM.gif" alt="作物管理" width="160" height="90" onclick="location.href='CM.php'"><p>
<span>便利迅速的了解農作物的生長資料</span>
</div>
<div class="col-xs-12">
<img src="img/SM.gif" alt="耗材管理" width="160" height="90" onclick="location.href='SM.php'"><p>
<span>更便利的管理器材設備，避免了紙張的消耗</span>
</div>
<div class="col-xs-12">
<img src="img/SDC.gif" alt="感測設備控管" width="160" height="90" onclick="location.href='SDC.php'"><p>
<span>感測器之電子化管理</span>
</div>

<div class="col-xs-12">
  <input type="button" class="btn btn-info" size="12" value="回首頁" onclick="location.href='index.php'">
</div>
© 2016 腎藥蘭花管理系統 ©

</div><!--div放白色背景透明度60%結束-->
</body>

<script type="text/javascript">/*這為左邊菜單的JS，來源http://codepen.io/vkbansal/pen/QbapGz*/
  'use strict';
var burger = document.getElementById('burger-button');
burger.addEventListener('click', function (e) {
    e.preventDefault();
    document.body.classList.toggle('open');
    burger.classList.toggle('open');
});
</script><!--放body下面才會跑-->

</html>