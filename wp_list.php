<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php'); 
if ($s_bagian != 'Admin' and $s_bagian != 'Facility Management'){header('Location: '.'login.php');}

if (isset($_GET["cari"])){
	$cari 	= $_GET["cari"];	
	$sql 	= "SELECT * FROM $tb_wp where no_id like '%$cari%' or kontraktor like '%$cari%' or
	nama_kontraktor like '%$cari%' or nama_dept like '%$cari%' ORDER BY `no_wp` ASC ";	
} else{		
	$sql 	= "SELECT * FROM $tb_wp  ORDER BY `no_wp` DESC ";	
}
include('page.php');
$query_limit 	= sprintf("%s LIMIT %d, %d", $sql, $startRow, $maxRows);
$sql_query 		= mysql_query($query_limit, $konek) or die(mysql_error());
$sql_query_jml 	= mysql_query($sql, $konek) or die(mysql_error());
$result 		= mysql_fetch_assoc($sql_query);
	
$jml_row 		= mysql_num_rows($sql_query_jml);
$total_pages 	= ceil($jml_row / $maxRows);

?>
<?php 
$judul 		= "Working Permit List";
$title 		= "$judul";
include('doctype.php');
include('cssjs.php');
?>
<script type="text/javascript">
      $(document).ready(function() {
		  $("#cari").focus();
  	    $(':input:not([type="submit"]):not([type="reset"])').each(function() {
	        $(this).focus(function() {
	            $(this).addClass('hilite');
	        }).blur(function() {
	            $(this).removeClass('hilite');});
	     });
      });    
</script>
<?php 
include('atasc.php'); 
$c_page = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $c_page .= "?" . htmlspecialchars($_SERVER['QUERY_STRING']);
  $a = str_replace("&","~",$c_page);
}
?>
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
  <tr class="head">
    <th rowspan="2">No</th>
    <th rowspan="2">No WP</th>
    <th colspan="2">Date</th>    
    <th rowspan="2">Contractor</th>
    <th rowspan="2">Vendor Name</th>
    <th rowspan="2">In charge</th>    
    <th rowspan="2">Floor</th>
    <th colspan="4">Approve Status</th>
    <th colspan="2">View</th>
  </tr>
  <tr class="head">
    <th>Start</th>
    <th>Finish</th>
    <th>IB</th>
    <th>FM</th>
    <th>MT</th>
    <th>ST</th>
    <th>Detail</th>
    <th>View</th>
  </tr>
<?php do { 
		  $nomer 	= $nomer+1; 
		  $sts 		= $result['sts'];
		  $tgl1 	= $result['tgl1'];
		  $tgl2 	= $result['tgl2'];
		  $tgl3 	= $result['tgl3'];
		  $tgl4 	= $result['tgl4'];
		  $tgl5 	= $result['tgl5'];
		  $tgl6 	= $result['tgl6'];
		  $tgl7 	= $result['tgl7'];	
		  $tgl8 	= $result['tgl8'];	
		  include('tgl.php');
		  $vendor	= strtoupper($result['kontraktor']);
		  $incharge	= ucwords(strtolower($result['nama_dept']));
		  $lantai	= $result['lantai'];
		  $nama_vdr	= ucwords(strtolower($result['nama_kontraktor']));

		if (preg_match('/^.{1,21}\b/s',$vendor, $kon)){
			$cVendor=$kon[0];
		}		
		if (preg_match('/^.{1,17}\b/s',$incharge, $kon)){
			$cIncharge=$kon[0];
		}		
		if (preg_match('/^.{1,15}\b/s',$nama_vdr, $kon)){
			$cNama_vdr=$kon[0];
		}		
		if (preg_match('/^.{1,10}\b/s',$lantai, $kon)){
			$cLantai=$kon[0];
		}

?>
  <tr class="isi">
    <td height="21"><?php if($jml_row > 0 ){ echo $nomer; }?></td>
    <td><?php echo $result['no_wp']; ?></td>
    <td nowrap="nowrap"><?php echo $mulai; ?></td>
    <td nowrap="nowrap"><?php echo $selesai; ?></td>
    <td align="left"><?php echo $cVendor ; ?></td>
    <td align="left"><?php echo $cNama_vdr; ?></td>
    <td align="left"><?php echo $cIncharge; ?></td>    
    <td><?php echo $cLantai; ?></td>    
    <td><?php echo $result['approve_ib']; ?></td>
    <td><?php echo $result['approve_fm']; ?></td>
    <td><?php echo $result['approve_mt']; ?></td>
    <td><?php echo $result['approve_st']; ?></td>
    <td><a href = "wp_detail.php?no_wp=<?php echo md5($result['no_wp']); ?>">
    <?php if($jml_row > 0 ){ echo 'Detail'; }?></a></td>
    <td><a href = "p_yesno.php?no_wp=<?php echo $result['no_wp']; ?>&link=<?php echo $a;?>">
	<?php echo $sts;?></a></td>
  </tr>
  <?php } while ($result = mysql_fetch_assoc($sql_query)); ?>
  <tr>
    <td colspan="14">&nbsp;<?php  include ('paging.php'); ?></td>
  </tr>
</table>
<?php include('bawahc.php'); ?>

