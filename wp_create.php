<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
require_once('Connections/konek.php'); 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if (isset( $_GET['no'])){
$no 		= $_GET['no'];
$sql 		= "SELECT * FROM `$tb_reg` WHERE `no` = $no";
$sqlquery 	= mysql_query($sql,$konek) or die(mysql_error());
$hasil_reg 	= mysql_fetch_assoc($sqlquery);

if ($hasil_reg){
	$no_id 		= $hasil_reg['no_id'];
	$noreg 		= $hasil_reg['no_reg'];	
	$kontraktor = $hasil_reg['kontraktor'];
	$job_des 	= $hasil_reg['job_des'];
	$qop 		= $hasil_reg['qop'];	
	$lantai 	= $hasil_reg['lantai'];
	
$query_user 	= "SELECT * FROM  tb_user where no_id = $no_id";
$user_cari 		= mysql_query($query_user, $konek) or die(mysql_error());
$hasil_user 	= mysql_fetch_assoc($user_cari);

if ($hasil_user){
	$nama 			= $hasil_user['nama'];
	$departement 	= $hasil_user['departement'];
	$telp 			= $hasil_user['telp'];	
}}}
/*
if ($noreg != $no_reg){
die ("Nomer register anda salah <a href='javascript:history.back(1)'>Back</a>");}

//upload Photo
$fileName = $_FILES['upload']['name'];  
$fileSize = $_FILES['upload']['size'];
$tmpName  = $_FILES['upload']['tmp_name'];
$fileType = $_FILES['upload']['type'];
$uploadDir = 'poto/';
$unikName = date('ynzHis');
$uploadfile = $uploadDir.$unikName.$fileName;
$photo = $uploadfile;
$typefile = substr($fileType,0,5);

if ( $fileSize == 0)
 	{die ("Silakan Masukan Photo <a href='javascript:history.back(1)'>Back</a>");}
if ($typefile != 'image') 
	{die ("File yang anda masukan salah <a href='javascript:history.back(1)'>Back</a>");} 
	$upload = move_uploaded_file($tmpName, $uploadfile);
if (!$upload) {die (" File gagal diupload");}
//nomor urut
*/
$query_rec_wp_input = "SELECT max(no_wp) as num FROM $tb_wp";
$rec_wp_input = mysql_query($query_rec_wp_input, $konek) or die(mysql_error());
$row_rec_wp_input = mysql_fetch_assoc($rec_wp_input);
$totalRows_rec_wp_input = mysql_num_rows($rec_wp_input);
$jml = $row_rec_wp_input['num']+1;
$trek = str_repeat('0',5 - strlen($jml)).$jml; 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Create Working Permit</title>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type="text/javascript">
<!--
function poto(){
document.getElementById("img").src = "C:\\camp\\bae\\capture.bmp";
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.eng {font-style: italic;
	font-family: "MS Serif", "New York", serif;
	font-size: 10px;
	color: #666;
}
.grs {text-decoration: underline;
	font-family: "MS Serif", "New York", serif;
	font-size: 14px;
}
.jdl {color: #963;
	font-family: "MS Serif", "New York", serif;
	font-size: 16px;
	font-style: normal;
	font-weight: bold;
	text-transform: uppercase;
	text-decoration: underline;
}
#jd {color: #F00;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 36px;
}
-->
</style>
</head>

<body  onload="MM_preloadImages('img/t_home1.jpg','img/t_Workingpermit1.jpg','img/t_contact1.jpg','img/t_download1.jpg','img/t_backa.jpg')">

