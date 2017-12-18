<?php
header("Content-Type: text/html; charset=utf-8;image/jpeg;image/gif;image/png");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
  if($_SESSION["memberLevel"]=="member" || $_SESSION["memberLevel"]=="admin"){
  }else{
    header("Location: Diary_view.php");
  }
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
  unset($_SESSION["loginMember"]);
  unset($_SESSION["memberLevel"]);
  header("Location: index.php");
}
//繫結登入會員資料
$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
$RecMember = mysql_query($query_RecMember);
$row_RecMember=mysql_fetch_assoc($RecMember);
//抓資料
$query_RecView = "SELECT * FROM `picture` WHERE `p_id`=".$_GET["id"];
$RecView = mysql_query($query_RecView);
$row_RecView=mysql_fetch_assoc($RecView);
//刪除花花
if(isset($_GET["action"])&&($_GET["action"]=="delete")){
  $query_delMember = "DELETE FROM `picture` WHERE `p_id`=".$_GET["id"];
  mysql_query($query_delMember);
  //重新導向回到主畫面
  header("Location: Diary.php");
}
if(isset($_POST["action"])&&($_POST["action"]=="join")){//留言新增
  if (isset($_POST['s_text'])) {   //isset檢查變數是否設置
    require_once 'MYSQL.php';
    $s_text = $_POST['s_text'];
    $s_on = $_POST['s_on'];
    $s_name = $_POST['s_name'];
    $sql = "INSERT INTO `message`(`s_text`,`s_on`,`s_name`) VALUES ('$s_text','$s_on','$s_name')";
    mysql_query($sql)or die(mysql_error());
    header("Location: Diary1.php?id=$s_on");
  }
  else
  { echo "新增失敗"; }
  }
if(isset($_POST["action1"])&&($_POST["action1"]=="join1")){//回覆新增
  if (isset($_POST['r_text'])) {   //isset檢查變數是否設置
    require_once 'MYSQL.php';
    $r_text = $_POST['r_text'];
    $r_no = $_POST['r_no'];
    $r_name = $_POST['r_name'];
    $r_dn = $_POST['r_dn'];
    $sql = "INSERT INTO `reply`(`r_text`,`r_no`,`r_name`,`r_dn`) VALUES ('$r_text','$r_no','$r_name','$r_dn')";
    mysql_query($sql)or die(mysql_error());
    header("Location: Diary1.php?id=$r_dn");
  }
  else
  { echo "新增失敗"; }
  }
$count = 1;
//未加限制顯示筆數的SQL敘述句
$query_RecFlower = "SELECT * FROM `message` WHERE `s_on`='".$_GET["id"]."'";
//以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_resultMember 中
$all_RecFlower = mysql_query($query_RecFlower);
//計算總筆數
$total_records = mysql_num_rows($all_RecFlower);
?>
<!DOCTYPE html>
<html>
<head>
  <meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
  <title>腎藥蘭花管理系統</title>
    <script language="javascript">
    function deletesure(){
      if (confirm('\n您確定要刪除此筆日誌嗎?\n刪除後無法恢復!\n')) return true;
      return false;}
    </script>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="./css/bootstrap.min.css" rel="stylesheet">
<script src="./js/ie-emulation-modes-warning.js"></script> 
<link rel="icon" href="./img/title.png">

  <!-- 最新編譯和最佳化的 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
  <!-- 選擇性佈景主題 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
  <!-- 最新編譯和最佳化的 JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
  <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
  <link rel="stylesheet" type="text/css" href="css/htmleaf-demo.css">
  <link rel="stylesheet" type="text/css" href="css/calendar.css">
  <link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" type="text/javascript"></script>
