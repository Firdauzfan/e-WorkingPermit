<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
require_once('Connections/konek.php');
$Sql 		= "SELECT * FROM $tb_reg where selesai >= $now and status = 'Waiting' and no_id != '' ORDER BY `no` DESC ";
$sql_query 	= mysql_query($Sql, $konek) Or die(mysql_error());
$hasil 		= mysql_fetch_assoc($sql_query);	
$jml_row 	= mysql_num_rows($sql_query);	

$judul 		= "Working Permit Request";
$title 		= "$judul";
$refresh 	= "370";
include('doctype.php');
?>
<link href="css/utama.css" rel="stylesheet" type="text/css" />
<?php
include("atas.php"); 
?>        
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
  <tr class="head">
    <th rowspan="2">No</th>
    <th rowspan="2">Contractor</th>
    <th rowspan="2">Job Description</th>
    <th rowspan="2">Floor</th>
    <th rowspan="2">Person</th>
    <th rowspan="2">Dept Incharge</th>
    <th colspan="2">Create Schedule</th>
    <th rowspan="2"> Status</th>
  </tr>
  <tr class="head">
    <th align="center">Start</th>
    <th align="center">Finish</th>
  </tr>
  <?php do { ?>
  <?php $nomer =$nomer+1;  ?>
  <tr class="isi" height="23" >
    <td align="center"><?php if($jml_row > 0 ){ echo $nomer; }?></td>
    <td align="left"><?php echo $hasil['kontraktor']; ?></td>
    <td align="left"><?php echo $hasil['job_des']; ?></td>
    <td align="center"><?php echo $hasil['lantai']; ?></td>
    <td align="center"><?php echo $hasil['qop']; ?></td>
    <td align="center"><a href = "user_detail.php?no_id=<?php echo md5($hasil['no_id']);?>"><?php echo $hasil['no_id']; ?></a></td>
    <td align="center" nowrap="nowrap"><?php echo $hasil['mulai']; ?></td>
    <td align="center" nowrap="nowrap"><?php echo $hasil['selesai']; ?></td>
    <td align="center" ><?php echo $hasil['status']; ?></td>
  </tr>
  <?php } while ($hasil = mysql_fetch_assoc($sql_query)); ?>
  <tr>
    <td colspan="9" class="isi">&nbsp;</td>
  </tr>
</table>
<?php include('bawah.php');?>