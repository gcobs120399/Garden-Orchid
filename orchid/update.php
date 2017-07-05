<?php
header("Content-Type: text/html; charset=utf-8");
  if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
        header("Location: index.php");
  }

$query_RecFlower = "SELECT * FROM `flower` WHERE `f_id`=".$_GET["id"];
$RecFlower = mysql_query($query_RecFlower);
$row_RecFlower=mysql_fetch_assoc($RecFlower);

	include("MYSQL.php");
	$id = $_GET['id'];
	$sql = "SELECT * FROM flower WHERE `f_id`='{$id}'";
	$r = mysql_query($sql);
	$data = mysql_fetch_assoc($r);
	if (isset($_POST['f_biology'])) {
  $f_id = $_POST['f_id'];
  $f_biology = $_POST['f_biology'];
  $f_stems = $_POST['f_stems'];         //前一個網頁的欄位資料
  $f_leafsize = $_POST['f_leafsize']; //前一個網頁的欄位資料
  $f_leafNum = $_POST['f_leafNum'];
  $f_pedlength = $_POST['f_pedlength'];
  $f_pedNum = $_POST['f_pedNum'];
  $f_bifNum = $_POST['f_bifNum'];
  $f_username = $_POST['f_username'];
  $sql = "UPDATE flower SET f_biology='{$f_biology}', f_stems='{$f_stems}' ,f_leafsize='{$f_leafsize}',f_leafNum='{$f_leafNum}',f_pedlength='{$f_pedlength}',f_pedNum='{$f_pedNum}',f_bifNum='{$f_bifNum}' WHERE f_id='{$id}'";
  mysql_query($sql);
  header("Location: CM.php");
	}
?>
