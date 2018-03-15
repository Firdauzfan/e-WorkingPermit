<?php
require_once('Connections/konek.php'); 
$no_id = $_GET['no_id'];

if ($no_id){
	$sql 		= "SELECT * FROM `tb_user` WHERE md5(no_id) = '$no_id'";
	$sqlquery 	= mysql_query($sql,$konek) or die(mysql_error());
	$rowe 		= mysql_fetch_assoc($sqlquery);

	if ($rowe['bagian'] == "Departement"){
		$bagian = "Department In Charge";
	}else{	
		$bagian = $rowe['bagian'];
	}
}
?>

<?php 
	$judul 		= "User Detail";
	$title 		= "$judul";
	$pesan 	    = "&nbsp;";
	include('doctype.php');
?>        
<script src="js/rollover.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.4.js"></script>
<link href="css/utama.css" rel="stylesheet" type="text/css" />
<?php include('fancy.php');?>
<?php include('atasb.php');?>
<table border="1" align="center" cellpadding="5" cellspacing="10">
      <tr>
        <td><table border="0" cellspacing="3" cellpadding="1">
          <tr>
            <td width = "100">Number ID</td>
            <td>:</td>
            <td><input type="text" value="<?php echo $rowe['no_id']; ?>" size="15" readonly /></td>
            <td rowspan="8" valign="top" width = "150"><table border="1" cellspacing="3" cellpadding="1" align ="right">
              <tr>			    
                <td>				
                <?php
                  $sql1 ="select value from tb_config where path='path'";
                  $r = mysql_query($sql1);
                  $d = mysql_fetch_array($r);
                  $path = $d['value'];
                ?>
				<img class ="classfancy" href = "<?php echo $path.'/'.$rowe['photo'];?>" src="<?php echo $path.'/'.$rowe['photo'];?>" title="<?php echo $rowe['nama']; ?>" width="133" height="152" border="1"/>
				</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" value="<?php echo ucwords(strtolower($rowe['nama'])); ?>" size="30" readonly /></td>
          </tr>
          <tr>
            <td>Department</td>
            <td>:</td>
            <td><input type="text" value="<?php echo ucwords($rowe['departement']); ?>" size="30" readonly /></td>
          </tr>
          <tr>
            <td>Email</td>
            <td>:</td>
            <td><input  type="text" value="<?php echo strtolower($rowe['email']); ?>" size="30" readonly /></td>
          </tr>
          <tr>
            <td>Phone</td>
            <td>:</td>
            <td><input type="text" value="<?php echo $rowe['telp']; ?>" size="30" readonly /></td>
          </tr>
          <tr>
            <td>Extension</td>
            <td>:</td>
            <td><input type="text" value="<?php echo $rowe['ext']; ?>" size="30" readonly /></td>
          </tr>
          <tr>
            <td>Title</td>
            <td>:</td>
            <td><input type="text" value="<?php echo ucwords($rowe['title']); ?>" size="30" readonly /></td>
          </tr>
          <tr>
            <td nowrap="nowrap">Login Status</td>
            <td>:</td>
            <td><input type="text" value="<?php echo $bagian; ?>" size="30" readonly /></td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include('bawah.php');?>
