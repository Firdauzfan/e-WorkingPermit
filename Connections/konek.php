<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname 	= "localhost";
$username 	= "root";
$password 	= "root";
$database 	= "wp_db";
$tempat		= 1; 
$tb_wp		= "tb_wp$tempat"; //disesuaikan dengan tabel wp
// $tb_reg		= "tb_regkerja$tempat"; // disesuaikan dengan tabel registrasi
$tb_reg		= "tb_regkerja"; 
$now 		= gmdate('Ymd',time()+60*60*7);
$time		= gmdate('Y-m-d H:i:s', time()+60*60*7);
$ip_komp	= @$_SERVER['REMOTE_ADDR'].'_'.gethostbyaddr(@$_SERVER['REMOTE_ADDR']);
$konek 		= @mysql_connect($hostname, $username, $password) or @trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database, $konek);
include('tempat.php');
?>