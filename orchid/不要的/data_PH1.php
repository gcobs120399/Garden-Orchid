<?php
require_once("MYSQL.php");
session_start();
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
}

$sth = mysql_query("SELECT h_pedlength FROM `history` WHERE `h_username`='".$_SESSION["loginMember"]."' ORDER BY h_jointime ASC LIMIT 0,20");
$rows = array();
$rows['name'] = '花梗長度';
while($r = mysql_fetch_assoc($sth)) {
    $rows['data'][] = $r['h_pedlength'];
}
$sth = mysql_query("SELECT h_pedNum FROM `history` WHERE `h_username`='".$_SESSION["loginMember"]."' ORDER BY h_jointime ASC LIMIT 0,20");
$rows1 = array();
$rows1['name'] = '花梗數量';
while($r1 = mysql_fetch_assoc($sth)) {
    $rows1['data'][] = $r1['h_pedNum'];
}
$sth = mysql_query("SELECT h_bifNum FROM `history` WHERE `h_username`='".$_SESSION["loginMember"]."' ORDER BY h_jointime ASC LIMIT 0,20");
$rows2 = array();
$rows2['name'] = '分岔數';
while($r2 = mysql_fetch_assoc($sth)) {
    $rows2['data'][] = $r2['h_bifNum'];
}



$sth = mysql_query("SELECT h_jointime FROM `history` WHERE `h_username`='".$_SESSION["loginMember"]."' ORDER BY h_jointime ASC LIMIT 0,20");
$rows3 = array();
$rows3['name'] = '加入時間';
while($r3 = mysql_fetch_assoc($sth)) {
    $rows3['data'][] = $r3['h_jointime'];
}

$result = array();
array_push($result,$rows);
array_push($result,$rows1);
array_push($result,$rows2);
array_push($result,$rows3);
print json_encode($result, JSON_NUMERIC_CHECK);
//header("Location: PH2.php");WHERE `h_on`='".$_GET["id"]."'
?>
