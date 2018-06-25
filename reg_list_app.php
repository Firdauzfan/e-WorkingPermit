<?php
  error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
	include('palidasi.php'); 
	if ($s_bagian != 'Facility Management'){ header('Location: '.'login.php');}

	$sql 		= "SELECT * FROM $tb_reg where selesai >= $now and status = 'Waiting' and no_id != '' ORDER BY `no` DESC ";
	$sql_query 	= mysql_query($sql, $konek) or die(mysql_error());
	$result 	= mysql_fetch_assoc($sql_query);
	$jml_row 	= mysql_num_rows($sql_query);
?>

<?php 
	$judul = "Reg List Approve";
	$title = "$judul";
	include('doctype.php');
?>
	<link href="css/utama.css" rel="stylesheet" type="text/css" />
<?php
	include("atas.php"); 
?>
<Table Width="100%" Border="1" cellpadding="1" cellspacing="0" >
  <tr class="head">
     <th rowspan="2">No</th>
     <th rowspan="2">Contractor</th>
     <th rowspan="2">User ID</th>           
     <th rowspan="2">Job Description</th>
     <th rowspan="2">Floor</th>
     <th rowspan="2">Person</th>
     <th colspan="2">Create Schedule</th>
     <th rowspan="2"> Status</th>
  </tr>
  <tr class="head">
     <th>Start</th>
     <th>Finish</th>
  </tr>
<?php	  
 do { 
	$nomer 	= $nomer+1;		 		 
	$status = $result['status'];		 
	$no 	= md5($result['no']);?>
    <tr class="isi" height="21" >
      <td align="center"><?php if($jml_row > 0 ){ echo $nomer; }?></td>
      <td align="left"><?php echo $result['kontraktor']; ?></td>
      <td align="center"><a href = "user_detail.php?no_id=<?php echo md5($result['no_id']);?>">
	  <?php echo $result['no_id']; ?></a></td>            
      <td align="left"><?php echo $result['job_des']; ?></td>
      <td align="center"><?php echo $result['lantai']; ?></td>
      <td align="center"><?php echo $result['qop']; ?></td>
      <td align="center" nowrap="nowrap"><?php echo $result['mulai']; ?></td>
      <td align="center" nowrap="nowrap"><?php echo $result['selesai']; ?></td>
      <td align="center" ><?php if ($status == 'Waiting') { echo "<a href = 'p_reg.php?no=$no'>$status</a>";} else 
	  { echo "<font color = 'blue'>$status</font>";} ?></td>
     </tr>
     <?php } while ($result = mysql_fetch_assoc($sql_query)); ?>
     <tr>
       <td colspan="10" class="isi">&nbsp;</td>
     </tr>
</table>
<?php include('bawah.php');?>
