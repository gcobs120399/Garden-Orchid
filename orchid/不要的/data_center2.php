<?php
require_once("connMysql2.php");
$sth = mysql_query("SELECT battery_3 FROM `_center` ORDER BY date DESC LIMIT 0,20");
$rows = array();
$rows['name'] = '電池電壓';
while($r = mysql_fetch_array($sth)) {
    $rows['data'][] = $r['battery_3'];
}
$sth = mysql_query("SELECT temp_3 FROM `_center` ORDER BY date DESC LIMIT 0,20");
$rows1 = array();
$rows1['name'] = '環境溫度';
while($r1 = mysql_fetch_assoc($sth)) {
    $rows1['data'][] = $r1['temp_3'];
}
$sth = mysql_query("SELECT humi_3 FROM `_center` ORDER BY date DESC LIMIT 0,20");
$rows2 = array();
$rows2['name'] = '環境濕度';
while($r2 = mysql_fetch_assoc($sth)) {
    $rows2['data'][] = $r2['humi_3'];
}
$sth = mysql_query("SELECT date FROM `_center` ORDER BY date DESC LIMIT 0,20");
$rows3 = array();
$rows3['name'] = 'date';
while($r3 = mysql_fetch_assoc($sth)) {
    $rows3['data'][] = $r3['date'];
}
$result = array();
array_push($result,$rows);
array_push($result,$rows1);
array_push($result,$rows2);
array_push($result,$rows3);
print json_encode($result, JSON_NUMERIC_CHECK);
?>
