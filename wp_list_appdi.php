<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php');
require_once('Connections/konek.php'); 

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 11) {
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
mysql_select_db($database_konek, $konek);

//Paging
$hal = $_GET['hal'];
if(!isset($_GET['hal']))
{$page = 1;} else {$page = $_GET['hal'];} 

$maxRows_Recordset1 =20;
$startRow_Recordset1 = (($page * $maxRows_Recordset1) - $maxRows_Recordset1);  
$sekarang = gmdate('Ymd', time()+60*60*7);
//nomor urut
$nomer = ($page-1) * $maxRows_Recordset1; 

$query_Recordset1 =  "SELECT * FROM `$tb_wp` WHERE approve_dt = '-' and no_id = '$userid'";	
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $konek) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

$query_jml = "SELECT count(*) as num  FROM `$tb_wp` WHERE approve_dt = '-' and no_id = '$userid'";	
$hasil_jml = mysql_query($query_jml, $konek) or die(mysql_error());
$banyak_jml = mysql_fetch_assoc($hasil_jml);
$jml_row = $banyak_jml['num'];
$total_pages = ceil($jml_row / $maxRows_Recordset1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="60"  />
<title>Wp List DI</title>
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
	color: #900;
	font-size: 9pt;
}
.isik {
	text-align: left;
	color: #900;
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
.judul1 {font-size: 12px;
	font-weight: normal;
	color: #999;
	font-family: "Courier New", Courier, monospace;
}
.paging {font-size: 9pt;
	color: #FFF;
}

-->
</style>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
</head>
<body onload="MM_preloadImages('/img/t_logouta.JPG')">
<table width="980" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="100%" border="0" cellpadding="0">
      <tr>
        <td><?php include ('header.php')?></td>
      </tr>
      <tr>
        <td align="right" valign="bottom"  background="img/tab_menu.jpg"><?php include("tabs.php"); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" cellpadding="0">
      <tr>
        <td><table width="99%" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td nowrap="nowrap"><span class="judul1">Working Permit Approve Departement</span></td>
            <td align="right" nowrap="nowrap"><?php include('paging.php');?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr></tr>
          <tr bgcolor="#CCCCCC">
            <td rowspan="2" align="center" class="head" width="30">No</td>
            <td rowspan="2" align="center" class="head" width="60">No WP</td>
            <td colspan="2" align="center" class="head" >Date</td>
            <td rowspan="2" align="center" class="head" width="110">Dept Incharge</td>
            <td rowspan="2" align="center" class="head" width="135">Contractor</td>
            <td rowspan="2" align="center" class="head" width="135"><p>Job Description</p></td>
            <td rowspan="2" align="center" class="head" width="40">Floor</td>
            <td colspan="7" align="center" class="head" >Approve Status</td>
          </tr>
          <tr bgcolor="#CCCCCC">
            <td width="80" align="center" class="head">Start</td>
            <td align="center" class="head" width="80">Finish</td>
            <td align="center" class="head" width="37">DT</td>
            <td align="center" class="head" width="37">IB</td>
            <td align="center" class="head" width="37">FM</td>
            <td align="center" class="head" width="37">MT</td>
            <td align="center" class="head" width="37">ST</td>
            <td align="center" class="head" width="30">Action</td>
            <td align="center" class="head" width="30">View</td>
          </tr>
          <?php			 
	  
	  do { ?>
          <?php $nomer =$nomer+1; 
		  $tgl1 = $row_Recordset1['tgl1'];
		  $tgl2 = $row_Recordset1['tgl2'];
		  $tgl3 = $row_Recordset1['tgl3'];
		  $tgl4 = $row_Recordset1['tgl4'];
		  $tgl5 = $row_Recordset1['tgl5'];
		  $tgl6 = $row_Recordset1['tgl6'];
		  $tgl7 = $row_Recordset1['tgl7'];
		  $tgl8 = $row_Recordset1['tgl8'];
		  
		  require_once('tgl.php');
         
			$no_wp = $row_Recordset1['no_wp'];
			$di = ucwords($row_Recordset1['dept_incharge']);
			$kont = ucwords($row_Recordset1['kontraktor']);
			$jp =  ucwords($row_Recordset1['jns_pekerjaan']);
			$lantai = $row_Recordset1['lantai'];
			$dt = $row_Recordset1['approve_dt'];
			$ib = $row_Recordset1['approve_ib'];
			$fm = $row_Recordset1['approve_fm'];
			$mt = $row_Recordset1['approve_mt'];
			$st = $row_Recordset1['approve_st'];
			?>
          <tr height="20" >
            <td class="isi"><?php if($jml_row > 0 ){ echo $nomer; }?></td>
            <td class="isi"><?php echo $no_wp; ?></td>
            <td class="isi"><?php echo $mulai; ?></td>
            <td class="isi"><?php echo $selesai; ?></td>
            <td class="isik"><?php echo $di; ?></td>
            <td class="isik"><?php echo $kont ?></td>
            <td class="isik"><?php echo $jp;?></td>
            <td class="isi"><?php echo  $lantai; ?></td>
            <td class="isi"><?php echo $dt; ?></td>
            <td class="isi"><?php echo $ib; ?></td>
            <td class="isi"><?php echo $fm; ?></td>
            <td class="isi"><?php echo $mt; ?></td>
            <td class="isi"><?php echo $st; ?></td>
            <td class="isi" ><a href = "wp_app_listdi.php?no_wp=<?php echo $row_Recordset1['no_wp']; ?>">
              <?php if ($jml_row > 0 ) { echo "App";} ?>
            </a></td>
            <td class="isi" ><a href = "wp_app_di.php?no_wp=<?php echo $row_Recordset1['no_wp']; ?>">
              <?php if ($jml_row > 0 ) { echo "Detail";} ?>
            </a></td>
          </tr>
          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
          <tr>
            <td  class="isi" colspan="15">&nbsp;</td>
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
