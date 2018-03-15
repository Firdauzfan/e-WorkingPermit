<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php');

if ($s_bagian == "Security"){
	$app_id = "approve_st";
}
if($s_bagian == "Facility Management"){
	$app_id = "approve_fm";
}
if($s_bagian == "Maintenance"){
	$app_id = "approve_mt";
}
if ($s_bagian == "In Building"){
	$app_id = "approve_ib";
}   
	
    $sql 		=  "SELECT * FROM $tb_wp WHERE $app_id = '-'  and 
	(tgl1 >= $now or tgl2 >= $now or tgl3 >= $now or tgl4 >= $now or tgl5 >= $now or tgl6 >= $now or tgl7 >= $now or tgl8 >= $now) and sts ='Yes'";
	
	$sql_query 	= mysql_query($sql, $konek) or die(mysql_error());
	$result 	= mysql_fetch_assoc($sql_query);
	$jml_row 	= mysql_num_rows($sql_query);
?>
<?php 
$judul = "Working Permit List Approve";
$title = "$judul";
include('doctype.php');
?>
<link href="css/utama.css" rel="stylesheet" type="text/css" />
<?php
include("atas.php"); 
?>
<Table Width="100%" Border="1" cellpadding="1" cellspacing="0" >
          <tr></tr>
          <tr class="head">
            <th rowspan="2">No</th>           
            <th colspan="2">Date</th>            
            <th rowspan="2">Contractor</th>
            <th rowspan="2">Job Description</th>
            <th rowspan="2">Floor</th>
            <th colspan="6" >Approve Status</th>
          </tr>
          <tr class="head">
            <th>Start</th>
            <th>Finish</th>            
            <th>IB</th>
            <th>FM</th>
            <th>MT</th>
            <th>ST</th>
            <th>Action</th>            
          </tr>
          <?php	do { 
		  $nomer =$nomer+1; 				   
		  $tgl1 = $result['tgl1'];
		  $tgl2 = $result['tgl2'];
		  $tgl3 = $result['tgl3'];
		  $tgl4 = $result['tgl4'];
		  $tgl5 = $result['tgl5'];
		  $tgl6 = $result['tgl6'];
		  $tgl7 = $result['tgl7'];
		  $tgl8 = $result['tgl8'];		  
          include ("tgl.php");
		  
		  $kont 	= ucwords($result['kontraktor']);
		  $jp 		= ucwords(substr($result['jns_pekerjaan'],0,30));
		  $lantai 	= $result['lantai'];		
		  $ib 		= $result['approve_ib'];
		  $fm 		= $result['approve_fm'];
		  $mt 		= $result['approve_mt'];
		  $st 		= $result['approve_st'];
		  ?>
          <tr height="21" class="isi">
            <td><?php if($jml_row > 0 ){ echo $nomer; }?></td>          
            <td nowrap="nowrap"><?php echo $mulai; ?></td>
            <td nowrap="nowrap"><?php echo $selesai; ?></td>            
            <td align="left"><?php echo $kont ?></td>
            <td align="left"><?php echo $jp;?></td>
            <td><?php echo $lantai; ?></td>           
            <td><?php echo $ib; ?></td>
            <td><?php echo $fm; ?></td>
            <td><?php echo $mt; ?></td>
            <td><?php echo $st; ?></td>            
            <td class="isi" ><a href = "wp_app.php?no_wp=<?php echo md5($result['no_wp']); ?>">
			<?php if ($jml_row > 0 ) { echo "Approve";} ?></a></td>
          </tr>
          <?php } while ($result = mysql_fetch_assoc($sql_query)); ?>
          <tr>
            <td  class="isi" colspan="11">&nbsp;</td>
          </tr>
        </table>
        <?php include('bawah.php');?>
