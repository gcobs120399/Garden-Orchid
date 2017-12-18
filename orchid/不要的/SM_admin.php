<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入

if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
  if($_SESSION["memberLevel"]=="admin"){
    header("Location: SM_admin.php");
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
$query_RecFlower = "SELECT * FROM `equipment`";
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
$query_RecFlower = "SELECT * FROM `equipment` ORDER BY `e_user` DESC ";
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
  <title>耗材管理</title>
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
</head>
<body style="text-align:center;font-size:18px;background-color:#FFEFD5;" >
<h1><img src="img/LOGO.png" alt="LOGO" width="80" height="50">設備管理</h1>
<h3>耗材管理</h3>
<form name="fromCM" method="" action="">
<div class="col-xs-12 col-xs-12">
  <input type="button" class="btn btn-info" size="12" value="感測設備控管" onclick="location.href='SDC.php'">
  <input type="button" class="btn btn-info" size="12" value="回首頁" onclick="location.href='index.php'">
</div>
<hr>
<table width="90%" border="1px" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td class="tdbline"><img src="img/SM.gif" alt="耗材管理" width="164" height="80"></td>
  </tr>
  <tr>
    <td class="tdbline"><table width="100%" border="1px" cellspacing="0" cellpadding="10">
      <tr valign="top">
        <td class="tdrline"><p class="title"><?php echo $row_RecMember["m_username"];?> 您的資料列表 </p>
          <table width="100%"  border="1px" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0" >
             <tr>
              <th bgcolor="#CCCCCC">&nbsp;</th>
              <th bgcolor="#CCCCCC"><p>設備名稱</p></th>
              <th bgcolor="#CCCCCC"><p>數量</p></th>
              <th bgcolor="#CCCCCC"><p>使用者</p></th>
              <th bgcolor="#CCCCCC"><p>型態</p></th>
              <th bgcolor="#CCCCCC"><p>時間</p></th>
            </tr>
      <?php while($row_RecFlower=mysql_fetch_assoc($RecFlower)){ ?>
            <tr>
              <td width="5%" align="center" bgcolor="#FFFFFF"><p><a href="SM_update.php?id=<?php echo $row_RecFlower["e_id"];?>">修改</a><br>
                <a href="?action=delete&id=<?php echo $row_RecFlower["e_id"];?>" onClick="return deletesure();">刪除</a></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["e_name"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["e_num"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["e_user"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["e_pattern"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["e_time"];?></p></td>
            </tr>
      <?php }?>
          </table>
          <hr size="1" />
          <table width="98%" border="1px" align="center" cellpadding="4" cellspacing="0">
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

    <td align="center" background="images/album_r2_c1.jpg" class="trademark">© 2016 農業物聯生產管理系統 ©</td>
  </tr>
</table>

</body>
</html>