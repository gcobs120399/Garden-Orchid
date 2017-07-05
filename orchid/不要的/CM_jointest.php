<?php
header("Content-Type: text/html; charset=utf-8");
	if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
  			header("Location: index.php");
	}
	$query_RecMember = "SELECT * FROM `memberdata` WHERE `m_username`='".$_SESSION["loginMember"]."'";
	$RecMember = mysql_query($query_RecMember);
	$row_RecMember=mysql_fetch_assoc($RecMember);
	if (isset($_POST['f_biology'])) {   //isset檢查變數是否設置
		 require_once 'MYSQL.php';
		$f_biology = $_POST['f_biology'];
		$f_stems = $_POST['f_stems'];         //前一個網頁的欄位資料
		$f_leafsize = $_POST['f_leafsize']; //前一個網頁的欄位資料
		$f_leafNum = $_POST['f_leafNum'];
		$f_pedlength = $_POST['f_pedlength'];
		$f_pedNum = $_POST['f_pedNum'];
		$f_bifNum = $_POST['f_bifNum'];
		$f_username = $_POST['f_username'];

		$sql = "INSERT INTO `flower`(`f_biology`, `f_stems`,`f_leafsize`,`f_leafNum`,`f_pedlength`,`f_pedNum`,`f_bifNum` ,`f_username`) VALUES ('$f_biology','$f_stems','$f_leafsize','$f_leafNum','$f_pedlength','$f_pedNum','$f_bifNum' ,'$f_username')";
		mysql_query($sql)or die(mysql_error());
		header("Location: CM.php?loginStats=1"); //新增完資料做網頁跳轉
	}
	else
		{echo "新增失敗";}
?>