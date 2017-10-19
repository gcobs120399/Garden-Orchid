<?php
require_once("MYSQL.php");
session_start();
if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
}

$sth = mysql_query("SELECT h_stems FROM `history` WHERE `h_on`='".$_GET["id"]."' ORDER BY h_jointime ASC LIMIT 0,20");
$rows = array();
$rows['name'] = '莖高';
while($r = mysql_fetch_array($sth)) {
    $rows['data'][] = $r['h_stems'];
}
$sth = mysql_query("SELECT h_leafsize FROM `history` WHERE `h_on`='".$_GET["id"]."' ORDER BY h_jointime ASC LIMIT 0,20");
$rows1 = array();
$rows1['name'] = '葉片大小';
while($r1 = mysql_fetch_assoc($sth)) {
    $rows1['data'][] = $r1['h_leafsize'];
}
$sth = mysql_query("SELECT h_leafNum FROM `history` WHERE `h_on`='".$_GET["id"]."' ORDER BY h_jointime ASC LIMIT 0,20");
$rows2 = array();
$rows2['name'] = '葉片數量';
while($r2 = mysql_fetch_assoc($sth)) {
    $rows2['data'][] = $r2['h_leafNum'];
}
$sth = mysql_query("SELECT h_jointime FROM `history` WHERE `h_on`='".$_GET["id"]."' ORDER BY h_jointime ASC LIMIT 0,20");
$rows3 = array();
$rows3['name'] = '加入時間';
while($r3 = mysql_fetch_assoc($sth)) {
    $rows3['data'][] = $r3['h_jointime'];
}
$sth = mysql_query("SELECT h_pedlength FROM `history` WHERE `h_on`='".$_GET["id"]."' ORDER BY h_jointime ASC LIMIT 0,20");
$rows4 = array();
$rows4['name'] = '花梗長度';
while($r4 = mysql_fetch_assoc($sth)) {
    $rows4['data'][] = $r4['h_pedlength'];
}
$sth = mysql_query("SELECT h_pedNum FROM `history` WHERE `h_on`='".$_GET["id"]."' ORDER BY h_jointime ASC LIMIT 0,20");
$rows5 = array();
$rows5['name'] = '花梗長度';
while($r5 = mysql_fetch_assoc($sth)) {
    $rows5['data'][] = $r5['h_pedNum'];
}
$sth = mysql_query("SELECT h_bifNum FROM `history` WHERE `h_on`='".$_GET["id"]."' ORDER BY h_jointime ASC LIMIT 0,20");
$rows6 = array();
$rows6['name'] = '花梗長度';
while($r6 = mysql_fetch_assoc($sth)) {
    $rows6['data'][] = $r6['h_bifNum'];
}
$result = array();
array_push($result,$rows);
array_push($result,$rows1);
array_push($result,$rows2);
array_push($result,$rows3);
array_push($result,$rows4);
array_push($result,$rows5);
array_push($result,$rows6);
print json_encode($result, JSON_NUMERIC_CHECK);
//header("Location: test1.php");//WHERE `h_on`='".$_GET["id"]."'
?>
