<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
  header("Location: index.php");
}
$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
$RecMember = mysql_query($query_RecMember);
$row_RecMember=mysql_fetch_assoc($RecMember);
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
  unset($_SESSION["loginMember"]);
  unset($_SESSION["memberLevel"]);
  header("Location: index.php");}
?>
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
  <link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS+頂端-->
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; background-attachment: fixed; font-family: 微軟正黑體;margin:30px">

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
        <li class="active"><a href="SM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="prediction.php?select=10">生長預測</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
        <li><a href="member_update.php">修改資料</a></li>
        <li><a href="?logout=true">登出</a></li>
      </ul>
    </div>
  </div>
</nav>
</head>

<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; font-family: 微軟正黑體;margin:30px">
<div>
  <h2><img src="img/LOGO.png" alt="LOGO" width="80" height="50">新增設備</h2>
</div>
<hr>
<div class="col-xs-12"><!--div放白色背景透明度60%開始-->
  <form action="SM_running.php" method="post" name="formAdd" id="formAdd">
  <table align="center" style="font-size: 20px;">
    <tr>
      <td>使用者</td>
      <td><input type="text" name="e_user" maxlength="" size="14" readonly="readonly" value="<?php echo $row_RecMember["m_username"];?>"></td>
    </tr>
    <tr>
      <td>名稱</td>
      <td><input type="text" name="e_name" maxlength="" size="14"></td>
    </tr>
    <tr>
      <td>數量</td>
      <td><input type="text" name="e_num" maxlength="" size="14"></td>
    </tr>
    <tr>
      <td>單價</td>
      <td><input type="text" name="e_money" maxlength="" size="14"></td>
    </tr>
    <tr>
      <td>型態</td>
      <td><input type="radio" name="e_pattern" value="耗材"> 耗材<br>
<input type="radio" name="e_pattern" value="資材"> 資材<br></td>
    </tr>
    <tr >
      <td colspan="2">
        <input name="action" type="hidden" value="add">
        <input type="submit" class="btn btn-info" name="button" id="button" value="新增資料" style="font-size: 18px;">
        <input type="reset" class="btn btn-info" name="button2" id="button2" value="重新填寫" style="font-size: 18px;">
        <input type="button" class="btn btn-info" size="12" value="回上一頁" onClick="window.history.back();" style="font-size: 18px;">
      </td>
    </tr>
    <tr></tr>
    <tr>
        <td align="center" colspan="2">© 2016 腎藥蘭花管理系統 ©</td>
      </tr>
</table>
</form>
</div><!--放body下面才會跑-->
</body>
</html>