<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
if(isset($_POST["action"])&&($_POST["action"]=="join")){
	//找尋帳號是否已經註冊
	$query_RecFindUser = "SELECT `m_username` FROM `memberdata` WHERE `m_username`='".$_POST["m_username"]."'";
	$RecFindUser=mysql_query($query_RecFindUser);
	if (mysql_num_rows($RecFindUser)>0){
		header("Location: member_join.php?errMsg=1&username=".$_POST["m_username"]);
	}else{
	//若沒有執行新增的動作
		$query_insert = "INSERT INTO `memberdata` (`m_name` ,`m_username` ,`m_passwd` ,`m_sex` ,`m_birthday` ,`m_email`,`m_url`,`m_phone`,`m_address`,`m_jointime`) VALUES (";
		$query_insert .= "'".$_POST["m_name"]."',";
		$query_insert .= "'".$_POST["m_username"]."',";
		$query_insert .= "'".md5($_POST["m_passwd"])."',";
		$query_insert .= "'".$_POST["m_sex"]."',";
		$query_insert .= "'".$_POST["m_birthday"]."',";
		$query_insert .= "'".$_POST["m_email"]."',";
		$query_insert .= "'".$_POST["m_url"]."',";
		$query_insert .= "'".$_POST["m_phone"]."',";
		$query_insert .= "'".$_POST["m_address"]."',";
		$query_insert .= "NOW())";
		mysql_query($query_insert);
		header("Location: member_join.php?loginStats=1");
	}
}
?>
<html>
<head>

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
<meta  http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>腎藥蘭花管理系統</title>
<script language="javascript">
function checkForm(){
	if(document.formJoin.m_username.value==""){
		alert("請填寫帳號!");
		document.formJoin.m_username.focus();
		return false;
	}else{
		uid=document.formJoin.m_username.value;
		if(uid.length<5 || uid.length>12){
			alert( "您的帳號長度只能5至12個字元!" );
			document.formJoin.m_username.focus();
			return false;
		}
		if(!(uid.charAt(0)>='a' && uid.charAt(0)<='z')){
			alert("您的帳號第一字元只能為小寫字母!" );
			document.formJoin.m_username.focus();
			return false;
		}
		for(idx=0;idx<uid.length;idx++){
			if(uid.charAt(idx)>='A'&&uid.charAt(idx)<='Z'){
				alert("帳號不可以含有大寫字元!" );
				document.formJoin.m_username.focus();
				return false;
			}
			if(!(( uid.charAt(idx)>='a'&&uid.charAt(idx)<='z')||(uid.charAt(idx)>='0'&& uid.charAt(idx)<='9')||( uid.charAt(idx)=='_'))){
				alert( "您的帳號只能是數字,英文字母及「_」等符號,其他的符號都不能使用!" );
				document.formJoin.m_username.focus();
				return false;
			}
			if(uid.charAt(idx)=='_'&&uid.charAt(idx-1)=='_'){
				alert( "「_」符號不可相連 !\n" );
				document.formJoin.m_username.focus();
				return false;
			}
		}
	}
	if(!check_passwd(document.formJoin.m_passwd.value,document.formJoin.m_passwdrecheck.value)){
		document.formJoin.m_passwd.focus();
		return false;
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
</head>
<body style="text-align:left;font-size:18px;background-image: url(img/46505.png);background-size: cover;background-attachment: fixed; font-family: 微軟正黑體;margin:30px">
<!--巡覽列nav-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> 
        <span class="sr-only">Toggle navigation</span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span> 
        <span class="icon-bar"></span> 
      </button> 
      <a class="navbar-brand" href="">基於物聯網與KNN技術之腎藥蘭園監測及智慧生產管理系統</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li ><a href="index.php">首頁</a></li>
        <li><a href="Diary_c.php">日誌</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php">登入 </a></li>
      <li class="active"><a href="member_join.php">註冊</a></li>
      </ul>
    </div>
  </div>
</nav>
<?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"]=="1")){?>
<script language="javascript">
alert('會員新增成功\n請用申請的帳號密碼登入。');
window.location.href='index.php';
</script>
<?php }?>
<br>
<div style="background: rgba(100%,100%,100%,0.6);" >
<table width="780" border="0" align="center" cellpadding="4" cellspacing="0" style="font-size: 20px;">
  <tr>
    <td class="tdbline"><h3><img src="img/LOGO.png" alt="LOGO" width="80" height="50">會員系統</h3></td>
  </tr>
  <tr>
    <td class="tdbline"><table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr valign="top">
        <td class="tdrline"><form action="" method="POST" name="formJoin" id="formJoin" onSubmit="return checkForm();">
          <p class="title" style="font-size: 20px;">加入會員</p>
		  <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"]=="1")){?>
          <div class="errDiv">帳號 <?php echo $_GET["username"];?> 已經有人使用！</div>
          <?php }?>
          <div style="font-size: 20px;">
            <hr size="1" />
            <p>帳號資料</p>
            <p><strong>使用帳號</strong>：
                <input name="m_username" type="text" id="m_username">
                <font color="#FF0000">*</font><br>
                <span style="font-size: 16px;">請填入5~12個字元以內的小寫英文字母、數字、以及_ 符號。</span></p>
            <p><strong>使用密碼</strong>：
                <input name="m_passwd" type="password" id="m_passwd">
                <font color="#FF0000">*</font><br>
                <span style="font-size: 16px;">請填入5~10個字元以內的英文字母、數字、以及各種符號組合，</span></p>
            <p><strong>確認密碼</strong>：
                <input name="m_passwdrecheck" type="password" id="m_passwdrecheck">
                <font color="#FF0000">*</font> <br>
                <span style="font-size: 16px;">再輸入一次密碼</span></p>
            <hr size="1" />
            <p class="heading">個人資料</p>
            <p><strong>真實姓名</strong>：
                <input name="m_name" type="text" id="m_name">
                <font color="#FF0000">*</font> </p>
            <p><strong>性　　別
              </strong>：
              <input name="m_sex" type="radio" value="女" checked>
              女
  <input name="m_sex" type="radio" value="男">
              男 <font color="#FF0000">*</font></p>
            <p><strong>生　　日</strong>：
                <input name="m_birthday" type="date" id="m_birthday">
                <font color="#FF0000">*</font> <br>
                <span class="smalltext" style="font-size: 16px;">為西元格式(YYYY-MM-DD)。</span></p>
            <p><strong>電子郵件</strong>：
                <input name="m_email" type="text" id="m_email">
                <font color="#FF0000">*</font> </p>
            <p class="smalltext" style="font-size: 16px;">請確定此電子郵件為可使用狀態，以方便未來系統使用，如補寄會員密碼信。</p>
            <p><strong>個人網頁</strong>：
                <input name="m_url" type="text" id="m_url">
                <br>
                <span class="smalltext" style="font-size: 16px;">請以「http://」 為開頭。</span> </p>
            <p><strong>電　　話</strong>：
                <input name="m_phone" type="text" id="m_phone">
            </p>
            <p><strong>住　　址</strong>：
                <input name="m_address" type="text" id="m_address" size="40">
            </p>
            <p> <font color="#FF0000">*</font> 表示為必填的欄位</p>
          </div>
          <hr size="1" />
          <p align="center">
            <input name="action" type="hidden" id="action" value="join">
            <input type="submit" class="btn btn-info" name="Submit2" value="送出申請">
            <input type="reset" class="btn btn-info" name="Submit3" value="重設資料">
            <input type="button" class="btn btn-info" name="Submit" value="回上一頁" onClick="window.history.back();">
          </p>
        </form></td>
        <td width="300">
        <div class="col-xs-12"></div><div class="col-xs-12"></div>
<div class="col-xs-12" style="font-size: 20px;">
          <p><strong>填寫資料注意事項：</strong></p>
          <ol>
            <li> 請提供您本人正確、最新及完整的資料。 </li>
            <li> 在欄位後方出現「*」符號表示為必填的欄位。</li>
            <li>填寫時請您遵守各個欄位後方的補助說明。</li>
            <li>關於您的會員註冊以及其他特定資料，本系統不會向任何人出售或出借你所填寫的個人資料。</li>
            <li>在註冊成功後，除了「使用帳號」外您可以在會員專區內修改您所填寫的個人資料。</li>
          </ol>
          </div>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" background="images/album_r2_c1.jpg">© 2016 腎藥蘭花管理系統 ©</td>
  </tr>
</table>
</div>
</body>
</html>