<table width="980" align="center" cellpadding="0" cellspacing="0" >
   <tr>
  <td align="center"><table width="100%" cellpadding="0">
    <tr>
      <td><?php include('header.php'); ?></td>
    </tr>
    <tr>
      <td align="right"  background="img/tab_menu.jpg"><a href="javascript:history.back(1)" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','img/t_backa.jpg',1)"><img src="img/t_back.jpg" alt="Back" name="Image3" width="66" height="40" border="0" id="Image3" /></a></td>
    </tr>
  </table></td>  
  </tr>  
 
   <tr>
    <td><form method="post" enctype="multipart/form-data" name="form1" id="form1" action="p_wp_save.php">
    
      <table width="975" border="0" align="center" cellpadding="0" cellspacing="1">
        <tr>
          <td colspan="13" align="left" valign="bottom" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><span id="sprytextfield1">
                <label>
                  REGISTRATION NUMBER : <input type="text" name="no_reg2" id="no_reg" />
                </label>
                <span class="textfieldRequiredMsg">A value is required.</span></span></td>
              <td align="right" valign="bottom"><label> NO WP :
                <input name="no_wp" type="text" id="no_wp" size="6" readonly="readonly" value="<?php echo $trek; ?>"  />
              </label></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="2" bgcolor="#0000FF"colspan="13"></td>
        </tr>
        <tr>
          <td colspan="3" ><u class="grs">GEDUNG</u><br />
            <em class="eng">BUILDING</em></td>
          <td colspan="3" >:
            <label>
              <input name="gedung" type="text" id="gedung" value="PT Graha Sumber Prima Elektronik" size="12" readonly="readonly" />
            </label></td>
          <td width="132" colspan="-1" >&nbsp;</td>
          <td width="155" ><u class="grs">LANTAI</u><br />
            <span class="eng"><em>FLOOR</em></span></td>
          <td colspan="3" align="left">:
            <input name="lantai" type="text" id="lantai" size="7" readonly="readonly" value="<?php echo $lantai; ?>" /></td>
          <td width="141" align="right">STATUS</td>
          <td width="180" align="right"><label> :
            
              <select name="status" id="status">
                <option>Baru</option>
                <option>Perpanjang</option>
                <option>Maintenance</option>
                <option>Lain-lain</option>
              </select>
          </label></td>
        </tr>
        <tr>
          <td colspan="5" bgcolor="#CCCCCC"><span class="jdl">KONTRAKTOR</span><br />
            <em class="eng">CONTRACTOR&nbsp;</em></td>
          <td colspan="8" bgcolor="#CCCCCC"><em class="eng">
            <input name="kontraktor" type="text" id="kontraktor" size="35" value="<?php echo $kontraktor; ?>"/>
          </em></td>
        </tr>
        <tr>
          <td width="24">&nbsp;</td>
          <td width="37">A.</td>
          <td colspan="2"><span class="grs">NAMA</span><br />
            <em class="eng">NAME </em></td>
          <td width="114">&nbsp;</td>
          <td colspan="3"><span id="sprytextfield2">
            <label>
              <input name="nama_kontraktor" type="text" id="nama_kontraktor" size="25" />
            </label>
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          <td colspan="2" rowspan="4" align="center" valign="middle"><span class="jdl"><img src="$photo" alt="Photo"  name="img" width="108" height="135" border="2" id="img" /></span></td>
          <td colspan="3" rowspan="7" align="center" valign="top" bgcolor="#CCCCCC"><?php include("kalender.php");?></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="3"><span class="grs">TELP / NO. HP<br />
          </span><span class="eng">PHONE </span></td>
          <td colspan="3"><label>
            <input name="telp_kontraktor" type="text" id="telp_kontraktor" size="15" value="<?php echo $telp_kontraktor; ?>" />
          </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>C.</td>
          <td colspan="3"><span class="grs">JUMLAH ORANG</span><br />
            <span class="eng">QUANTITY OF PERSON</span></td>
          <td colspan="3"><label>
            <input name="jml_orang" type="text" id="jml_orang" size="7" value="<?php echo $qop; ?>"/>
            Orang </label></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>D.</td>
          <td colspan="3"><span class="grs">JENIS PEKERJAAN</span><br />
            <span class="eng">JOB DESCRIPTION</span></td>
          <td colspan="3"><label>
            <textarea name="jns_pekerjaan" cols="35" rows="3" id="jns_pekerjaan"><?php echo $job_des; ?></textarea>
          </label></td>
        </tr>
        <tr>
          <td colspan="5" bgcolor="#CCCCCC" class="jdl">DEPARTMENT INCHARGE</td>
          <td colspan="3" bgcolor="#CCCCCC" class="jdl"><input name="dept_incharge" type="text" id="dept_incharge" value="<?php echo strtoupper($departement); ?>" size="30" readonly="readonly" /></td>
          <td colspan="2" align="center" bgcolor="#CCCCCC" class="jdl"><input name="upload" type="button" id="upload" onclick="poto()" value="Photo"/></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>A.</td>
          <td colspan="3"><span class="grs">NAMA</span><br />
            <em class="eng">NAME</em></td>
          <td colspan="3"><label>
            <input name="nama_dept" type="text" id="nama_dept" value="<?php echo ucwords($nama); ?>" size="25" readonly="readonly" />
          </label></td>
          <td width="11">&nbsp;</td>
          <td width="103" align="center" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="3"><span class="grs">NOMER ID</span><br />
            <span class="eng">ID NUMBER</span></td>
          <td colspan="3"><label>
            <input name="no_id" type="text" id="no_id" value="<?php echo $no_id; ?>" size="10" readonly="readonly" />
          </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>C.</td>
          <td colspan="3"><span class="grs">TELP / NO. HP<br />
          </span><span class="eng">PHONE </span></td>
          <td colspan="3"><label>
            <input name="telp_dept" type="text" id="telp_dept" value="<?php echo $telp; ?>" size="15" readonly="readonly" />
          </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td colspan="3" align="center" valign="top" bgcolor="#CCCCCC">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="13" bgcolor="#CCCCCC"><span class="grs"><span class="jdl">JADWAL   KERJA</span></span><br />
            <span class="eng">WORKING SCHEDULE</span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>A.</td>
          <td colspan="3"><span class="grs">TANGGAL</span><br />
            <span class="eng">DATE</span></td>
          <td colspan="3"><input name="tgl_mulai" type="text" id="tgl_mulai" value= "<?php echo $mulai; ?>" size="10" readonly="readonly" />
            s.d
            <input name="tgl_selesai" type="text" id="tgl_selesai" value= "<?php echo $selesai; ?>" size="10" readonly="readonly" /></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td colspan="3" align="center" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="3"><span class="grs">JAM</span><br />
            <span class="eng">TIME</span></td>
          <td colspan="3"><label>
            <input name="jam_mulai" type="text" id="jam_mulai" size="10" maxlength="8" readonly="readonly" value= "<?php echo $jamm; ?>" />
            s.d
            <input name="jam_selesai" type="text" id="jam_selesai" size="10" readonly="readonly" value="<?php echo $jams; ?>" />
          </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          <td colspan="3" align="center" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="13" align="right" bgcolor="#CCCCCC"><input type="submit" name="submit" id="submit" value="Save" /></td>
        </tr>
      </table>     
        <input type="hidden" name="MM_insert" value="form1" />
        <input type="hidden" name="tgl1" value="<?php echo $tgl1; ?>" />
        <input type="hidden" name="tgl2" value="<?php echo $tgl2; ?>" />
        <input type="hidden" name="tgl3" value="<?php echo $tgl3; ?>" />
        <input type="hidden" name="tgl4" value="<?php echo $tgl4; ?>" />
        <input type="hidden" name="tgl5" value="<?php echo $tgl5; ?>" />
        <input type="hidden" name="tgl6" value="<?php echo $tgl6; ?>" />
        <input type="hidden" name="tgl7" value="<?php echo $tgl7; ?>" />
        <input type="hidden" name="no_reg" value="<?php echo $no_reg; ?>" />
        <input type="hidden" name="photo" value="<?php echo $photo; ?>" />  
</form>
</td>
  </tr>
  <tr>
    <td><?php include("foot.php"); ?></td>
  </tr>
</table>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
//-->
</script>
</body>
</html>
