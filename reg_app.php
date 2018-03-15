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

$currentPage = $_SERVER["PHP_SELF"];

//Paging
include('page.php');

$sql		= "SELECT * FROM $tb_reg where selesai >= $sekarang and no_reg = '-' ORDER BY `date` DESC ";
$sql_limit	= sprintf("%s LIMIT %d, %d", $sql, $startRow, $maxRows);
$sql_query	= mysql_query($sql_limit, $konek) or die(mysql_error());
$result		= mysql_fetch_assoc($sql_query);

$query_jml 	= "SELECT count(*) as num  FROM $tb_reg where selesai >= $sekarang and no_reg = '-' ";
$hasil_jml 	= mysql_query($query_jml, $konek) or die(mysql_error());
$banyak_jml = mysql_fetch_assoc($hasil_jml);
$jml_row 	= $banyak_jml['num'];
$total_pages = ceil($jml_row / $maxRows);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="37" />
<title>Reg List</title>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
}
.head {
	font-size: 9pt;
	font-weight: bold;
	color: #00C;
}
.isi {
	text-align: center;
	color: #333;
	font-size: 9pt;
}
.isik {
	text-align: left;
	color: #333;
	font-size: 9pt;
}
.home {
	font-weight: bold;
	font-size: 18px;
	font-family: "Comic Sans MS", cursive;
	color: #00C;
}
.judul {
	font-size: 36px;
	font-weight: bold;
	font-family: "MS Serif", "New York", serif;
	color: #900;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #06C;
}
a:hover {
	text-decoration: underline;
	color: #933;
}
a:active {
	text-decoration: none;
	
}
.judul1 {	font-size: 12px;
	font-weight: normal;
	color: #999;
	font-family: "Courier New", Courier, monospace;
}
.paging {	font-size: 9pt;
	color: #FFF;
}

-->
</style>
</head>
<body onload="MM_preloadImages('/img/t_input-usera.jpg','/img/t_userlista.jpg')">
<table width="980" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php include("head.php"); ?></td>
  </tr>
  <tr>
    <td><table width="100%" cellpadding="0">
      <tr>
        <td><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td nowrap="nowrap"><span class="judul1">Registration Working Permit Waiting for Approve</span></td>
            <td align="right" nowrap="nowrap"><?php include('paging.php');?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="1" align="center" cellpadding="1" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
            <th rowspan="2" nowrap="nowrap" bgcolor="#CCCCCC"><span class="head">No</span></th>
            <th rowspan="2" nowrap="nowrap" bgcolor="#CCCCCC"><span class="head">Contractor</span></th>
            <th rowspan="2" nowrap="nowrap" bgcolor="#CCCCCC"><span class="head"> User ID</span></th>
            <th rowspan="2" nowrap="nowrap" bgcolor="#CCCCCC"><span class="head">No Registration</span></th>
            <th rowspan="2" nowrap="nowrap" bgcolor="#CCCCCC"><span class="head">Job Description</span></th>
            <th rowspan="2" nowrap="nowrap" bgcolor="#CCCCCC"><span class="head">Floor</span></th>
            <th rowspan="2" bgcolor="#CCCCCC"><span class="head">Qty of <br />
              Person</span></th>
            <th colspan="2" nowrap="nowrap" bgcolor="#CCCCCC"><span class="head">Date Schedule</span></th>
            <th rowspan="2" align="center" bgcolor="#CCCCCC"><span class="head">Status</span></th>
          </tr>
          <tr >
            <th align="center" nowrap="nowrap" bgcolor="#CCCCCC"><span class="head">Start</span></th>
            <th align="center" nowrap="nowrap" bgcolor="#CCCCCC"><span class="head">Finish</span></th>
          </tr>
          <?php	
	  
	  do { ?>
          <?php 
		  $nomer 	= $nomer+1;   
		  $kontr 	= strtolower($result['kontraktor']);
		  $no_id 	= $result['no_id'];	
		  $date 	= substr($result['date'],0,16);
		  $no_reg 	= $result['no_reg'];
		  $job_des 	= $result['job_des'];
		  $qop 		= $result['qop'];
		  $mulai 	= $result['mulai'];
		  $selesai 	= $result['selesai'];
		  $status 	= $result['status'];
		  $lantai 	= $result['lantai'];
		  $no 		= $result['no'];?>
          <tr class="isi" height="20" >
            <td align="center"><?php if($jml_row > 0 ){ echo $nomer; }?></td>
            <td align="left"><?php echo ucwords($kontr); ?></td>
            <td align="center"><a href = "user_detail.php?no_id=<?php echo $no_id; ?>"><?php echo $no_id; ?></a></td>
            <td align="center" nowrap="nowrap"><?php echo $no_reg; ?></td>
            <td align="left"><?php echo $job_des; ?></td>
            <td align="center"><?php echo $lantai; ?></td>
            <td align="center"><?php echo $qop; ?></td>
            <td align="center" nowrap="nowrap"><?php echo $mulai; ?></td>
            <td align="center" nowrap="nowrap"><?php echo $selesai; ?></td>
            <td align="center"><?php echo $status; ?></td>
          </tr>
          <?php } while ($result = mysql_fetch_assoc($sql_query)); ?>
          <tr>
            <td colspan="10" class="isi">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php include("foot.php"); ?></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
