<?php
require_once('Connections/konek.php'); 
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}
$ip=getenv(REMOTE_ADDR);
$job_des 		= $_POST['job_des'];
$job_des		= antiinjection($job_des);
				
 $insertSQL = sprintf("INSERT INTO $tb_reg (no_id, no_reg, kontraktor, job_des, qop, date, lantai, ip, lokasi, mulai, selesai)    
 VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($username, "text"),		
					   GetSQLValueString('-', "text"),	
                       GetSQLValueString($_POST['kontraktor'], "text"),
                       GetSQLValueString(ucwords($job_des), "text"),
                       GetSQLValueString($_POST['qop'], "text"),
					   GetSQLValueString(gmdate('Y-m-d H:i:s', time()+60*60*7), "date"),
					   GetSQLValueString($_POST['lantai'], "text"),	
					   GetSQLValueString($ip, "text"),
					   GetSQLValueString($tempat, "text"),
					   GetSQLValueString($_POST['mulai'], "text"),					  
                       GetSQLValueString($_POST['selesai'], "text")); 
 
  $Result = mysql_query($insertSQL, $konek) or die(mysql_error());
  ?>