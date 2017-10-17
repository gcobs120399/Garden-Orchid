<?php 
header("Content-Type: text/html; charset=utf-8");
	if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
  			header("Location: index.php");
	} 
	if (isset($_POST['e_name'])) {   //isset檢查變數是否設置
		 require_once 'MYSQL.php';
		$e_name = $_POST['e_name'];
		$e_num = $_POST['e_num'];         //前一個網頁的欄位資料
		$e_user = $_POST['e_user']; //前一個網頁的欄位資料
		$e_money = $_POST['e_money'];
		$e_pattern = $_POST['e_pattern'];
		$sql = "INSERT INTO `equipment`(`e_name`, `e_num`,`e_user`,`e_money`,`e_pattern`) VALUES ('$e_name','$e_num','$e_user','$e_money','$e_pattern')";
		mysql_query($sql)or die(mysql_error());
		header("Location: SM.php?loginStats=1"); //新增完資料做網頁跳轉
	} 
	else
		echo "新增失敗";
?>