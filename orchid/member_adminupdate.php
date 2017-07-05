<?php
header("Content-Type: text/html; charset=utf-8");
require_once("MYSQL.php");
session_start();
//檢查是否經過登入
if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
	header("Location: index.php");
}
//檢查權限是否足夠
if($_SESSION["memberLevel"]=="member"){
	header("Location: member_center.php");
}
//執行登出動作
if(isset($_GET["logout"]) && ($_GET["logout"]=="true")){
	unset($_SESSION["loginMember"]);
	unset($_SESSION["memberLevel"]);
	header("Location: index.php");
}
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
	$query_update .= "`m_address`='".$_POST["m_address"]."' ";//注意最後的是空白 而不是逗號
	$query_update .= "WHERE `m_id`=".$_POST["m_id"];
	mysql_query($query_update);
	//重新導向
	header("Location: member_admin.php");
}
//選取管理員資料
$query_RecAdmin = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
$RecAdmin = mysql_query($query_RecAdmin);
$row_RecAdmin=mysql_fetch_assoc($RecAdmin);
//繫結選取會員資料
$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_id`='".$_GET["id"]."'";
$RecMember = mysql_query($query_RecMember);
$row_RecMember=mysql_fetch_assoc($RecMember);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>網站會員系統</title>
<link href="style.css" rel="stylesheet" type="text/css">
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
</head>

<body style="background-color:#FFEFD5;">
<table width="780" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td class="tdbline"><img src="images/mlogo.png" alt="會員系統" width="164" height="67"></td>
  </tr>
  <tr>
    <td class="tdbline"><table width="100%" border="0" cellspacing="0" cellpadding="10">
      <tr valign="top">
        <td class="tdrline"><form action="" method="POST" name="formJoin" id="formJoin" onSubmit="return checkForm();">
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
              <span class="smalltext">若不修改密碼，請不要填寫。若要修改，請輸入密碼</span><span class="smalltext">二次。<br></span></p>
            <hr size="1" />
            <p class="heading">個人資料</p>
            <p><strong>真實姓名</strong>：
                <input name="m_name" type="text" class="normalinput" id="m_name" value="<?php echo $row_RecMember["m_name"];?>">
                <font color="#FF0000">*</font> </p>
            <p><strong>性　　別</strong>：
              <input name="m_sex" type="radio" value="女" <?php if($row_RecMember["m_sex"]=="女") echo "checked";?>>
              女
  <input name="m_sex" type="radio" value="男" <?php if($row_RecMember["m_sex"]=="男") echo "checked";?>>
              男 <font color="#FF0000">*</font></p>
            <p><strong>生　　日</strong>：
                <input name="m_birthday" type="date" class="normalinput" id="m_birthday" value="<?php echo $row_RecMember["m_birthday"];?>">
                <font color="#FF0000">*</font> <br>
                <span class="smalltext">為西元格式(YYYY-MM-DD)。 </span></p>
            <p><strong>電子郵件</strong>：
                <input name="m_email" type="text" class="normalinput" id="m_email" value="<?php echo $row_RecMember["m_email"];?>">
                <font color="#FF0000">*</font> </p>
            <p class="smalltext">請確定此電子郵件為可使用狀態，以方便未來系統使用，如補寄會員密碼信。</p>
            <p><strong>個人網頁</strong>：
                <input name="m_url" type="text" class="normalinput" id="m_url" value="<?php echo $row_RecMember["m_url"];?>">
                <br>
                <span class="smalltext">請以「http://」 為開頭。</span> </p>
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
            <input type="submit" name="Submit2" value="修改資料">
            <input type="reset" name="Submit3" value="重設資料">
            <input type="button" name="Submit" value="回上一頁" onClick="window.history.back();">
          </p>
        </form></td>
        <td width="200">
        <div class="col-xs-12"></div><div class="col-xs-12"></div>
<div class="col-xs-12">
          <p class="heading"><strong>會員系統</strong></p>
            <p><strong><?php echo $row_RecAdmin["m_name"];?></strong> 您好。</p>
            <p>            本次登入的時間為：<br>
            <?php echo $row_RecAdmin["m_logintime"];?></p>
            <p align="center"><a href="member_center.php">會員中心</a> | <a href="?logout=true">登出系統</a></p>
</div>
        <div class="col-xs-12"></div><div class="col-xs-12"></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center" background="images/album_r2_c1.jpg" class="trademark">© 2016 農業物聯生產管理系統 ©</td>
  </tr>
</table>
</body>
</html>
