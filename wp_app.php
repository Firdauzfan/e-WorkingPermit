<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include("palidasi.php");
if (isset($_GET['no_wp'])) {
	$wp_id = $_GET['no_wp'];
	$sql = "SELECT * FROM $tb_wp WHERE md5(no_wp) = '$wp_id'";
	$sqlquery = mysql_query($sql,$konek) or die(mysql_error());
	$rowe = mysql_fetch_assoc($sqlquery);
	$jam1 = $rowe['jam_mulai']; 
	$jam2 = $rowe['jam_selesai'];
	
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
	
	$tgl1 = $rowe['tgl1'];
	$tgl2 = $rowe['tgl2'];
	$tgl3 = $rowe['tgl3'];
	$tgl4 = $rowe['tgl4'];
	$tgl5 = $rowe['tgl5'];
	$tgl6 = $rowe['tgl6'];
	$tgl7 = $rowe['tgl7'];
	$tgl8 = $rowe['tgl8'];
    include("tgl.php");	
	

    $sql1 ="select value from tb_config where path='path'";
    $r = mysql_query($sql1);
    $d = mysql_fetch_array($r);
    $path = $d['value'];

	$gamba = $rowe['poto'];
	$poto = $path."/".$gamba;
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WP Approve</title>
<link rel="shortcut icon" href="img/header/favicon.png" type="image/x-icon" />
<script src="js/rollover.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.1.0.js"></script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->

<?php include('fancy.php');?>

<link rel="stylesheet" type="text/css" href="css/wp_app.css">
</head>

<body>
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
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
    <td><form method="POST" enctype="multipart/form-data" name="form1" id="form1">
      <table width="975" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="15" align="left" valign="bottom" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td valign="top"><strong id="jd">Detail </strong></td>
              <td align="right" valign="middle"><label>
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
          <td colspan="2" ><u class="grs">GEDUNG</u><br />
            <em class="eng">BUILDING</em></td>
          <td width="27" >&nbsp;</td>
          <td >: <input name="gedung" type="text" id="gedung" value="<?php echo $rowe['gedung']; ?>" size="20" readonly="readonly" /></td>
          <td colspan="4" nowrap="nowrap" >&nbsp;</td>
          <td width="35" >&nbsp;</td>
          <td width="164" ><u class="grs">LANTAI</u><br />
            <span class="eng"><em>FLOOR</em></span></td>
          <td colspan="3" align="left">:
            <input name="lantai" type="text" id="lantai" size="10" readonly="readonly" value="<?php echo $rowe['lantai']; ?>" /></td>
          <td width="84" align="right">STATUS</td>
          <td width="262" align="right"><label> 
            : 
            <input name="status" type="text" id="status" size="15" readonly="readonly" value="<?php echo $rowe['status']; ?>"/>
          </label></td>
        </tr>
        <tr>
          <td colspan="6" bgcolor="#CCCCCC"><span class="jdl">KONTRAKTOR</span><br />
            <em class="eng">CONTRACTOR&nbsp;</em></td>
          <td colspan="9" bgcolor="#CCCCCC"><em class="eng">
            <input name="kontraktor" type="text" id="kontraktor" size="40" readonly="readonly" value="<?php echo strtoupper($rowe['kontraktor']); ?>"/>
          </em></td>
          </tr>
        <tr>
          <td width="28">&nbsp;</td>
          <td width="29">A.</td>
          <td colspan="4"><span class="grs">NAMA</span><br />
            <em class="eng">NAME            </em></td>
          <td colspan="4"><input name="nama_kontraktor" type="text" id="nama_kontraktor" size="25" readonly="readonly" value="<?php echo ucwords(strtolower($rowe['nama_kontraktor'])); ?>"/></td>
          <td colspan="2" rowspan="5" align="center" valign="middle"><table width="100" height="100" border="2" align="center">
            <tr>
              <td align="center" valign="middle"><img class ="classfancy" href ="<?php echo $poto; ?>" src="<?php echo $poto; ?>" width="100" height="120" align="middle" /></td>
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
                  <td width="73" align="left" class="appd"><?php echo $cKt; ?></td>
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
                  <td width="73" align="left" class="appd"><?php echo $cDt; ?></td>
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
                  <td width="29" align="left" class="appd">Nama</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" class="appd"><?php echo $cIb; ?></td>
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
                  <td width="29" align="left" class="appd">Nama</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" class="appd"><?php echo $cFm; ?></td>
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
                  <td width="29" align="left" class="appd">Nama</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" class="appd"><?php echo $cMt; ?></td>
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
                  <td width="29" align="left" class="appd">Nama</td>
                  <td width="6" class="appd">: </td>
                  <td width="73" align="left" class="appd"><?php echo $cSt; ?></td>
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
          </table>
            <br />
Please click here for 
  <br>
                      <a href = "wp_update.php?no_wp=<?php echo md5($rowe['no_wp']); ?>" class="apr">Approve</a>
  <br>
                     <!--  <a href = "wp_update_rej.php?no_wp=<?php echo md5($rowe['no_wp']); ?>" class="rjt">Reject</a> -->
  <br>

                        <form method="post">
                        <!-- <input type="hidden" name="html" value="&lt;p&gt;Your data has been deleted&lt/p&gt;" /> -->
                        <input type="submit" value="Reject" class="apr"/>
                        </form>
                        </td>
                        <div id="confirmBox">
                            <textarea style="width:300px;height:150px" id="masukkanPesan"> </textarea>
                            <div class="message"></div>
                            <span class="button yes btn-danger"  onclick="kirimPesanForm()">Proceed</span>
                            <span class="button no">Cancel</span>
                        </div>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="4"><span class="grs">TELP / NO. HP<br />
          </span><span class="eng">PHONE </span></td>
          <td colspan="4"><label>
            <input name="telp_kontraktor" type="text" id="telp_kontraktor" size="15" readonly="readonly" value="<?php echo $rowe['telp_kontraktor']; ?>" />
          </label></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>C.</td>
          <td colspan="4"><span class="grs">JUMLAH ORANG</span><br />
            <span class="eng">QUANTITY OF PERSON</span></td>
          <td colspan="4"><label>
            <input name="jml_orang" type="text" id="jml_orang" size="7" readonly="readonly" value="<?php echo $rowe['jml_orang']; ?>"/>
            Orang
            
          </label></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>D.</td>
          <td colspan="4"><span class="grs">JENIS PEKERJAAN</span><br />
            <span class="eng">JOB DESCRIPTION</span></td>
          <td colspan="4"><textarea name="jns_pekerjaan" cols="25" readonly="readonly" id="jns_pekerjaan"><?php echo $rowe['jns_pekerjaan']; ?></textarea></td>
          </tr>
           <tr>
          <td>&nbsp;</td>
          <td>E.</td>
          <td colspan="4" nowrap="nowrap"><span class="grs">PERALATAN PENDUKUNG</span><br />
            <span class="eng">TOOLS</span></td>
          <td colspan="4"><textarea name="tools" cols="25" readonly="readonly" id="tools"><?php echo $rowe['tools']; ?></textarea></td>
          </tr>
        <tr>
          <td colspan="6" bgcolor="#CCCCCC" class="jdl">DEPARTMENT INCHARGE</td>
          <td colspan="6" bgcolor="#CCCCCC" class="jdl"><input name="dept_incharge" type="text" id="dept_incharge" value="<?php echo strtoupper($rowe['dept_incharge']); ?>" size="40" readonly="readonly" /></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>A.</td>
          <td colspan="4"><span class="grs">NAMA</span><br />
            <em class="eng">NAME</em></td>
          <td colspan="4"><label>
            <input name="nama_dept" type="text" id="nama_dept" value="<?php echo ucwords(strtolower($rowe['nama_dept'])); ?>" size="25" readonly="readonly" />
          </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="4"><span class="grs">NOMER ID</span><br />
            <span class="eng"> NUMBER ID</span></td>
          <td colspan="4"><label>
            <input name="no_id" type="text" id="no_id" value="<?php echo $rowe['no_id']; ?>" size="10" readonly="readonly" />
          </label></td>
          <td>&nbsp;</td>
          <td align="center" valign="top">&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>C.</td>
          <td colspan="4"><span class="grs">TELP / NO. HP<br />
          </span><span class="eng">PHONE N</span></td>
          <td colspan="4"><label>
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
          <td colspan="4"><span class="grs">TANGGAL</span><br />
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
          <td colspan="4"><span class="grs">JAM</span><br />
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
          <td colspan="15" align="right" bgcolor="#CCCCCC">&nbsp;<br /></td>
        </tr>
        </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form></td>
  </tr>
  <tr>
    <td><?php include("foot.php"); ?></td>
  </tr>
</table>
<script type="text/javascript">
  function doConfirm(msg, yesFn, noFn) {
    var confirmBox = $("#confirmBox");
    confirmBox.find(".message").text(msg);
    confirmBox.find(".yes,.no").unbind().click(function () {
        confirmBox.hide();
    });
    confirmBox.find(".yes").click(yesFn);
    confirmBox.find(".no").click(noFn);
    confirmBox.show();
}

$(function () {
    $("form").submit(function (e) {
        e.preventDefault();
        var form = this;
        doConfirm("Are you sure?", function yes() {
            form.submit();
        }, function no() {
            // do nothing
        });
    });
});

function kirimPesanForm(){
  var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
  var pesan = $('#masukkanPesan').val();
  if(pesan.trim() == '' ){
  alert('Masukkan pesan Anda.');
        $('#masukkanPesan').focus();
  return false;
 }else{
        $.ajax({
            type:'POST',
            url:'wp_update_rej.php?no_wp=<?php echo md5($rowe['no_wp']); ?>',
            data:'&pesan='+pesan,
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
                if(msg == 'ok'){
                    $('#masukkanPesan').val();
                    $('.statusMsg').html('<span style="color:green;">Terima kasih telah pesan anda berhasil.</p>');
                }else{
                    $('.statusMsg').html('<span style="color:red;">Ada sedikit masalah, silakan coba lagi.</span>');
                }
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
            });
}
}
</script>
</body>
</html>