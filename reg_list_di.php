<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php'); 
if ($s_bagian == 'Maintenance' or $s_bagian == 'Security'){header('Location: '.'login.php');}
require_once('Connections/konek.php'); 
include('page.php');

$sql 			= "SELECT * FROM $tb_reg where upper(no_id) = '$s_userid' ORDER BY no DESC ";
$query_limit 	= sprintf("%s LIMIT %d, %d", $sql, $startRow, $maxRows);
$sql_query 		= mysql_query($query_limit, $konek) or die(mysql_error());
$result 		= mysql_fetch_assoc($sql_query);

$sql_query_jml 	= mysql_query($sql, $konek) or die(mysql_error());
$jml_row 		= mysql_num_rows($sql_query_jml);
$total_pages 	= ceil($jml_row / $maxRows);
?>
<?php 
$judul = " Registrasi List";
$title = "$judul";
include('doctype.php');
?>
<link href="css/utama.css" rel="stylesheet" type="text/css" />
<?php
include("atas.php"); 
?>
<table width="100%" border="1" cellpadding="1" cellspacing="0" >
  <tr class="head" >
    <th rowspan="2">No</th>
    <th rowspan="2">Contractor</th>    
    <th rowspan="2">Reg Number</th>
    <th rowspan="2">Job Description</th>
    <th rowspan="2">Floor</th>
    <th rowspan="2">Person</th>
    <th colspan="2">Create Schedule</th>
    <th rowspan="2">Status</th>
  </tr>
  <tr class="head">
    <th>Start</th>
    <th>Finish</th>
  </tr>
  <?php	do { ?>
  <?php $nomer =$nomer+1; ?>
  <tr class="isi" height="21" >
    <td><?php if($jml_row > 0 ){ echo $nomer; }?></td>
    <td align="left"><?php echo strtoupper($result['kontraktor']); ?></td>   
    <td><?php echo $result['no_reg']; ?></td>
    <td align="left"><?php echo $result['job_des']; ?></td>
    <td><?php echo $result['lantai']; ?></td>
    <td><?php echo $result['qop']; ?></td>
    <td nowrap="nowrap"><?php echo $result['mulai']; ?></td>
    <td nowrap="nowrap"><?php echo $result['selesai']; ?></td>
    <td><?php echo $result['status']; ?></td>
  </tr>
  <?php } while ($result = mysql_fetch_assoc($sql_query)); ?>
  <tr>
    <td colspan="9" class="isik">&nbsp;</td>
  </tr>
</table>
<?php include('bawah.php');?>
