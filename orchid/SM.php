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
//刪除花花
if(isset($_GET["action"])&&($_GET["action"]=="delete")){
  $query_delMember = "DELETE FROM `equipment` WHERE `e_id`=".$_GET["id"];
  mysql_query($query_delMember);
  //重新導向回到主畫面
  header("Location: SM.php");
}
//選會員
$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
$RecMember = mysql_query($query_RecMember);
$row_RecMember=mysql_fetch_assoc($RecMember);

//選取會員的設備資料
$query_RecFlower = "SELECT * FROM `equipment` WHERE `e_user`='".$_SESSION["loginMember"]."'";
$RecFlower = mysql_query($query_RecFlower);
$row_RecFlower=mysql_fetch_assoc($RecFlower);
//選取所有一般會員資料
//預設每頁筆數
$pageRow_records = 10;
//預設頁數
$num_pages = 1;
//若已經有翻頁，將頁數更新
if (isset($_GET['page'])) {
  $num_pages = $_GET['page'];
}
//本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數 ORDER BY `f_jointime` DESC
$startRow_records = ($num_pages -1) * $pageRow_records;
//未加限制顯示筆數的SQL敘述句
$query_RecFlower = "SELECT * FROM `equipment` WHERE `e_pattern`<>'耗材' AND `e_user`='".$_SESSION["loginMember"]."' ";
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
  <title>蘭花管理系統</title>

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
</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; background-attachment: fixed; font-family: 微軟正黑體;margin:30px">

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
        <li class="active"><a href="SM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="prediction.php">生長預測</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
      </ul>
    </div>
  </div>
</nav>

<!--<h1>設備管理</h1>-->
<h2 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="80" height="50">耗材管理</h2>
<form name="fromCM" method="" action="">
<hr>

<!--旁邊菜單nav_burger-->
<div class="col-xs-2 col-md-2">
 <!--<nav class="burger">
      <a href="#" class="burger__button" id="burger-button">
        <span class="burger__button__icon"></span>
      </a>
      <ul class="burger__menu">
        <li><a href="member_center.php">首頁</a></li>
        <li><a href="GMM.php">溫室管理</a></li>
        <li><a href="DMM.php">設備管理</a></li>
        <li><a href="CM.php">作物管理</a></li>
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li><a href="Diary.php">日誌</a></li>
      </ul>
    </nav>-->
</div>

<div style="background: rgba(100%,100%,100%,0.6);" class=" col-xs-8 col-md-8"><!--div放白色背景透明度60%開始-->
<table width="90%" border="0px" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td class="tdbline"><table width="100%" border="0px" cellspacing="0" cellpadding="10">
      <tr valign="top">
        <td class="tdrline"><p class="title"><?php echo $row_RecMember["m_name"];?> 您的資料列表 </p>
        <div class="col-md-4"></div>
        <div class="col-md-1"></div>
        <div><ul class="nav nav-tabs">
          <li role="presentation" class="active"><a href="SM.php">資材</a></li>
          <li role="presentation"><a href="SM1.php">耗材</a></li>
        </ul></div>
          <table width="100%"  border="1px" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0" >
             <tr>
              <th bgcolor="#CCCCCC" style="text-align:center;"><p>設備名稱</p></th>
              <th bgcolor="#CCCCCC" style="text-align:center;"><p>數量</p></th>
              <th bgcolor="#CCCCCC" style="text-align:center;"><p>使用者</p></th>
              <th bgcolor="#CCCCCC" style="text-align:center;"><p>型態</p></th>
              <th bgcolor="#CCCCCC" style="text-align:center;"><p>時間</p></th>
              <th bgcolor="#CCCCCC" style="text-align:center;">&nbsp;</th>
            </tr>
      <?php while($row_RecFlower=mysql_fetch_assoc($RecFlower)){ ?>
            <tr>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["e_name"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["e_num"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["e_user"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["e_pattern"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["e_time"];?></p></td>
              <td width="5%" align="center" bgcolor="#FFFFFF"><p><a href="SM_update.php?id=<?php echo $row_RecFlower["e_id"];?>">修改</a><br>
                <a href="?action=delete&id=<?php echo $row_RecFlower["e_id"];?>" onClick="return deletesure();">刪除</a></p></td>
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
                <td rowspan="2"><a href="SM_join.php">新增</a></td>
            </tr>

          </table>          <p>&nbsp;</p>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><p>
    <!--<input type="button" class="btn btn-info" size="12" value="感測設備控管" onclick="location.href='SDC.php'">
    <input type="button" class="btn btn-info" size="12" value="回首頁" onclick="location.href='index.php'"></p>-->
    © 2016 農業物聯生產管理系統 ©</td>
  </tr>
</table>
</div><!--div放白色背景透明度60%結束-->

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
</html>