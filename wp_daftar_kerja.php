<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
require_once('Connections/konek.php'); 
include('page.php');
$sql 			= "SELECT * FROM $tb_wp where (approve_ib = 'App' or approve_ib = 'No') and approve_fm = 'App' and  approve_mt = 'App' and  approve_st = 'App' and  (`tgl1` = '$now' or `tgl2` = '$now' or `tgl3` = '$now' or `tgl4` = '$now' or `tgl5` = '$now' or `tgl6` = '$now' or `tgl7` = '$now' or `tgl8` = '$now' ) and sts ='Yes' ORDER BY `no_wp` DESC ";
$query_limit 	= sprintf("%s LIMIT %d, %d", $sql, $startRow, $maxRows);
$sql_query 		= mysql_query($query_limit, $konek) or die(mysql_error());
$hasil  		= mysql_fetch_assoc($sql_query);

$sql_query_jml 	= mysql_query($sql, $konek) or die(mysql_error());
$jml_row 		= mysql_num_rows($sql_query_jml);
$total_pages 	= ceil($jml_row / $maxRows);


$judul 		= "Working Permit List";
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
			<th rowspan="2">Dept In charge</th> 			
            <th rowspan="2">Job Description</th>
            <th rowspan="2">Floor</th>
            <th rowspan="2">Person</th>   
            <th colspan="2">Time</th>
            <th colspan="2">Date</th>
            <th rowspan="2">Action</th>               
          </tr>
          <tr class="head">
            <th>Start</th>
            <th>Finish</th>
            <th>Start</th>
            <th>Finish</th>            
          </tr>
          <?php		  
	  do { ?>
          <?php 
		  $nomer 		= $nomer+1; 		  
		  $now 			= gmdate('H:i:s',time()+60*60*7);	
		  //jam
		  $jamm 		= $hasil['jam_mulai'];
		  $jams 		= $hasil['jam_selesai']; 		  
		  $jam_mulai 	= substr($jamm,0,5);
		  $jam_selesai 	= substr($jams,0,5);	
		  $jammm 		= substr($jamm,0,2);
		  $jamss 		= substr($jams,0,2);
		  //menit 
		  $menitm 		= substr($jamm,3,2);
		  $menits 		= substr($jams,3,2);
		  $menitn 		= substr($now,3,2);	
		  //selisih 		  
		  $selisihjam 	= $jamm - $now;
		  $selisihmenit = $menitm - $menitn;		  
		  $tgl1 		= $hasil['tgl1'];
		  $tgl2 		= $hasil['tgl2'];
		  $tgl3 		= $hasil['tgl3'];
		  $tgl4 		= $hasil['tgl4'];
		  $tgl5 		= $hasil['tgl5'];
		  $tgl6 		= $hasil['tgl6'];
		  $tgl7 		= $hasil['tgl7'];	
		  $tgl8 		= $hasil['tgl8'];	
          include ('tgl.php');
		  		 
			echo"<tr>";
			if ($jamm < $jams) {
				if ($jamm > $now or $jams < $now)					
				{echo"<tr bgcolor='#FFFF9'>";}}		
				
			if ($jamm > $jams) {	
				if ($jams < $now and $jamm > $now)					
				{echo"<tr bgcolor='#FFFF9'>";}}				
			
			 if ($jammm == $jamss and $menitm == $menits)
			 	{echo"<tr>";}				
				
			$rkerja 	= $hasil['jns_pekerjaan'];
			$vendor		= $hasil['kontraktor'];
			$incharge 	= $hasil['nama_dept'];
			$lantai		= $hasil['lantai'];

			if (preg_match('/^.{1,21}\b/s',$vendor, $kon)){
			 $lvendor=$kon[0];
			}
			if (preg_match('/^.{1,17}\b/s',$incharge, $kon)){
			 $lincharge=$kon[0];
			}

			if (preg_match('/^.{1,31}\b/s',$rkerja, $match)){
			 $jobdes = $match[0];
			}
			
			if (preg_match('/^.{1,10}\b/s',$lantai, $match)){
			 $clantai = $match[0];
			}
			
			$ljobdes = strlen($hasil['jns_pekerjaan']);
			if ($ljobdes < 31){
			$tjobdes = $jobdes;
			}else{
			$tjobdes = $jobdes.'...';
			}
		   ?>	      
            <td class="isi" height="21"><?php if($jml_row > 0 ){ echo  $nomer; }?></td>              
            <td class="isik"><?php echo strtoupper($lvendor); ?></td>   
			<td class="isik"><?php echo ucwords(strtolower($lincharge)); ?></td>      			
            <td class="isik"><?php echo ucwords($tjobdes);?></td>
            <td class="isi"><?php echo $clantai; ?></td>   
            <td class="isi"><?php echo $hasil['jml_orang']; ?></td>   
			<td class="isi"><?php echo $jam_mulai; ?></td>
            <td class="isi"><?php echo $jam_selesai; ?></td>  
            <td nowrap="nowrap" class="isi"><?php if($jml_row > 0 ){echo date('d M Y',strtotime($mulai));} ?></td>
            <td nowrap="nowrap" class="isi"><?php if($jml_row > 0 ){echo date('d M Y',strtotime($selesai));} ?></td>            
            <td class="isi" ><a href = "wp_detail.php?no_wp=<?php echo md5($hasil['no_wp']); ?>">
			<?php if ($jml_row > 0 ) { echo "Detail";} ?></a></td>             
          </tr>
          <?php } while ($hasil = mysql_fetch_assoc($sql_query)); ?>
          <tr>
            <td class="isi" colspan="11">&nbsp;</td>
          </tr>
        </table>
<?php include('bawah.php');?>
