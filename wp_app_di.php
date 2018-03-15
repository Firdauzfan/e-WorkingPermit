<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
  session_start();
  if(isset($_SESSION['MM_Username'])){
  $username = $_SESSION['MM_Username']; 
  $bagian	= $_SESSION['bagian'];}
  
  require_once('Connections/konek.php'); 
  
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 11) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

  

if (isset($_GET['no_wp'])) {
	$wp_id 		= $_GET['no_wp'];
	$sql 		= "SELECT * FROM $tb_wp WHERE `no_wp` = '$wp_id'";
	$sqlquery 	= mysql_query($sql,$konek) or die(mysql_error());
	$rowe 		= mysql_fetch_assoc($sqlquery);
	$jam1 		= $rowe['jam_mulai']; 
	$jam2 		= $rowe['jam_selesai'];
	$gamba 		= $rowe['poto'];
	$tgl1 		= $rowe['tgl1'];
	$tgl2 		= $rowe['tgl2'];
	$tgl3 		= $rowe['tgl3'];
	$tgl4 		= $rowe['tgl4'];
	$tgl5 		= $rowe['tgl5'];
	$tgl6 		= $rowe['tgl6'];
	$tgl7 		= $rowe['tgl7'];
	$tgl8 		= $rowe['tgl8'];
	include("tgl.php");
} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WP Approve</title>

<style type="text/css">
<!--
.eng {	font-style: italic;
	font-family: "MS Serif", "New York", serif;
	font-size: 10px;
	color: #666;
}
.grs {	text-decoration: underline;
	font-family: "MS Serif", "New York", serif;
	font-size: 14px;
}
.jdl {	color: #963;
	font-family: "MS Serif", "New York", serif;
	font-size: 16px;
	font-style: normal;
	font-weight: bold;
	text-transform: uppercase;
	text-decoration: underline;
}
#jd {
	color: #900;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 24px;
}
a:link {
	text-decoration: none;
	color: #F00;
}
a:visited {
	text-decoration: none;
	color: #00F;
}
a:hover {
	text-decoration: underline;
	color: #0F6;
}
a:active {
	text-decoration: none;
	color: #FF3;
}
a {
	font-family: Verdana, Geneva, sans-serif;
	font-weight: bold;
}
.appr {
	font-size: 10px;
	text-align: center;
	text-decoration: underline;
}
.appd {
	font-size: 10px;
}
.apr {
	color: #00F;
	font-weight: bold;
	text-align: center;
}
-->
</style>
<script type="text/javascript">
<!--
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
</head>

