<?php
include('palidasi.php'); 
if ($bagian != 'Admin'){ die('Access Denied (policy_denied)');}
require_once('Connections/konek.php'); 
?>
<?php
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
mysql_select_db($database_konek, $konek);

//Paging
$hal = $_GET['hal'];
if(!isset($_GET['hal']))
{$page = 1;} else {$page = $_GET['hal'];} 

$maxRows_Recordset1 = 20;
$startRow_Recordset1 = (($page * $maxRows_Recordset1) - $maxRows_Recordset1);  
//nomor urut
$nomer = ($page-1) * $maxRows_Recordset1; 

$query_Recordset1 ="SELECT * FROM tb_user where bagian != 'Departement' and no_id != '12078212' and no_id != '12078213' and no_id != '12078214'  and no_id != '12078215' ORDER BY `bagian` ASC ";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $konek) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

$query_jml = "SELECT count(*) as num FROM tb_user where bagian != 'Departement' and no_id != '12078212' and no_id != '12078213' and no_id != '12078214' and no_id != '12078215'";
$hasil_jml = mysql_query($query_jml, $konek) or die(mysql_error());
$banyak_jml = mysql_fetch_assoc($hasil_jml);
$jml_row = $banyak_jml['num'];
$total_pages = ceil($jml_row / $maxRows_Recordset1);

// end paging
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="37" />
<title>Departement Incharge List</title>
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
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
.isi {
	color: #900;
	font-size: 9pt;
}
.jdl {
	font-weight: bold;
	color: #00F;
	font-size: 16px;
	text-decoration: underline;
}
.paging {	font-size: 9pt;
	color: #FFF;
}
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 9pt;
}
.judul {
	font-size: 12px;
	font-weight: normal;
	color: #999;
	font-family: "Courier New", Courier, monospace;
}

-->
</style></head>
<body onload="MM_preloadImages('/img/t_input-usera.jpg','/img/t_userlista.jpg')">
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr>
  <td colspan="2"><table width="100%" border="0" cellpadding="0">
    <tr>
      <td><?php include ('header.php')?></td>
    </tr>
    <tr>
      <td align="right" valign="bottom"  background="img/tab_menu.jpg"><?php include("tabs.php"); ?></td>
    </tr>
  </table></td>
  </tr> 
  <tr>
    <td>
    <table width="100%" ><tr>
        <td><table width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td nowrap="nowrap" class="judul">User List</td>
            <td align="right" nowrap="nowrap"><?php include ('paging.php'); ?></td>
          </tr>
        </table>
          <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr >
            <th align="center" bgcolor="#CCCCCC">No</th>
            <th align="center" bgcolor="#CCCCCC">Number ID</th>
            <th align="center" bgcolor="#CCCCCC">Name</th>
            <th align="center" bgcolor="#CCCCCC">Title</th>
            <th align="center" bgcolor="#CCCCCC">Login Status</th>
            <th align="center" bgcolor="#CCCCCC">Email</th>
            <th align="center" bgcolor="#CCCCCC">Phone</th>
            <th align="center" bgcolor="#CCCCCC">Status</th>
            <th align="center" bgcolor="#CCCCCC">Edit</th>
          </tr>
          <?php	
	  
	  do { ?>
          <?php $nomer =$nomer+1;
          $salah = $row_Recordset1['salah'];
		  $no_id = $row_Recordset1['no_id'];
		  $email = $row_Recordset1['email'];?>
          <tr class="isi" height="20">
            <td align="center"><?php echo $nomer; ?></td>
             <td align="center" ><a href = "user_detail.php?no_id=<?php echo $row_Recordset1['no_id']; ?>"><?php echo $no_id;?></a></td> 
            <td><?php echo ucwords($row_Recordset1['nama']); ?></td>
            <td><?php echo ucwords($row_Recordset1['title']); ?></td>
            <td><?php echo ucwords($row_Recordset1['bagian']); ?></td>
            <td><?php echo "<a href = 'mailto:$email'>$email</a>"; ?></td>
            <td><?php echo $row_Recordset1['telp']; ?></td>
            <td align="center" ><a href = "p_status.php?no_id=<?php echo $row_Recordset1['no_id']; ?>"><?php echo ucwords($row_Recordset1['status']);?></a></td>           
            <td align="center"><?php if ($salah >= 3 ) { echo "<a href = 'user_edit_adm.php?no_id=$no_id'>Edit</a>";} else { echo '-';} ?></td>
          </tr>
          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
          <tr class="isi"><td colspan="10">&nbsp;</td></tr>
        </table></td>
      </tr>
  </table></td></tr> 
  <tr>
    <td colspan="2" align="center"><?php include("foot.php"); ?></td>
  </tr>
</table>
</body>
</html>
