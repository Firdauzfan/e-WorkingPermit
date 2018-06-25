<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php'); 
if ($s_bagian != 'Admin'){header('Location: '.'login.php');}
require_once('Connections/konek.php'); 

if (isset($_GET["cari"])){
	$cari 	= $_GET["cari"];	 
	if(strtolower($cari) == 'edit'){	
		$sql 	= "SELECT * FROM tb_user where salah >= 3 and bagian = 'Departement' ORDER BY `bagian` ASC ";		
	}else{
		$sql 	= "SELECT * FROM tb_user where (no_id like '%$cari%' or nama like '%$cari%' or bagian like '%$cari%' or status like '$cari%' or telp like '%$cari%' or email like '%$cari%' )  and bagian = 'Departement' and (status = 'Aktif' or status = 'Nonaktif' or status = 'Waiting')  ORDER BY `no` DESC";
	}
} else{		
	$sql 	= "SELECT * FROM tb_user where bagian = 'Departement' and (status = 'Aktif' or status = 'Nonaktif' or status = 'Waiting') ORDER BY `no` DESC";		
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
$judul 		= "Departement In charge List";
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
    <th>Title</th>    
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
				  $title = ucwords($result['title']); 	
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
    <td align="center"><a href = "user_detail.php?no_id=<?php echo md5($result['no_id']); ?>"><?php echo $result['no_id'];?></a></td>
    <td><?php echo $cnama; ?></td>
    <td><?php echo $ctitle; ?></td>    
    <td><?php echo "<a href = 'mailto:$email'>$email</a>"; ?></td>
    <td><?php echo $result['telp']; ?></td>   
	<td><?php if($jml_row > 0 ){ echo  $cLokasi; }?></td>
    <td align="center"><a href = "p_status.php?no_id=<?php echo $result['no_id']; ?>&link=<?php echo $c_page; ?>"><?php echo ucwords($result['status']);?></a></td>
    <td align="center"><?php if ($salah >= 3 ) { echo "<a href = 'user_edit_adm.php?no_id=$no_id'>Edit</a>";}else if($jml_row > 0 ){ echo  '-'; } else { echo  ''; } ?></td>
  </tr>
  <?php } while ($result = mysql_fetch_assoc($sql_query)); ?>
  <tr class="isi">
    <td colspan="9" align="right">&nbsp;
      <?php  include ('paging.php'); ?></td>
  </tr>
</table>
<?php include('bawahc.php');?>