<body onload="MM_preloadImages('img/t_backa.jpg')">
<table width="980"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><table width="980" border="0">
      <tr>
        <td><?php include('header.php');?></td>
      </tr>
      <tr>
        <td align="right" valign="bottom"  background="img/tab_menu.jpg"><a href="javascript:history.back(1)" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','img/t_backa.jpg',1)"><img src="img/t_back.jpg" alt="Back" name="Image3" width="66" height="40" border="0" id="Image3" /></a>&nbsp;</td>
      </tr>
    </table></td>
    </tr>    
  <tr>
    <td><form method="POST" enctype="multipart/form-data" name="form1" id="form1">
      <table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr>
          <td colspan="14" align="left" valign="bottom" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td valign="top"><strong id="jd">E-Working Permit</strong></td>
              <td align="right" valign="bottom"><label>
                NO WP :
                    <input name="no_wp" type="text" id="no_wp" size="10" readonly="readonly" value="<?php echo $rowe['no_wp']; ?>"  />
              </label></td>
              </tr>
          </table></td>
          </tr>
        <tr>
          <td height="2" bgcolor="#0000FF"colspan="14"></td>
        </tr>
        <tr>
          <td colspan="2" ><u class="grs">GEDUNG</u><br />
            <em class="eng">BUILDING</em></td>
          <td width="111" >&nbsp;</td>
          <td colspan="4" >:
            <label>
              <input name="gedung" type="text" id="gedung" value="<?php echo $rowe['gedung']; ?>" size="12" readonly="readonly" />
            </label></td>
          <td width="35" >&nbsp;</td>
          <td width="164" ><u class="grs">LANTAI</u><br />
            <span class="eng"><em>FLOOR</em></span></td>
          <td colspan="3" align="left">:
            <input name="lantai" type="text" id="lantai" size="7" readonly="readonly" value="<?php echo $rowe['lantai']; ?>" /></td>
          <td width="84" align="right">STATUS</td>
          <td width="262" align="right"><label> 
            : 
            <input name="status" type="text" id="status" size="15" readonly="readonly" value="<?php echo $rowe['status']; ?>"/>
          </label></td>
        </tr>
        <tr>
          <td colspan="5" bgcolor="#CCCCCC"><span class="jdl">KONTRAKTOR</span><br />
            <em class="eng">CONTRACTOR&nbsp;</em></td>
          <td colspan="9" bgcolor="#CCCCCC"><em class="eng">
            <input name="kontraktor" type="text" id="kontraktor" size="30" readonly="readonly" value="<?php echo $rowe['kontraktor']; ?>"/>
          </em></td>
          </tr>
        <tr>
          <td width="28">&nbsp;</td>
          <td width="29">A.</td>
          <td colspan="2"><span class="grs">NAMA</span><br />
            <em class="eng">NAME            </em></td>
          <td width="61">&nbsp;</td>
          <td colspan="4"><input name="nama_kontraktor" type="text" id="nama_kontraktor" size="30" readonly="readonly" value="<?php echo $rowe['nama_kontraktor']; ?>"/></td>
          <td colspan="2" rowspan="4" align="center" valign="middle"><a href="<?php echo $gamba; ?>" target="_blank"><img src="<?php echo $gamba; ?>" alt="" width="100" height="120" align="middle" /></a></td>
          <td colspan="3" rowspan="11" align="center" valign="top" bgcolor="#CCCCCC"><table width="100%" bgcolor="#FFFFFF" border="1" cellspacing="2" cellpadding="2">
            <tr>
              <td colspan="2" align="center" valign="middle" class="jdl">Approve Status</td>
            </tr>
            <tr>
              <td width="50%" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td colspan="3" align="center" class="appr">KONTRAKTOR</td>
                </tr>
                <tr>
                  <td colspan="3" align="center" valign="middle"><label class="apr"><?php echo $rowe['approve_kt'];?></label></td>
                </tr>
                <tr>
                  <td width="29" class="appd">Name</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" class="appd"><?php echo ucwords($rowe['nama_kontraktor']); ?></td>
                </tr>
                <tr>
                  <td width="29" class="appd">No.ID</td>
                  <td class="appd">:</td>
                  <td align="left" class="appd"><?php echo $rowe['no_id_kt']; ?></td>
                </tr>
                <tr>
                  <td align="left" class="appd">Date &amp;Time</td>
                  <td class="appd">: </td>
                  <td align="left" class="appd"><?php echo $rowe['tgl_app_kt']; ?></td>
                </tr>
              </table></td>
              <td width="50%" align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td colspan="3" align="center" class="appr">DEPARTEMENT</td>
                </tr>
                <tr>
                  <td colspan="3" align="center" valign="middle"><label class="apr"><?php echo $rowe['approve_dt'];?></label></td>
                </tr>
                <tr>
                  <td width="29" class="appd">Name</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" class="appd"><?php echo ucwords($rowe['nama_app_dt']); ?></td>
                </tr>
                <tr>
                  <td width="29" class="appd">No.ID</td>
                  <td class="appd">:</td>
                  <td align="left" class="appd"><?php echo $rowe['no_id_dt']; ?></td>
                </tr>
                <tr>
                  <td align="left" class="appd">Date &amp;Time</td>
                  <td class="appd">: </td>
                  <td align="left" class="appd"><?php echo $rowe['tgl_app_dt']; ?></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td colspan="3" align="center" class="appr">IN BUILDING</td>
                </tr>
                <tr>
                  <td colspan="3" align="center" valign="middle"><label class="apr"><?php echo $rowe['approve_ib'];?></label></td>
                </tr>
                <tr>
                  <td width="29" class="appd">Name</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" class="appd"><?php echo ucwords($rowe['nama_app_ib']); ?></td>
                </tr>
                <tr>
                  <td width="29" class="appd">No.ID</td>
                  <td class="appd">:</td>
                  <td align="left" class="appd"><?php echo $rowe['no_id_ib']; ?></td>
                </tr>
                <tr>
                  <td align="left" class="appd">Date &amp;Time</td>
                  <td class="appd">: </td>
                  <td align="left" class="appd"><?php echo $rowe['tgl_app_ib']; ?></td>
                </tr>
              </table></td>
              <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td colspan="3" align="center" class="appr">FACILITY MANAGEMENT</td>
                </tr>
                <tr>
                  <td colspan="3" align="center" valign="middle"><label class="apr"><?php echo $rowe['approve_fm'];?></label></td>
                </tr>
                <tr>
                  <td width="29" class="appd">Name</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" class="appd"><?php echo ucwords($rowe['nama_app_fm']); ?></td>
                </tr>
                <tr>
                  <td width="29" class="appd">No.ID</td>
                  <td class="appd">:</td>
                  <td align="left" class="appd"><?php echo $rowe['no_id_fm']; ?></td>
                </tr>
                <tr>
                  <td align="left" class="appd">Date &amp;Time</td>
                  <td class="appd">: </td>
                  <td align="left" class="appd"><?php echo $rowe['tgl_app_fm']; ?></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td colspan="3" align="center" class="appr">MAINTENANCE</td>
                </tr>
                <tr>
                  <td colspan="3" align="center" valign="middle"><label class="apr"><?php echo $rowe['approve_mt'];?></label></td>
                </tr>
                <tr>
                  <td width="29" class="appd">Name</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" class="appd"><?php echo ucwords($rowe['nama_app_mt']); ?></td>
                </tr>
                <tr>
                  <td width="29" class="appd">No.ID</td>
                  <td class="appd">:</td>
                  <td align="left" class="appd"><?php echo $rowe['no_id_mt']; ?></td>
                </tr>
                <tr>
                  <td align="left" class="appd">Date &amp;Time</td>
                  <td class="appd">: </td>
                  <td align="left" class="appd"><?php echo $rowe['tgl_app_mt']; ?></td>
                </tr>
              </table></td>
              <td align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr>
                  <td colspan="3" align="center" class="appr">SECURITY</td>
                </tr>
                <tr>
                  <td colspan="3" align="center" valign="middle"><label class="apr"><?php echo $rowe['approve_st'];?></label></td>
                </tr>
                <tr>
                  <td width="29" class="appd">Name</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" class="appd"><?php echo ucwords($rowe['nama_app_st']); ?></td>
                </tr>
                <tr>
                  <td width="29" class="appd">No.ID</td>
                  <td class="appd">:</td>
                  <td align="left" class="appd"><?php echo $rowe['no_id_st']; ?></td>
                </tr>
                <tr>
                  <td align="left" class="appd">Date &amp;Time</td>
                  <td class="appd">: </td>
                  <td align="left" class="appd"><?php echo $rowe['tgl_app_st']; ?></td>
                </tr>
              </table></td>
            </tr>
          </table>
            <br />
            Please click here for <a href = "wp_update_di.php?no_wp=<?php echo $rowe['no_wp']; ?>" class="apr">Approve</a></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="3"><span class="grs">TELP / NO. HP<br />
          </span><span class="eng">PHONE NO.</span></td>
          <td colspan="4"><label>
            <input name="telp_kontraktor" type="text" id="telp_kontraktor" size="30" readonly="readonly" value="<?php echo $rowe['telp_kontraktor']; ?>" />
          </label></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>C.</td>
          <td colspan="3"><span class="grs">JUMLAH ORANG</span><br />
            <span class="eng">QUANTITY OF PERSON</span></td>
          <td colspan="4"><label>
            <input name="jml_orang" type="text" id="jml_orang" size="7" readonly="readonly" value="<?php echo $rowe['jml_orang']; ?>"/>
            Orang
            
          </label></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>D.</td>
          <td colspan="3"><span class="grs">JENIS PEKERJAAN</span><br />
            <span class="eng">JOB DESCRIPTION</span></td>
          <td colspan="4"><textarea name="jns_pekerjaan" cols="25" readonly="readonly" id="jns_pekerjaan"><?php echo $rowe['jns_pekerjaan']; ?></textarea></td>
          </tr>
        <tr>
          <td colspan="5" bgcolor="#CCCCCC" class="jdl">DEPARTMENT INCHARGE</td>
          <td colspan="6" bgcolor="#CCCCCC" class="jdl"><input name="dept_incharge" type="text" id="dept_incharge" value="<?php echo $rowe['dept_incharge']; ?>" size="30" readonly="readonly" /></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>A.</td>
          <td colspan="3"><span class="grs">NAMA</span><br />
            <em class="eng">NAME</em></td>
          <td colspan="4"><label>
            <input name="nama_dept" type="text" id="nama_dept" value="<?php echo $rowe['nama_dept']; ?>" size="30" readonly="readonly" />
          </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="3"><span class="grs">NOMER ID</span><br />
            <span class="eng">ID NUMBER</span></td>
          <td colspan="4"><label>
            <input name="no_id" type="text" id="no_id" value="<?php echo $rowe['no_id']; ?>" readonly="readonly" />
          </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>C.</td>
          <td colspan="3"><span class="grs">TELP / NO. HP<br />
          </span><span class="eng">PHONE </span></td>
          <td colspan="4"><label>
            <input name="telp_dept" type="text" id="telp_dept" value="<?php echo $rowe['telp_dept']; ?>" size="30" readonly="readonly" />
          </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="11" bgcolor="#CCCCCC"><span class="grs"><span class="jdl">JADWAL   KERJA</span></span><br />
            <span class="eng">WORKING SCHEDULE</span></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>A.</td>
          <td colspan="3"><span class="grs">TANGGAL</span><br />
            <span class="eng">DATE</span></td>
          <td colspan="4"><input name="tgl_mulai" type="text" id="tgl_mulai" value= "<?php echo $mulai; ?>" size="10" readonly="readonly" /> 
            s.d 
            <input name="tgl_selesai" type="text" id="tgl_selesai" value= "<?php echo $selesai; ?>" size="10" readonly="readonly" /></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="3"><span class="grs">JAM</span><br />
            <span class="eng">TIME</span></td>
          <td colspan="4"><label>
            <input name="jam_mulai" type="text" id="jam_mulai" size="10" maxlength="8" readonly="readonly" value= "<?php echo $jam1; ?>" />
            s.d
            <input name="jam_selesai" type="text" id="jam_selesai" size="10" readonly="readonly" value="<?php echo $jam2; ?>" />
          </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="14" align="right" bgcolor="#CCCCCC">&nbsp;<br /></td>
        </tr>
        </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form></td>
  </tr>
  <tr>
    <td><?php include("foot.php"); ?>
    </td>
    </tr>
</table>
</body>
</html>