<?php 
  define('DB_SERVER', '140.127.1.99'); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', 'minar');
  define('DB_SERVER_PASSWORD', 'minar7908kung');
  define('DB_DATABASE', 'orchid_garden');
  define('USE_PCONNECT', 'false'); // use persistent connections?
  define('STORE_SESSIONS', 'mysql'); // leave empty '' for default handler or set to 'mysql'
  define('API_KEY', 'ABQIAAAApgUHIls-_vie419u4pEaMRRHZQgZCigy1kBY-hnA6u5w8jZUdhTB2a3z9nL_RN5K5LipP5IoGo0QuQ');   // localhost

 if (!@mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD)) die("資料連結失敗！");
    //連接資料庫
    if (!@mysql_select_db(DB_DATABASE)) die("資料庫選擇失敗！");
    //設定字元集與連線校對
    mysql_query("SET NAMES 'utf8'");
?>