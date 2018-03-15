<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php'); 
if ($s_bagian != 'Admin'){header('Location: '.'login.php');}
require_once('Connections/konek.php'); 

if (isset($_GET["cari"])){
	$cari 	= $_GET["cari"];
	if(strtolower($cari) == 'edit'){
		if($s_lokasi == 1){
			$sql = "SELECT * FROM tb_user where salah > 2 and bagian != 'Departement' ORDER BY `nama` ASC ";	
		}else{
			$sql = "SELECT * FROM tb_user where salah > 2 and bagian != 'Departement' and lokasi = '$s_lokasi'
			ORDER BY `nama` ASC ";
		}
	}else{
		if($s_lokasi == 1){
			$sql = "SELECT * FROM tb_user where (no_id like '%$cari%' or nama like '%$cari%' or telp like '%$cari%' or
			bagian like '%$cari%' or status like '$cari%')  and bagian != 'Departement' and no_id != '12078212' and 
			(status = 'Aktif' or status = 'Nonaktif') ORDER BY `nama` ASC ";
		}else{
			$sql = "SELECT * FROM tb_user where (no_id like '%$cari%' or nama like '%$cari%' or telp like '%$cari%' or
			bagian like '%$cari%' or status like '$cari%')  and bagian != 'Departement' and no_id != '12078212' and 
			(status = 'Aktif' or status = 'Nonaktif') and lokasi = '$s_lokasi' ORDER BY `nama` ASC ";
		}
	}
}else{	
	if($s_lokasi == 1){
		$sql 	= "SELECT * FROM tb_user where bagian != 'Departement' and no_id != '12078212' and 
		(status = 'Aktif' or status = 'Nonaktif') ORDER BY `lokasi` ASC";	
	}else{
		$sql 	= "SELECT * FROM tb_user where bagian != 'Departement' and no_id != '12078212' and 
		(status = 'Aktif' or status = 'Nonaktif') and lokasi = '$s_lokasi' ORDER BY `nama` ASC";
	}	
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
$judul 		= "User List";
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
  $c_page .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
?>
<table width="100%" border="1" cellpadding="1" cellspacing="0">
  <tr class="head" height="30" >
    <th>No</th>
    <th>No ID</th>
    <th>Name</th>   
    <th>Login Status</th>
    <th>Email</th>
    <th>Phone</th>
	<th>Register in</th>
    <th>Status</th>
    <th>Edit</th>
  </tr>
  <?php	
	  
	  do { ?>
  <?php 
			  	  $nomer = $nomer+1;
				  $salah = $result['salah'];
				  $no_id = $result['no_id'];
				  $email = strtolower($result['email']);
				  $nama  = ucwords(strtolower($result['nama']));
				  $nLokasi = $result['lokasi'];
				  include('lokasi.php');	 		
				
				if (preg_match('/^.{1,21}\b/s',$nama, $kon)){
					$cnama=$kon[0];
				}
				if (preg_match('/^.{1,21}\b/s',$title, $kon)){
					$ctitle=$kon[0];
				}				
				
				?>
  <tr class="isik" height="21" >
    <td align="center"><?php if($jml_row > 0 ){ echo  $nomer; }?></td>
    <td align="center"><a href = "user_detail.php?no_id=<?php echo md5($result['no_id']); ?>"> <?php echo $result['no_id'];?></a></td>
    <td><?php echo $cnama; ?></td>   
    <td><?php echo ucwords($result['bagian']); ?></td>
    <td><?php echo "<a href = 'mailto:$email'>$email</a>"; ?></td>
    <td><?php echo $result['telp']; ?></td>
	<td><?php echo $cLokasi; ?></td>
    <td align="center"><a href = "p_status.php?no_id=<?php echo $result['no_id']; ?>&link=<?php echo $c_page; ?>"><?php echo ucwords($result['status']);?></a></td>
    <td align="center"><?php if ($salah >= 3 ) { echo "<a href = 'user_edit_adm.php?no_id=$no_id'>Edit</a>";}
				else if($jml_row > 0 ){ echo  '-'; } else { echo  ''; } ?></td>
  </tr>
  <?php } while ($result = mysql_fetch_assoc($sql_query)); ?>
  <tr class="isi">
    <td colspan="10" align="right">&nbsp;
      <?php  include ('paging.php'); ?></td>
  </tr>
</table>
<?php include('bawahc.php');?>

