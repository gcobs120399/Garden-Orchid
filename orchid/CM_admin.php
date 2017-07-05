<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
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
  //重新導向回到主畫面
  header("Location: CM.php");
}
//選會員
$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
$RecMember = mysql_query($query_RecMember);
$row_RecMember=mysql_fetch_assoc($RecMember);

//選取會員的設備資料
$query_RecFlower = "SELECT * FROM `flower`";
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
$query_RecFlower = "SELECT * FROM `flower` ORDER BY `f_username` DESC ";
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
  <title>作物管理</title>
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
<br>
<img src="img/CM.gif" alt="作物管理" width="164" height="80">
<form name="fromCM" method="" action="">
<div class="row col-xs-12">
  <input type="button" class="btn btn-info" size="12" value="回首頁" onclick="location.href='index.php'">
</div>
<hr>
<table width="90%" border="1px" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td class="tdbline"><table width="100%" border="1px" cellspacing="0" cellpadding="10">
      <tr valign="top">
        <td class="tdrline"><p class="title"><?php echo $row_RecMember["m_username"];?> 您的資料列表 </p>
          <table width="100%"  border="1px" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0" >
            <tr >
              <th width="5%" bgcolor="#CCCCCC">&nbsp;</th>
              <th width="10%" bgcolor="#CCCCCC" style="text-align:center;"><p>品種</p></th>
              <th width="10%" bgcolor="#CCCCCC" style="text-align:center;"><p>帳號</p></th>
              <th width="10%" bgcolor="#CCCCCC" style="text-align:center;"><p>莖高</p></th>
              <th width="10%" bgcolor="#CCCCCC" style="text-align:center;"><p>葉片大小</p></th>
              <th width="10%" bgcolor="#CCCCCC" style="text-align:center;"><p>葉片數量</p></th>
              <th width="10%" bgcolor="#CCCCCC" style="text-align:center;"><p>花梗長度</p></th>
              <th width="10%" bgcolor="#CCCCCC" style="text-align:center;"><p>花梗數量</p></th>
              <th width="10%" bgcolor="#CCCCCC" style="text-align:center;"><p>分岔數</p></th>
              <th width="10%" bgcolor="#CCCCCC" style="text-align:center;"><p>加入時間</p></th>
            </tr>
      <?php while($row_RecFlower=mysql_fetch_assoc($RecFlower)){ ?>
            <tr>
              <td width="5%" align="center" bgcolor="#FFFFFF"><p><a href="CM_update.php?id=<?php echo $row_RecFlower["f_id"];?>">修改</a><br>
                <a href="?action=delete&id=<?php echo $row_RecFlower["f_id"];?>" onClick="return deletesure();">刪除</a></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["f_biology"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["f_username"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["f_stems"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["f_leafsize"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["f_leafNum"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["f_pedlength"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["f_pedNum"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["f_bifNum"];?></p></td>
              <td width="10%" align="center" bgcolor="#FFFFFF"><p><?php echo $row_RecFlower["f_jointime"];?></p></td>
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
                <td rowspan="2"><a href="CM_join.php">新增</a></td>
            </tr>

          </table>          <p>&nbsp;</p>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>

    <td align="center">© 2016 農業物聯生產管理系統 ©</td>
  </tr>
</table>

</body>
</html>