<b:skin><!--回覆區-->
<style type='text/css'>
  .code {
 color: #333;
 position: relative;
 overflow: hidden;
        text-align: center;
}
.code:hover {cursor: pointer;}
.code c2 {
    font-weight:bold;
    color: #fff;/*按鈕字體顏色*/
    font: 24px Century Gothic,微軟正黑體;
    padding: 1px 3px;
    border: 1px solid #F7CCE5;/*按鈕方格外框*/
    border-radius:5px;/*按鈕方格外框角度弧度*/
    background-color: #F09DCB;/*按鈕方格底色*/
}
.code:after {
 content: "點擊兩次關閉";
 position: absolute;
        text-align: center;
 right: 0;
 top: 100%;
 margin-top: 3px;
 color: red;
 font: 10px Century Gothic;
}
.code divr{/*內容部分*/
  text-align: left;
  border-radius:3px;
  box-sizing: border-box;
  color: #8e9081;
  font:13px Microsoft JhengHei,Century Gothic;
  line-height: 18px;/*內容部分行高*/
  outline: 0px;
  padding: 10px 12px;
  vertical-align: baseline;
  word-wrap: break-word;
  word-break: normal;
}
</style>
</b:skin>
</head>
<script>
$(function() {
 $(".cs").hide();
 $(".code > c2").click(function() {
  $(this)
      .parent()
      .find(".cs")
      .slideToggle();
 });
});
</script>
<body style="text-align:left;font-size:18px;background-image: url(img/46505.png);background-attachment: fixed; font-family: 微軟正黑體;margin:30px">
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
        <li><a href="PH.php?select=1">生產履歷</a></li>
        <li><a href="prediction.php?select=10">生長預測</a></li>
        <li><a href="http://140.127.1.99/orchid_garden/index.html" target=" _new">溫室環境監控</a></li>
        <li class="active"><a href="Diary.php">日誌</a></li>
        <li><a href="member_update.php">修改資料</a></li>
        <li><a href="?logout=true">登出</a></li>
      </ul>
    </div>
  </div>
</nav>
<br><br><br>
<h1 style="text-align:center;"><img src="img/LOGO.png" alt="LOGO" width="80" height="50">日誌</h1>
<div style="background-image: url(img/w60.gif);background: rgba(100%,100%,100%,0.6);" class="col-xs-12 "><!--div放白色背景透明度60%開始-->
</div>
<div class="row col-xs-12 ">
  <div class="col-md-2"></div>
  <div class="col-md-8">
<?php
include("MYSQL.php"); //資料庫連線套用
$data = "SELECT * FROM picture WHERE `p_id`='".$_GET["id"]."'"; //查詢FROM 資料表 where 判斷式(府和判斷式的才搜尋
$resultub = mysql_query($data);
while($rowub = mysql_fetch_array($resultub)){ //顯示資料
?>
      <div class="thumbnail">
      <?php if($rowub['filepic']!=""){?>
        <img alt="..." width="400" height="400" src="<?php echo $rowub['filepic']; ?>">
      <?php } ?>
      <div class="caption">
        <a style="color:black;font-weight:border;" href="Diary1.php?id=<?php echo $rowub["p_id"];?>"><h3 style="text-align:center;"><?php echo $rowub['p_title']; ?></h3></a>
        <p style="font-size: 20px;">
        <?php  echo nl2br($rowub['p_text']); ?>
        </p>
        <span style="font-size:16px;"><?php echo $rowub['p_time']; ?></span>
    <div class="fb-like" data-send="true" data-width="450" data-show-faces="true"></div>
      </div>
      <p style="text-align:right;"><a class="btn btn-default" role="button" href="Diary_update.php?id=<?php echo $rowub["p_id"];?>" style="font-size: 16px;">編輯</a>
      <a class="btn btn-default" role="button" href="?action=delete&id=<?php echo $rowub["p_id"];?>" onClick="return deletesure();" style="font-size: 16px;">刪除</a>
      </p>
    </div>
<?php }?>
      <div class="thumbnail">
      <p style="font-size: 20px;">留言：</p>
      <form method="POST" name="Dvform" >
        <input type="text" readonly="readonly" style="border-style:none;" name="s_name" id="s_name" value="<?php echo $row_RecMember['m_username']; ?>"><br>
        <textarea rows="2" style="width:85%" wrap="virtual" name="s_text" id="s_text" placeholder="我要留言..."></textarea>
        <input type="hidden" id="s_on" name="s_on" readonly="readonly" value="<?php echo $row_RecView['p_id']; ?>">
        <input name="action" type="hidden" id="action" value="join">
        <input type="submit" class="btn btn-default" name="Submit" value="送出" style="font-size: 16px;"></p>
      </form>
      <hr>
