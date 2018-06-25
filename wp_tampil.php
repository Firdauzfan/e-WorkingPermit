<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
require_once('Connections/konek.php'); 
$sql 		= "SELECT * FROM $tb_wp where (`approve_ib` = '-' or `approve_fm` = '-' or `approve_mt` = '-' or `approve_st` = '-') and (tgl1 >= $now or tgl2 >= $now or tgl3 >= $now or tgl4 >= $now or tgl5 >= $now or tgl6 >= $now or tgl7 >= $now or tgl8 >= $now) and sts ='Yes'";
$sql_query	= mysql_query($sql, $konek) or die(mysql_error());
$hasil 		= mysql_fetch_assoc($sql_query);
$jml_row 	= mysql_num_rows($sql_query);	

$judul 		= "Approve Progress";
$title 		= "$judul";
$refresh 	= "37";
include('doctype.php');
?>
<link href="css/utama.css" rel="stylesheet" type="text/css" />
<?php
include("atas.php"); 
?>
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
  <tr></tr>
  <tr class="head">
    <th rowspan="2">No</th>
    <th colspan="2">Date Schedule</th>
    <th rowspan="2">Contractor</th>
    <th rowspan="2">Job Description</th>
    <th rowspan="2">Floor</th>
    <th colspan="4">Approve Status</th>
    <th rowspan="2">View</th>
  </tr>
  <tr class="head">
    <th>Start</th>
    <th>Finish</th>
    <th>IB</th>
    <th>FM</th>
    <th>MT</th>
    <th>ST</th>
  </tr>
  <?php		  
	  do { ?>
  <?php
		  $nomer =$nomer+1; 
		  $tgl1 = $hasil['tgl1'];
		  $tgl2 = $hasil['tgl2'];
		  $tgl3 = $hasil['tgl3'];
		  $tgl4 = $hasil['tgl4'];
		  $tgl5 = $hasil['tgl5'];
		  $tgl6 = $hasil['tgl6'];
		  $tgl7 = $hasil['tgl7'];
		  $tgl8 = $hasil['tgl8'];
		  include('tgl.php'); 			
			 ?>
  <tr height="23">
    <td class="isi"><?php if($jml_row > 0 ){echo $nomer; }?></td>
    <td class="isi"><?php if($jml_row > 0 ){echo $mulai;} ?></td>
    <td class="isi"><?php if($jml_row > 0 ){echo $selesai;} ?></td>
    <td class="isik"><?php echo ucwords($hasil['kontraktor']); ?></td>
    <td class="isik"><?php echo ucwords(substr($hasil['jns_pekerjaan'],0,30));?></td>
    <td class="isi"><?php echo $hasil['lantai']; ?></td>
    <td class="isi"><?php echo $hasil['approve_ib']; ?></td>
    <td class="isi"><?php echo $hasil['approve_fm']; ?></td>
    <td class="isi"><?php echo $hasil['approve_mt']; ?></td>
    <td class="isi"><?php echo $hasil['approve_st']; ?></td>
    <td class="isi" ><a href = "wp_detail.php?no_wp=<?php echo md5($hasil['no_wp']); ?>">
      <?php if ($jml_row > 0 ) { echo "Detail";} ?>
    </a></td>
  </tr>
  <?php } while ($hasil = mysql_fetch_assoc($sql_query)); ?>
  <tr>
    <td colspan="11" class="isi">&nbsp;</td>
  </tr>
</table>
<?php include('bawah.php');?>

