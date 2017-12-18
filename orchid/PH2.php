<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
  //若帳號等級為 member 則導向會員中心
  if($_SESSION["memberLevel"]=="admin"){
    header("Location: CM_admin.php");
  }
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
  unset($_SESSION["loginMember"]);
  unset($_SESSION["memberLevel"]);
  header("Location: index.php");
}
$query_RecFlower = "SELECT * FROM `history` WHERE `h_on`='".$_GET["id"]."' ";
$RecFlower = mysql_query($query_RecFlower);
$row_RecFlower=mysql_fetch_assoc($RecFlower);
//預設每頁筆數
$pageRow_records = 15;
//預設頁數
$num_pages = 1;
//若已經有翻頁，將頁數更新
if (isset($_GET['page'])) {
  $num_pages = $_GET['page'];
}
//本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
$startRow_records = ($num_pages -1) * $pageRow_records;
//未加限制顯示筆數的SQL敘述句
$query_RecFlower = "SELECT * FROM `history` WHERE `h_on`='".$_GET["id"]."' ";
//加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
$query_limit_RecFlower = $query_RecFlower." LIMIT ".$startRow_records.", ".$pageRow_records;
//以加上限制顯示筆數的SQL敘述句查詢資料到 $resultMember 中
$RecFlower = mysql_query($query_limit_RecFlower);
//以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_resultMember 中
$all_RecFlower = mysql_query($query_RecFlower);
//計算總筆數
$total_records = mysql_num_rows($all_RecFlower);
//計算總頁數=(總筆數/每頁筆數)後無條件進位。
$total_pages = ceil($total_records/$pageRow_records);
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
<link href="./css/navbar-fixed-top.css" rel="stylesheet"> 
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
      if (confirm('\n您確定要刪除此筆資料嗎?\n刪除後無法恢復!\n該筆歷史紀錄也會跟著刪除!\n')) return true;
      return false;
    }
</script>
<link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS+頂端-->
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">
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
<h2 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="80" height="50">歷史紀錄列表</h2>
<div class="row col-xs-12" style="display:none" id="div1">
  <iframe name="new" style="width: 30%;" marginwidth="0" marginheight="0" onload="Javascript:SetCwinHeight()"  scrolling="No" frameborder="0" id="new"></iframe><br>
</div>
<form name="fromCM" method="" action="">
<hr>
<div class="col-xs-1 col-md-1"></div>
<div style="background: rgba(100%,100%,100%,0.6);" class="row col-xs-10 col-md-10">
<!--以下顯示作物列表-->
<table width="90%" border="0px" align="center" cellpadding="4" cellspacing="0" style="font-size: 20px;">
  <tr>
    <td class="tdbline"><table width="100%" border="0px" cellspacing="0" cellpadding="10">
      <tr valign="top">
        <td class="tdrline"><p class="title"><?php echo $row_RecFlower["h_biology"];?> 的列表 </p>
          <table width="100%"  border="1px" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0" >
            <tr >
              <th width="5%" bgcolor="#CCCCCC" style="text-align:center;"><p>日期</p></th>
              <th width="5%" bgcolor="#CCCCCC" style="text-align:center;"><p>花梗長度</p></th>
              <th width="5%" bgcolor="#CCCCCC" style="text-align:center;"><p>葉片數量</p></th>
              <th width="5%" bgcolor="#CCCCCC" style="text-align:center;"><p>分岔數</p></th>
              <th width="5%" bgcolor="#CCCCCC" style="text-align:center;"><p>第一分岔長度</p></th>
              <th width="5%" bgcolor="#CCCCCC" style="text-align:center;"><p>第二分岔長度</p></th>
              <th width="5%" bgcolor="#CCCCCC" style="text-align:center;">成熟度</th>
              <th width="5%" bgcolor="#CCCCCC">&nbsp;</th>
            </tr>
      <?php while($row_RecFlower=mysql_fetch_assoc($RecFlower)){ ?>
            <tr>
              <td width="5%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["h_date"];?></a></p></td>
              <td width="5%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["h_pedlength"];?></p></td>
              <td width="5%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["h_leafNum"];?></p></td>
              <td width="5%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["h_bifNum"];?></p></td>
              <td width="5%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["h_bifNum1"];?></p></td>
              <td width="5%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["h_bifNum2"];?></p></td>
              <td width="5%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["maturity"];?></p></td>
              <td width="5%" align="center" bgcolor="#FFFFFF"><a href="PH2_update.php?id=<?php echo $row_RecFlower["h_id"];?>">修改<p></p></td>
            </tr>
      <?php }?>
          </table>
          <hr size="1" />
          <table width="98%" border="0px" align="center" cellpadding="4" cellspacing="0">
            <tr>
              <td valign="middle"><p>資料筆數：<?php echo $total_records;?></p></td>
              <td align="right"><p>
                  <?php if ($num_pages > 1) { // 若不是第一頁則顯示 ?>
                  <a href="?page=1">第一頁</a> | <a href="?page=<?php echo $num_pages-1;?>">上一頁</a> |
                <?php }?>
                  <?php if ($num_pages < $total_pages) { // 若不是最後一頁則顯示 ?>
                  <a href="?page=<?php echo $num_pages+1;?>">下一頁</a> | <a href="?page=<?php echo $total_pages;?>">最末頁</a>
                  <?php }?>
              </p></td>
            </tr>
          </table>          <p>&nbsp;</p>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">
    <div>
    <input type="button" name="Submit" class="btn btn-info" value="回上一頁" onClick="window.history.back();" style="font-size: 18px;">
    </div>
    © 2016 腎藥蘭花管理系統 ©</td>
  </tr>
</table>
</form>
</div>

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