<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
require_once('Connections/konek.php');
$Sql 		= "SELECT a.*, b.nama FROM $tb_reg a, tb_user b where a.selesai >= $now and a.status = 'App' and a.no_id != '' and a.no_id = b.no_id ORDER BY a.no DESC ";
$sql_query 	= mysql_query($Sql, $konek) Or die(mysql_error());
$result 	= mysql_fetch_assoc($sql_query);	
$jml_row 	= mysql_num_rows($sql_query);	

$updateSQL 	= "UPDATE $tb_reg SET status = 'expired' WHERE (status ='Waiting' or status ='App') and selesai < $now" ;
$Result1 	= mysql_query($updateSQL, $konek) or die(mysql_error());
?>
<?php 
$judul 		= "Create List";
$title 		= "$judul";
$refresh 	= "370";
include('doctype.php');

?>
<link href="css/utama.css" rel="stylesheet" type="text/css" />


<?php
include("atas.php"); 
?>
<table width="100%" border="1" align="center" cellpadding="1" cellspacing="0" >
<tr class = "head">
<th rowspan="2" >No</th>
<th rowspan="2">Contractor</th>
<th rowspan="2"> In Charge</th>
<th rowspan="2">Job Description</th>
<th rowspan="2">Floor</th>
<th rowspan="2">Person</th>
<th colspan="2">Create Schedule</th>
<th rowspan="2">Action</th>
</tr>
<tr class="head">
<th align="center">Start</th>
<th align="center">Finish</th>
</tr>
<?php do { 
$nomer 	= $nomer+1;
$nama	= $result['nama'];
$vendor	= $result['kontraktor'];
$rkerja = $result['job_des'];
$lantai = $result['lantai'];
if (preg_match('/^.{1,15}\b/s',$nama, $kon)){
	$cnama=$kon[0];
}

if (preg_match('/^.{1,21}\b/s',$vendor, $kon)){
	$tvendor=$kon[0];
}

if (preg_match('/^.{1,51}\b/s',$rkerja, $match)){
	$jobdes = $match[0];
}

if (preg_match('/^.{1,10}\b/s',$lantai, $match)){
			 $clantai = $match[0];
			}
			
$ljobdes = strlen(trim($result['job_des']));
if ($ljobdes <= 51){
	$tjobdes = $jobdes;
}else{
	$tjobdes = $jobdes.'...';
}
?>
<tr class = "isi" height="23">
<td align="center"><?php if($jml_row > 0 ){ echo $nomer; }?></td>
<td align="left"><?php echo $tvendor; ?></td>
<td align="left"><a href = "user_detail.php?no_id=<?php echo md5($result['no_id']);?>"><?php echo ucwords(strtolower($cnama)); ?></a></td>
<td align="left"><?php echo "$tjobdes"; ?></td>
<td align="center"><?php echo $clantai; ?></td>
<td align="center"><?php echo $result['qop']; ?></td>
<td align="center" nowrap="nowrap"><?php if($jml_row > 0 ){echo date('d M Y',strtotime($result['mulai']));} ?></td>
<td align="center" nowrap="nowrap"><?php if($jml_row > 0 ){echo date('d M Y',strtotime($result['selesai']));} ?></td>
<td align="center" ><a href = "create_wp.php?no=<?php echo md5($result['no']);?>">
<?php if($jml_row > 0 ){ echo 'Create'; }?>
</a></td>
</tr>
<?php } while ($result = mysql_fetch_assoc($sql_query)); ?>
<tr class="isi">
<td colspan="9">&nbsp;</td>
</tr>
</table>
<?php include('bawah.php');?>
