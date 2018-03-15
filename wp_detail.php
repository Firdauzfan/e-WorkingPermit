<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
require_once('Connections/konek.php'); 
if (isset($_GET['no_wp'])) {
	$wp_id 		= $_GET['no_wp'];
	$sql 		= "SELECT * FROM $tb_wp WHERE md5(no_wp) = '$wp_id'";
	$sqlquery 	= mysql_query($sql,$konek) or die(mysql_error());
	$rowe 		= mysql_fetch_assoc($sqlquery);
	$jam1 		= substr($rowe['jam_mulai'],0,5); 
	$jam2 		= substr($rowe['jam_selesai'],0,5);

	$sql1 ="select value from tb_config where path='path'";
  $r = mysql_query($sql1);
  $d = mysql_fetch_array($r);
  $path = $d['value'];

	$gamba 		= $rowe['poto'];		 
	$gamba 		= $path."/".$gamba;	
	$cKt		= ucwords(strtolower($rowe['nama_kontraktor']));
	$cDt		= ucwords(strtolower($rowe['nama_app_dt']));
	$cIb		= ucwords(strtolower($rowe['nama_app_ib']));
	$cFm		= ucwords(strtolower($rowe['nama_app_fm']));
	$cMt		= ucwords(strtolower($rowe['nama_app_mt']));
	$cSt		= ucwords(strtolower($rowe['nama_app_st']));
	
	if (preg_match('/^.{1,15}\b/s',$cKt, $kon)){
			$cKt=$kon[0];
		}
	if (preg_match('/^.{1,15}\b/s',$cDt, $kon)){
			$cDt=$kon[0];
		}
	if (preg_match('/^.{1,15}\b/s',$cIb, $kon)){
			$cIb=$kon[0];
		}
	if (preg_match('/^.{1,15}\b/s',$cFm, $kon)){
			$cFm=$kon[0];
		}
	if (preg_match('/^.{1,15}\b/s',$cMt, $kon)){
			$cMt=$kon[0];
		}
	if (preg_match('/^.{1,15}\b/s',$cSt, $kon)){
			$cSt=$kon[0];
		}
	
	$tgl1 		= $rowe['tgl1'];
	$tgl2 		= $rowe['tgl2'];
	$tgl3 		= $rowe['tgl3'];
	$tgl4 		= $rowe['tgl4'];
	$tgl5 		= $rowe['tgl5'];
	$tgl6 		= $rowe['tgl6'];
	$tgl7 		= $rowe['tgl7'];	
	$tgl8 		= $rowe['tgl8'];
	require_once('tgl.php') ;	
	

		
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="img/header/favicon.png" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="37" />
<title>WP Detail</title>
<script src="js/rollover.js" type="text/javascript"></script>
<?php include('fancy.php');?>
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
	color: #966;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 24px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
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
a {
	font-size: 10px;
}
-->
</style>
</head>

<body>
<table width="980"  border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
<tr>
    <td><table width="100%" cellpadding="0">
      <tr>
        <td><?php include('header.php'); ?></td>
        </tr>
      <tr>
        <td align="right"  background="img/tab_menu.jpg"><a href="javascript:history.back(1)" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','img/t_backa.jpg',1)"><img src="img/t_back.jpg" alt="Back" name="Image3" width="66" height="40" border="0" id="Image3" /></a></td>
        </tr>
</table></td>
    </tr>    
  <tr>
    <td>
      <table width="975" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="15" align="left" valign="bottom" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td valign="top"><strong id="jd">Detail</strong></td>
              <td align="right" valign="bottom"><label>
                NO WP :
                    <input name="no_wp" type="text" id="no_wp" size="10" readonly="readonly" value="<?php echo $rowe['no_wp']; ?>"  />
              </label></td>
              </tr>
          </table></td>
          </tr>
        <tr>
          <td height="2" bgcolor="#0000FF"colspan="15"></td>
        </tr>
        <tr>
          <td colspan="3" ><u class="grs">GEDUNG</u><br />
            <em class="eng">BUILDING</em></td>
          <td colspan="5" nowrap="nowrap" >:
            <label>
              <input name="gedung" type="text" id="gedung" value="<?php echo $rowe['gedung']; ?>" size="15" readonly="readonly" />
            </label></td>
          <td width="147" >&nbsp;</td>
          <td width="86" ><u class="grs">LANTAI</u><br />
            <span class="eng"><em>FLOOR</em></span></td>
          <td colspan="3" align="left">:
            <input name="lantai" type="text" id="lantai" size="15" readonly="readonly" value="<?php echo $rowe['lantai']; ?>" /></td>
          <td width="169" align="right">STATUS</td>
          <td width="176" align="right"><label> 
            : 
            <input name="status" type="text" id="status" size="15" readonly="readonly" value="<?php echo $rowe['status']; ?>"/>
          </label></td>
        </tr>
        <tr>
          <td colspan="5" bgcolor="#CCCCCC"><span class="jdl">KONTRAKTOR</span><br />
            <em class="eng">CONTRACTOR&nbsp;</em></td>
          <td colspan="10" bgcolor="#CCCCCC"><em class="eng">
            <input name="kontraktor" type="text" id="kontraktor" size="40" readonly="readonly" value="<?php echo strtoupper($rowe['kontraktor']); ?>"/>
          </em></td>
          </tr>
        <tr>
          <td width="28">&nbsp;</td>
          <td width="29">A.</td>
          <td colspan="2"><span class="grs">NAMA</span><br />
            <em class="eng">NAME            </em></td>
          <td width="72">&nbsp;</td>
          <td colspan="5"><input name="nama_kontraktor" type="text" id="nama_kontraktor" size="25" readonly="readonly" value="<?php echo ucwords($rowe['nama_kontraktor']); ?>"/></td>
          <td colspan="2" rowspan="5" align="center" valign="middle"><table width="100" height="100" border="2" align="center">
            <tr>
              <td align="center" valign="middle"><img class ="classfancy" href ="<?php echo $gamba; ?>" src="<?php echo $gamba; ?>" title ="<?php echo ucwords($rowe['nama_kontraktor']); ?>" width="100" height="120" align="middle" /></td>
            </tr>
          </table></td>
          <td colspan="3" rowspan="12" align="center" valign="top" bgcolor="#CCCCCC"><table width="100%" bgcolor="#FFFFFF" border="1" cellspacing="2" cellpadding="2">
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
                  <td width="29" align="left" class="appd">Name</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" nowrap="nowrap" class="appd"><?php echo $cKt; ?></td>
                </tr>
                <tr>
                  <td width="29" align="left" class="appd">No.ID</td>
                  <td class="appd">:</td>
                  <td align="left" class="appd"><?php echo $rowe['no_id_kt']; ?></td>
                </tr>
                <tr>
                  <td align="left" nowrap="nowrap" class="appd">Date &amp;Time</td>
                  <td class="appd">: </td>
                  <td align="left" nowrap="nowrap" class="appd"><?php echo $rowe['tgl_app_kt']; ?></td>
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
                  <td width="29" align="left" class="appd">Name</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" nowrap="nowrap" class="appd"><a href = "user_detail.php?no_id=<?php echo md5($rowe['no_id_dt']); ?>"><?php echo $cDt; ?></a></td>
                </tr>
                <tr>
                  <td width="29" align="left" class="appd">No.ID</td>
                  <td class="appd">:</td>
                  <td align="left" class="appd"><?php echo $rowe['no_id_dt']; ?></td>
                </tr>
                <tr>
                  <td align="left" nowrap="nowrap" class="appd">Date &amp;Time</td>
                  <td class="appd">: </td>
                  <td align="left" nowrap="nowrap" class="appd"><?php echo $rowe['tgl_app_dt']; ?></td>
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
                  <td width="29" align="left" class="appd">Name</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" nowrap="nowrap" class="appd"><a href = "user_detail.php?no_id=<?php echo md5($rowe['no_id_ib']); ?>"><?php echo $cIb; ?></a></td>
               </tr>
                <tr>
                  <td width="29" align="left" class="appd">No.ID</td>
                  <td class="appd">:</td>
                  <td align="left" class="appd"><?php echo $rowe['no_id_ib']; ?></td>
                </tr>
                <tr>
                  <td align="left" nowrap="nowrap" class="appd">Date &amp;Time</td>
                  <td class="appd">: </td>
                  <td align="left" nowrap="nowrap" class="appd"><?php echo $rowe['tgl_app_ib']; ?></td>
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
                  <td width="29" align="left" class="appd">Name</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" nowrap="nowrap" class="appd"><a href = "user_detail.php?no_id=<?php echo md5($rowe['no_id_fm']); ?>"><?php echo $cFm; ?></a></td>
                </tr>
                <tr>
                  <td width="29" align="left" class="appd">No.ID</td>
                  <td class="appd">:</td>
                  <td align="left" class="appd"><?php echo $rowe['no_id_fm']; ?></td>
                </tr>
                <tr>
                  <td align="left" nowrap="nowrap" class="appd">Date &amp;Time</td>
                  <td class="appd">: </td>
                  <td align="left" nowrap="nowrap" class="appd"><?php echo $rowe['tgl_app_fm']; ?></td>
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
                  <td width="29" align="left" class="appd">Name</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" nowrap="nowrap" class="appd"><a href = "user_detail.php?no_id=<?php echo md5($rowe['no_id_mt']); ?>"><?php echo $cMt; ?></a></td>
                </tr>
                <tr>
                  <td width="29" align="left" class="appd">No.ID</td>
                  <td class="appd">:</td>
                  <td align="left" class="appd"><?php echo $rowe['no_id_mt']; ?></td>
                </tr>
                <tr>
                  <td align="left" nowrap="nowrap" class="appd">Date &amp;Time</td>
                  <td class="appd">: </td>
                  <td align="left" nowrap="nowrap" class="appd"><?php echo $rowe['tgl_app_mt']; ?></td>
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
                  <td width="29" align="left" class="appd">Name</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" nowrap="nowrap" class="appd"><a href = "user_detail.php?no_id=<?php echo md5($rowe['no_id_st']); ?>"><?php echo $cSt; ?></a></td>
                </tr>
                <tr>
                  <td width="29" align="left" class="appd">No.ID</td>
                  <td class="appd">:</td>
                  <td align="left" class="appd"><?php echo $rowe['no_id_st']; ?></td>
                </tr>
                <tr>
                  <td align="left" nowrap="nowrap" class="appd">Date &amp;Time</td>
                  <td class="appd">: </td>
                  <td align="left" nowrap="nowrap" class="appd"><?php echo $rowe['tgl_app_st']; ?></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="3"><span class="grs">TELP / NO. HP<br />
          </span><span class="eng">PHONE </span></td>
          <td colspan="5"><label>
            <input name="telp_kontraktor" type="text" id="telp_kontraktor" size="15" readonly="readonly" value="<?php echo $rowe['telp_kontraktor']; ?>" />
          </label></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>C.</td>
          <td colspan="3"><span class="grs">JUMLAH ORANG</span><br />
            <span class="eng">QUANTITY OF PERSON</span></td>
          <td colspan="5"><label>
            <input name="jml_orang" type="text" id="jml_orang" size="7" readonly="readonly" value="<?php echo $rowe['jml_orang']; ?>"/>
            Orang
            
          </label></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>D.</td>
          <td colspan="3"><span class="grs">JENIS PEKERJAAN</span><br />
            <span class="eng">JOB DESCRIPTION</span></td>
          <td colspan="5"><label>
            <textarea name="jns_pekerjaan" cols="25" readonly="readonly" id="jns_pekerjaan"><?php echo $rowe['jns_pekerjaan']; ?></textarea>
          </label></td>
          </tr>
           <tr>
          <td>&nbsp;</td>
          <td>E.</td>
          <td colspan="3" nowrap="nowrap"><span class="grs">PERALATAN PENDUKUNG</span><br />
            <span class="eng">TOOLS</span></td>
          <td colspan="5"><label>
            <textarea name="tools" cols="25" readonly="readonly" id="tools"><?php echo $rowe['tools']; ?></textarea>
          </label></td>
          </tr>
        <tr>
          <td colspan="5" bgcolor="#CCCCCC" class="jdl">DEPARTMENT INCHARGE</td>
          <td colspan="7" bgcolor="#CCCCCC" class="jdl"><input name="dept_incharge" type="text" id="dept_incharge" value="<?php echo strtoupper($rowe['dept_incharge']); ?>" size="40" readonly="readonly" /></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>A.</td>
          <td colspan="3"><span class="grs">NAMA</span><br />
            <em class="eng">NAME</em></td>
          <td colspan="5"><label>
           <input name="nama_dept" type="text" id="nama_dept" value="<?php echo ucwords($rowe['nama_dept']); ?>" size="25" readonly="readonly" />
          </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="3"><span class="grs">NOMER ID</span><br />
            <span class="eng">ID NUMBER</span></td>
          <td colspan="5"><label>
           <input name="no_id" type="text" id="no_id" value="<?php echo $rowe['no_id']; ?>" size="10" readonly="readonly" />
          </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>C.</td>
          <td colspan="3"><span class="grs">TELP / NO. HP<br />
          </span><span class="eng">PHONE </span></td>
          <td colspan="5"><label>
            <input name="telp_dept" type="text" id="telp_dept" value="<?php echo $rowe['telp_dept']; ?>" size="15" readonly="readonly" />
          </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="12" bgcolor="#CCCCCC"><span class="grs"><span class="jdl">JADWAL   KERJA</span></span><br />
            <span class="eng">WORKING SCHEDULE</span></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>A.</td>
          <td colspan="3"><span class="grs">TANGGAL</span><br />
            <span class="eng">DATE</span></td>
          <td colspan="5" nowrap="nowrap"><input name="tgl_mulai" type="text" id="tgl_mulai" value= "<?php echo $mulai; ?>" size="10" readonly="readonly" /> 
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
          <td colspan="5" nowrap="nowrap"><label>
            <input name="jam_mulai" type="text" id="jam_mulai" size="10" maxlength="8" readonly="readonly" value= "<?php echo $rowe['jam_mulai']; ?>" />
            s.d
            <input name="jam_selesai" type="text" id="jam_selesai" size="10" readonly="readonly" value="<?php echo $rowe['jam_selesai']; ?>" />
            </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td colspan="15" align="right" bgcolor="#CCCCCC">&nbsp;<br /></td>
        </tr>
        </table>     
    </td>
  </tr>
  <tr>
    <td><?php include("foot.php"); ?>
    </td>
    </tr>
</table>
</body>
</html>