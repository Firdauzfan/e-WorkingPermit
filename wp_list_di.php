<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php'); 
if ($s_bagian == 'Maintenance' or $s_bagian == 'Security'){header('Location: '.'login.php');}
include('page.php');
$sql 			= "SELECT * FROM $tb_wp where  no_id = '$s_userid' ORDER BY no_wp DESC";
$query_limit 	= sprintf("%s LIMIT %d, %d", $sql, $startRow, $maxRows);
$sql_query 		= mysql_query($query_limit, $konek) or die(mysql_error());
$result 		= mysql_fetch_assoc($sql_query);

$sql_query_jml 	= mysql_query($sql, $konek) or die(mysql_error());
$jml_row 		= mysql_num_rows($sql_query_jml);
$total_pages 	= ceil($jml_row / $maxRows);
?>
<?php 
$judul = "Working Permit List";
$title = "$judul";
include('doctype.php');
?>
<link href="css/utama.css" rel="stylesheet" type="text/css" />
<?php
include("atas.php"); 
?>
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0" bgcolor="#FFFFFF">
  <tr></tr>
  <tr class="head">
    <th rowspan="2">No</th>
    <th rowspan="2">Contractor</th>
    <th rowspan="2">Job Description</th>
    <th rowspan="2">Floor</th>
    <th rowspan="2">Person</th>
    <th colspan="2">Time</th>
    <th colspan="2">Date</th>
    <th rowspan="2">View</th>
  </tr>
  <tr class="head">
    <th>Start</th>
    <th>Finish</th>
    <th>Start</th>
    <th>Finish</th>
  </tr>
<?php	
		do { 
		  $nomer =$nomer+1; 
		  $tgl1 = $result['tgl1'];
		  $tgl2 = $result['tgl2'];
		  $tgl3 = $result['tgl3'];
		  $tgl4 = $result['tgl4'];
		  $tgl5 = $result['tgl5'];
		  $tgl6 = $result['tgl6'];
		  $tgl7 = $result['tgl7'];
		  $tgl8 = $result['tgl8'];
		  include('tgl.php');
		  $vendor	= $result['kontraktor'];
		  $rkerja 	= $result['jns_pekerjaan'];
			if (preg_match('/^.{1,21}\b/s',$vendor, $kon)){
				$tvendor=$kon[0];
			}

			if (preg_match('/^.{1,51}\b/s',$rkerja, $match)){
				$jobdes = $match[0];
			}
						
			$ljobdes = strlen(trim($result['jns_pekerjaan']));
			if ($ljobdes <= 51){
				$tjobdes = $jobdes;
			}else{
				$tjobdes = $jobdes.'...';}
		  
		  $jamm = substr($result['jam_mulai'],0,5); 
		  $jams = substr($result['jam_selesai'],0,5);         
?>
  <tr class="isi" height="21">
    <td><?php if($jml_row > 0 ){ echo $nomer; }?></td>
    <td align="left"><?php echo strtoupper($tvendor); ?></td>
    <td align="left"><?php echo $tjobdes;?></td>
    <td><?php echo $result['lantai']; ?></td>
    <td><?php echo $result['jml_orang']; ?></td>
    <td><?php echo $jamm; ?></td>
    <td><?php echo $jams; ?></td>
    <td nowrap="nowrap"><?php echo $mulai; ?></td>
    <td nowrap="nowrap"><?php echo $selesai; ?></td>
    <td><a href = "wp_detail.php?no_wp=<?php echo md5($result['no_wp']); ?>">
    <?php if ($jml_row > 0 ) { echo "Detail";} ?></a></td>
  </tr>
  <?php } while ($result = mysql_fetch_assoc($sql_query)); ?>
  <tr>
    <td colspan="10" class="isi">&nbsp;</td>
  </tr>
</table>
<?php include('bawah.php');?>
