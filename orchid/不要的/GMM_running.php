<?php 
header("Content-Type: text/html; charset=utf-8");
	if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
  			header("Location: index.php");
	} 
	if (isset($_POST['gh_name'])) {   //isset檢查變數是否設置
		 require_once 'MYSQL.php';
		$gh_name = $_POST['gh_name'];
		$gh_num = $_POST['gh_num'];         //前一個網頁的欄位資料
		$gh_user = $_POST['gh_user']; //前一個網頁的欄位資料
		$gh_add = $_POST['gh_add'];
		$gh_data = $_POST['gh_data'];
		$sql = "INSERT INTO `greenhouse`(`gh_name`, `gh_num`,`gh_user`,`gh_add`,`gh_data`) VALUES ('$gh_name','$gh_num','$gh_user','$gh_add',$gh_data)";
		mysql_query($sql)or die(mysql_error());
		header("Location: GMM.php?loginStats=1"); //新增完資料做網頁跳轉
	} 
	else
		echo "新增失敗";
?>