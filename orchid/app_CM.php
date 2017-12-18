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
//刪除花花
if(isset($_GET["action"])&&($_GET["action"]=="delete")){
  $query_delMember = "DELETE FROM `flower` WHERE `f_id`=".$_GET["id"];
  mysql_query($query_delMember);
  $query_delHis = "DELETE FROM `history` WHERE `h_on`=".$_GET["id"];
  mysql_query($query_delHis);
  //重新導向回到主畫面
  header("Location: CM.php");
}
//選會員
$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
$RecMember = mysql_query($query_RecMember);
$row_RecMember=mysql_fetch_assoc($RecMember);

//選取會員的花資料
$query_RecFlower = "SELECT * FROM `flower` WHERE `f_username`='".$_SESSION["loginMember"]."'";
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
//本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
$startRow_records = ($num_pages -1) * $pageRow_records;
//未加限制顯示筆數的SQL敘述句
$query_RecFlower = "SELECT * FROM `flower` WHERE `f_username`='".$_SESSION["loginMember"]."' ";
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
    function SetCwinHeight()
{
var iframeid=document.getElementById("new"); //iframe id
  if (document.getElementById)
  {
   if (iframeid && !window.opera)
   {
    if (iframeid.contentDocument && iframeid.contentDocument.body.offsetHeight)
     {
       iframeid.height = iframeid.contentDocument.body.offsetHeight;
     }else if(iframeid.Document && iframeid.Document.body.scrollHeight)
     {
       iframeid.height = iframeid.Document.body.scrollHeight;
      }
    }
   }
}
function btnDivShow_onclick() {
      div1.style.display='';
      }
function btnDivH_onclick() {
      div1.style.display='none';
      }
</script>

</head>
<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header"> 
     <a class="navbar-brand" href="member_center.php" style="font-size: 24pt;">基於物聯網與KNN技術之腎藥蘭園監測及智慧生產管理系統</a>
    </div>
  </div>
</nav>

<h2 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="80" height="50">作物管理</h2>
<div class="row col-xs-12" style="display:none" id="div1">
  <iframe name="new" style="width: 85%;" marginwidth="0" marginheight="0" onload="Javascript:SetCwinHeight()"  scrolling="No" frameborder="0" id="new"></iframe>
</div>
<form name="fromCM" method="" action="">
<hr>



<div style="background: rgba(100%,100%,100%,0.6);" class="row col-xs-12 col-md-12"><!--div放白色背景透明度60%開始-->
<!--以下顯示作物列表-->
<table width="70%" border="0px" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td class="tdbline"><table width="100%" border="0px" cellspacing="0" cellpadding="10">
      <tr valign="top">
        <td class="tdrline"><p class="title"><?php echo $row_RecMember["m_name"];?> 您的作物列表 </p>
          <table width="100%"  border="1px" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0" >
            <tr >
              <th width="10%" bgcolor="#CCCCCC" style="text-align:center;"><p>品種</p></th>
              
              <th width="10%" bgcolor="#CCCCCC" style="text-align:center;"><p>作物位置</p></th>
              <th width="5%" bgcolor="#CCCCCC">&nbsp;</th>
            </tr>
      <?php while($row_RecFlower=mysql_fetch_assoc($RecFlower)){ ?>
            <tr>
              <td width="10%" align="center" bgcolor="#FFFFFF">
                <p><a href="CPDR_join.php?id=<?php echo $row_RecFlower["f_id"];?>" target="new" onclick="return btnDivShow_onclick()"><?php echo $row_RecFlower["f_biology"];?></a></p>
              </td>
              
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["f_location"];?></p></td>
              <td width="5%" align="center" bgcolor="#FFFFFF"><p>
              <a href="CM_update.php?id=<?php echo $row_RecFlower["f_id"];?>">修改</a><br>
              <a href="?action=delete&id=<?php echo $row_RecFlower["f_id"];?>" onClick="return deletesure();">刪除</a></p></td>
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
                <td rowspan="2"><a href="CM_join.php">新增</a></td>
            </tr>

          </table>          <p>&nbsp;</p>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">
    <div>
    <input type="button" class="btn btn-info" size="12" value="回首頁" onclick="location.href='index.php'">
    </div>
    © 2016 腎藥蘭花管理系統 ©</td>
  </tr>
</table>
</form>
</div><!--div放白色背景透明度60%結束-->



</body>

</script>
</html>