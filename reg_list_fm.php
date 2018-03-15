<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php'); 
if ($s_bagian != 'Facility Management'){ header('Location: '.'login.php');}
require_once('Connections/konek.php'); 
include('page.php');

$sql 			= "SELECT * FROM $tb_reg where selesai >= $now and status != 'Used' ORDER BY `no` DESC ";
$sql_limit	 	= sprintf("%s LIMIT %d, %d", $sql, $startRow, $maxRows);
$sql_query 		= mysql_query($sql_limit, $konek) or die(mysql_error());
$result 		= mysql_fetch_assoc($sql_query);

$sql_jml 		= mysql_query($sql, $konek) or die(mysql_error());
$jml_row 		= mysql_num_rows($sql_jml);
$total_pages 	= ceil($jml_row / $maxRows);

?>
<?php 
$judul = "Reg List Today";
$title = "$judul";
include('doctype.php');
?>
<link href="css/utama.css" rel="stylesheet" type="text/css" />
<?php
include("atas.php"); 
?>
<table width="100%" border="1" cellpadding="1" cellspacing="0">
          <tr class="head">
            <th rowspan="2">No</th>
            <th rowspan="2">Contractor</th>
            <th rowspan="2">In charge</th>
            <th rowspan="2">No Registration</th>
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
          
          <?php do { ?>
          <?php
		  $nomer 	=	$nomer+1;   
		  $kontr 	= strtoupper($result['kontraktor']);
		  $no_id 	= $result['no_id'];	
		  $date 	= substr($result['date'],0,16);
		  $no_reg 	= $result['no_reg'];
		  $job_des 	= ucwords(strtolower($result['job_des']));
		  $qop 		= $result['qop'];
		  $mulai 	= $result['mulai'];
		  $selesai 	= $result['selesai'];
		  $status 	= $result['status'];
		  $lantai 	= $result['lantai'];
		  $no 		= $result['no'];
		  ?>
          <tr class="isi" height="21" >
            <td><?php if($jml_row > 0 ){ echo $nomer; }?></td>
            <td align="left"><?php echo $kontr; ?></td>
            <td><a href = "user_detail.php?no_id=<?php echo $no_id; ?>"><?php echo $no_id; ?></a></td>
            <td><?php echo $no_reg; ?></td>
            <td align="left" ><?php echo $job_des; ?></td>
            <td><?php echo $lantai; ?></td>
            <td><?php echo $qop; ?></td>
            <td nowrap="nowrap"><?php echo $mulai; ?></td>
            <td nowrap="nowrap"><?php echo $selesai; ?></td>
            <td><?php echo $status; ?></td>
          </tr>
          <?php } while ($result = mysql_fetch_assoc($sql_query)); ?>
          <tr>
            <td colspan="10" class="isi">&nbsp;</td>
          </tr>
</table>
<?php include('bawah.php');?>