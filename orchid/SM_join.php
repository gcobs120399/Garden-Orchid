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
?>
<html>
<head>
  <meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title>蘭花管理系統</title>
  <!-- 最新編譯和最佳化的 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <!-- 選擇性佈景主題 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <!-- 最新編譯和最佳化的 JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</head>

<body style="text-align:center;font-size:18px;background-image: url(img/46505.png);background-size: cover; font-family: 微軟正黑體;margin:30px">
<div>
  <h2><img src="img/LOGO.png" alt="LOGO" width="80" height="50">新增設備</h2>
</div>
<hr>
<div style="background-image: url(img/w60.gif);background: rgba(100%,100%,100%,0.6);" class="col-xs-12"><!--div放白色背景透明度60%開始-->
  <form action="SM_running.php" method="post" name="formAdd" id="formAdd">
  <table align="center" >
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
      <td>型態</td>
      <td><input type="radio" name="e_pattern" value="耗材"> 耗材<br>
<input type="radio" name="e_pattern" value="資材"> 資材<br></td>
    </tr>
    <tr >
      <td colspan="2">
        <input name="action" type="hidden" value="add">
        <input type="submit" class="btn btn-info" name="button" id="button" value="新增資料">
        <input type="reset" class="btn btn-info" name="button2" id="button2" value="重新填寫">
        <input type="button" class="btn btn-info" size="12" value="回設備管理" onClick="window.history.back();">
      </td>
    </tr>
    <tr></tr>
    <tr>
        <td align="center" colspan="2">© 2016 農業物聯生產管理系統 ©</td>
      </tr>
</table>
</form>
</div><!--放body下面才會跑-->
</body>
</html>