<?php
include("MYSQL.php"); //資料庫連線套用
$data = "SELECT * FROM `message` WHERE `s_on`='".$_GET["id"]."'ORDER BY `s_id` ASC"; //查詢FROM 資料表 where 判斷式(府和判斷式的才搜尋
$resultub = mysql_query($data);
while($rowub = mysql_fetch_array($resultub)){ //顯示資料
?>
      <div>
      <?php if($count <= $total_records){?>
        <span style="font-size:24px;font-weight:border;">#
          <?php echo $count;$count=$count+1; ?>
        </span><!--計算樓層-->
        <span style="font-size:18px;">
        <?php if($rowub['s_name'] == ""){?>
          <?php echo "訪客" ?><!--如果留言沒有寫暱稱，預設訪客-->
          <?php }else{?> <?php echo $rowub['s_name']; ?> <?php }?>
        　於　<?php echo $rowub['s_jointime']; ?>
        </span>
        <p><?php  echo nl2br($rowub['s_text']); ?></p><!--留言內容-->
<?php
include("MYSQL.php"); //資料庫連線套用
$data1 = "SELECT * FROM `reply` ORDER BY `r_id` ASC"; //查詢FROM 資料表 where 判斷式(府和判斷式的才搜尋
$resultub1 = mysql_query($data1);
while($rowub1 = mysql_fetch_array($resultub1)){ //顯示資料
?>
  <div class="col-md-2">　　</div>
  <div ><!--回覆留言區style="border:1px solid;"-->
  <span>
<?php if(($rowub1['r_dn'] == $rowub['s_on'])&& ($rowub1['r_no'] == $rowub['s_id']) ){?>
    <?php echo $rowub1['r_name'];?>：
    <?php echo $rowub1['r_text'];?>
<?php }?>
  </span>
  </div>
<?php }?>
  <div class="code"><!--回覆摺疊區-->
    <c2>回覆</c2>
    <div class="divr">
    <form method="POST" name="reform">
      <textarea rows="1" style="width:80%" wrap="virtual" class="cs" name="r_text" id="r_text" placeholder="我要回覆..."></textarea>
      <input type="hidden" class="cs" name="r_name" id="r_name" value="<?php echo $row_RecMember['m_username'];?>">
      <input type="hidden" class="cs" name="r_no" id="r_no" value="<?php echo $rowub['s_id'];?>">
      <input type="hidden" class="cs" name="r_dn" id="r_dn" value="<?php echo $rowub['s_on'];?>">
      <input type="submit" class="cs" name="Submit2" value="送出">
      <input name="action1" type="hidden" id="action1" value="join1">
    </form>
    </div>
  </div>
      </div>
      <hr>
      <?php }?>
<?php }?>
      </div>
  </div>
  <div class="col-md-2"></div>
</div>
<div class="col-xs-12 col-md-2"></div>
<div class="col-xs-12 col-md-8" style="text-align: center;">© 2016 腎藥蘭花管理系統 ©</div>
<div class="col-xs-12 col-md-2"></div>
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
<script>window.jQuery || document.write('<script src="js/jquery-2.1.1.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/locale/zh-cn.js"></script>
<script src="js/es6.js"></script>

<script>
  'use strict';
  $(function () {
    'use strict';
    $('#date').DatePicker({
        startDate: moment()
    });
  });
</script>
</html>