<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
  header("Location: index.php");
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
  unset($_SESSION["loginMember"]);
  unset($_SESSION["memberLevel"]);
  header("Location: index.php");
}
//重新導向頁面
$redirectUrl="member_center.php";
//執行更新動作
if(isset($_POST["action"])&&($_POST["action"]=="update")){
  $query_update = "UPDATE `memberdata` SET ";
  //若有修改密碼，則更新密碼。
  if(($_POST["m_passwd"]!="")&&($_POST["m_passwd"]==$_POST["m_passwdrecheck"])){
    $query_update .= "`m_passwd`='".md5($_POST["m_passwd"])."',";
  }
  $query_update .= "`m_name`='".$_POST["m_name"]."',";
  $query_update .= "`m_sex`='".$_POST["m_sex"]."',";
  $query_update .= "`m_birthday`='".$_POST["m_birthday"]."',";
  $query_update .= "`m_email`='".$_POST["m_email"]."',";
  $query_update .= "`m_url`='".$_POST["m_url"]."',";
  $query_update .= "`m_phone`='".$_POST["m_phone"]."',";
  $query_update .= "`m_address`='".$_POST["m_address"]."' ";//注意最後是空白 而不是逗號
  $query_update .= "WHERE `m_id`=".$_POST["m_id"];
  mysql_query($query_update);
  //若有修改密碼，則登出回到首頁。
  if(($_POST["m_passwd"]!="")&&($_POST["m_passwd"]==$_POST["m_passwdrecheck"])){
    unset($_SESSION["loginMember"]);
    unset($_SESSION["memberLevel"]);
    $redirectUrl="index.php";
  }
  //重新導向
  header("Location: $redirectUrl");
}
//繫結登入會員資料
$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
$RecMember = mysql_query($query_RecMember);
$row_RecMember=mysql_fetch_assoc($RecMember);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>腎藥蘭花管理系統</title>
<script language="javascript">
function checkForm(){//注意表單名稱
  if(document.formJoin.m_passwd.value!="" || document.formJoin.m_passwdrecheck.value!=""){
    if(!check_passwd(document.formJoin.m_passwd.value,document.formJoin.m_passwdrecheck.value)){
      document.formJoin.m_passwd.focus();
      return false;
    }
  }
  if(document.formJoin.m_name.value==""){
    alert("請填寫姓名!");
    document.formJoin.m_name.focus();
    return false;
  }
  if(document.formJoin.m_birthday.value==""){
    alert("請填寫生日!");
    document.formJoin.m_birthday.focus();
    return false;
  }
  if(document.formJoin.m_email.value==""){
    alert("請填寫電子郵件!");
    document.formJoin.m_email.focus();
    return false;
  }
  if(!checkmail(document.formJoin.m_email)){
    document.formJoin.m_email.focus();
    return false;
  }
  return confirm('確定送出嗎？');
}
function check_passwd(pw1,pw2){
  if(pw1==''){
    alert("密碼不可以空白!");
    return false;
  }
  for(var idx=0;idx<pw1.length;idx++){
    if(pw1.charAt(idx) == ' ' || pw1.charAt(idx) == '\"'){
      alert("密碼不可以含有空白或雙引號 !\n");
      return false;
    }
    if(pw1.length<5 || pw1.length>10){
      alert( "密碼長度只能5到10個字母 !\n" );
      return false;
    }
    if(pw1!= pw2){
      alert("密碼二次輸入不一樣,請重新輸入 !\n");
      return false;
    }
  }
  return true;
}
function checkmail(myEmail) {
  var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(filter.test(myEmail.value)){
    return true;
  }
  alert("電子郵件格式不正確");
  return false;
}
</script>
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
  <meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
  <link href="style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="css/menu.css"><!--菜單CSS+頂端-->
</head>
<body style="text-align:left;font-size:18px;background-image: url(img/46505.png);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">
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
        <li><a href="Diary.php">日誌</a></li>
        <li class="active"><a href="member_update.php">修改資料</a></li>
        <li><a href="?logout=true">登出</a></li>
      </ul>
    </div>
  </div>
</nav>
<br>
<div style="background: rgba(100%,100%,100%,0.6); margin: 0 auto;"><!--div放白色背景透明度60%開始-->
<table width="780" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td><img src="img/LOGO.png" alt="LOGO" width="80" height="50"><h2>會員系統</h2></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="10" style="font-size: 20px;">
      <tr valign="top">
        <td><form action="" method="POST" name="formJoin" id="formJoin" onSubmit="return checkForm();">
          <p style="font-size: 20px;font-weight:bold;">修改資料</p>
          <div class="dataDiv">
            <hr size="1" />
            <p class="heading">帳號資料</p>
            <p><strong>使用帳號</strong>
              ：<?php echo $row_RecMember["m_username"];?></p>
            <p><strong>使用密碼</strong> ：
              <input name="m_passwd" type="password" class="normalinput" id="m_passwd">
              <br>
            </p>
            <p><strong>確認密碼</strong> ：
              <input name="m_passwdrecheck" type="password" class="normalinput" id="m_passwdrecheck">
              <br>
              <span style="font-style: italic;font-size: 16px;">若不修改密碼，請不要填寫。若要修改，請輸入密碼二次。<br>
              若修改密碼，系統會自動登出，請用新密碼登入。</span></p>
            <hr size="1" />
            <p >個人資料</p>
            <p><strong>真實姓名</strong>：
                <input name="m_name" type="text" class="normalinput" id="m_name" value="<?php echo $row_RecMember["m_name"];?>">
                <font color="#FF0000">*</font> </p>
            <p><strong>性　　別
              </strong>：
              <input name="m_sex" type="radio" value="女" <?php if($row_RecMember["m_sex"]=="女") echo "checked";?>>
              女
  <input name="m_sex" type="radio" value="男" <?php if($row_RecMember["m_sex"]=="男") echo "checked";?>>
              男 <font color="#FF0000">*</font></p>
            <p><strong>生　　日</strong>：
                <input name="m_birthday" type="date" class="normalinput" id="m_birthday" value="<?php echo $row_RecMember["m_birthday"];?>">
                <font color="#FF0000">*</font> <br>
                <span style="font-style: italic;font-size: 16px;">為西元格式(YYYY-MM-DD)。 </span></p>
            <p><strong>電子郵件</strong>：
                <input name="m_email" type="text" class="normalinput" id="m_email" value="<?php echo $row_RecMember["m_email"];?>">
                <font color="#FF0000">*</font> </p>
            <p style="font-style: italic;font-size: 16px;">請確定此電子郵件為可使用狀態，以方便未來系統使用，如補寄會員密碼信。</p>
            <p><strong>個人網頁</strong>：
                <input name="m_url" type="text" class="normalinput" id="m_url" value="<?php echo $row_RecMember["m_url"];?>">
                <br>
                <span style="font-style: italic;font-size: 16px;">請以「http://」 為開頭。</span> </p>
            <p><strong>電　　話</strong>：
                <input name="m_phone" type="text" class="normalinput" id="m_phone" value="<?php echo $row_RecMember["m_phone"];?>">
            </p>
            <p><strong>住　　址</strong>：
                <input name="m_address" type="text" class="normalinput" id="m_address" value="<?php echo $row_RecMember["m_address"];?>" size="40">
            </p>
            <p> <font color="#FF0000">*</font> 表示為必填的欄位</p>
          </div>
          <hr size="1" />
          <p align="center">
            <input name="m_id" type="hidden" id="m_id" value="<?php echo $row_RecMember["m_id"];?>">
            <input name="action" type="hidden" id="action" value="update">
            <input type="submit" class="btn btn-info" name="Submit2" value="修改資料" style="font-size: 18px;">
            <input type="reset" class="btn btn-info" name="Submit3" value="重設資料" style="font-size: 18px;">
            <input type="button" class="btn btn-info" name="Submit" value="回上一頁" onClick="window.history.back();" style="font-size: 18px;">
          </p>
        </form></td>
        <td width="300">
        <div class="col-xs-12"></div><div class="col-xs-12"></div>
<div class="col-xs-12">
          <p class="heading"><strong>會員系統</strong></p>
            <p><strong><?php echo $row_RecMember["m_name"];?></strong> 您好。</p>
            <p>您總共登入了 <?php echo $row_RecMember["m_login"];?> 次。<br>
            本次登入的時間為：<br>
            <?php echo $row_RecMember["m_logintime"];?></p>
</div>
        <div class="col-xs-12"></div><div class="col-xs-12"></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" background="images/album_r2_c1.jpg" class="trademark" style="font-size: 20px;">© 2016 腎藥蘭花管理系統 ©</td>
  </tr>
</table>
</div><!--div放白色透明度60%結束-->
</body>
</html>