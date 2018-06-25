<?php
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php'); 
if ($s_bagian == 'Admin' or $s_bagian == 'Maintenance' or $s_bagian == 'Security'){header('Location: '.'login.php');}

if ((isset($_POST["kontraktor"])) && ($_POST["kontraktor"] != "")) {		
		setcookie("save", "Simpan", time() + 30);	
		function antiinjection($data){
			$filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
			return $filter_sql;
		}						
		 
		$job_des 	= $_POST['job_des'];
		$job_dess 	= ltrim($_POST['job_des']);
		$job_des	= antiinjection($job_des);
		$p_vendor	= strtoupper($_POST['kontraktor']);
		$p_qop		= $_POST['qop'];
		$p_mulai	= $_POST['mulai'];
		$p_selesai	= $_POST['selesai'];
		$p_lantai 	= $_POST['lantai'];
		$s_userid	= $_SESSION['userid'];	
		
		if (preg_match('/^.{1,21}\b/s',$p_vendor, $kon)){
			$cVendor=$kon[0];
		}		
		
		if (preg_match('/^.{1,21}\b/s',$s_nama, $kon)){
			$cNama=$kon[0];
		}				
		if (!isset($_COOKIE["save"])){		
		setcookie("save", "Simpan", time() + 30);
		$sql = "INSERT INTO $tb_reg (no_id, kontraktor, job_des, qop, mulai, selesai, no_reg, status, lantai, req_time, req_from)
			   VALUES('$s_userid','$p_vendor', '$job_des','$p_qop', '$p_mulai','$p_selesai', '-','Waiting', '$p_lantai', '$time',
			   '$ip_komp')";
		$Result = mysql_query($sql, $konek) or die(mysql_error());
		
		//sms & email working permit	
		$sms_judul		= " e-Working Permit $building";  
		$sms_waktu		= gmdate('d M Y  H:i:s',time()+60*60*7);
		$sms_isi		= "Please check this request, e-Working Permit= $cVendor";
		$sms_footer		= "Request by $cNama";
		$sms_pesan 		= "$sms_judul. \r\n \r\n $sms_isi. \r\n \r\n $sms_footer.";

		//sms/email ke FM
		// include('sms_fm.php');
		// include('sms2.php'); 
    include('sendmail.php');
		}
		header('Location: '.'reg_list_di.php'); 	
}
?>
<?php 
$judul 		= "Working Permit Order";
$title 		= "$judul";
$refresh 	= "";
include('doctype.php');
include("cssjs.php"); 
?>
<script type="text/javascript">
$(document).ready(function() {
	$("#kontraktor").focus();
	$(':input:not([type="submit"]):not([type="reset"])').each(function() {
		$(this).focus(function() {
			$(this).addClass('hilite');
			}).blur(function() {
				$(this).removeClass('hilite');});
	});
});  
</script>
<?php include('atas.php');?>
<form action="" method="post" name="form1" id="form1">
  <table border="1" cellpadding="5" cellspacing="10" align="center">
    <tr>
      <td><table border="0" align="center" cellpadding="3" cellspacing="1">
        <tr>
          <td align="left" valign="middle">Vendor</td>
          <td>:</td>
          <td><span id="sprytextfield1">
          <label>
            <input name="kontraktor" type="text" id="kontraktor" size="30" value="<?php echo $p_vendor;?>" />
            <span class="textfieldMinCharsMsg">Minimum number of characters not met.</span></label>
          </span></td>
        </tr>
        <tr>
          <td align="left" valign="middle">Job Description </td>
          <td>:</td>
          <td><span id="sprytextarea1">
          <label>
            <textarea name="job_des" id="job_des" cols="30" rows="2" ><?php echo $job_dess ;?></textarea>
<span class="textareaMaxCharsMsg">Exceeded maximum number of characters.</span></label>
          </span></td>
        </tr>
        <tr>
          <td align="left" valign="middle">Quantity of person</td>
          <td>:</td>
          <td><span id="sprytextfield2">
          <label>
            <input name="qop" type="text" id="qop" size="5" value="<?php echo $p_qop ;?>" />
            <span class="textfieldInvalidFormatMsg">invalid format.</span><span class="textfieldMinValueMsg"></span></label>
          </span></td>
        </tr>
        <tr>
          <td align="left" valign="middle">Floor</td>
          <td>:</td>
          <td><span id="sprytextfield3">
          <label>
            <input name="lantai" type="text" id="lantai" size="20" value="<?php echo $p_lantai ;?>" />
            <span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></label>
          </span></td>
        </tr>
        <tr>
          <td align="left" valign="middle">Working Permit Create</td>
          <td>:</td>
          <td><select name="mulai" id="mulai">
            <option><?php echo date('Y-m-d',time()-3600) ;?></option>
            <option><?php echo date('Y-m-d',time()+3600*24*1-3600) ;?></option>
          </select>
          to
            <select name="selesai" id="selesai">
              <option><?php echo date('Y-m-d',time()-3600) ;?></option>
              <option><?php echo date('Y-m-d',time()+3600*24*1-3600) ;?></option>
              <option><?php echo date('Y-m-d',time()+3600*24*2-3600) ;?></option>
              <option selected="selected"><?php echo date('Y-m-d',time()+3600*24*3-3600) ;?></option>
              <option><?php echo date('Y-m-d',time()+3600*24*4-3600) ;?></option>
              <option><?php echo date('Y-m-d',time()+3600*24*5-3600) ;?></option>
              <option><?php echo date('Y-m-d',time()+3600*24*6-3600) ;?></option>
          </select>
            yyyy-mm-dd</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right"><input type="submit" name="submit" id="submit" value="Submit" />
            <input type="reset" name="reset" id="reset" value="Reset" /></td>
      </table></td>
    </tr>
  </table>
</form>
<?php include('bawahb.php');?>
<script type="text/javascript">
<!--
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {minChars:2});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "integer", {minValue:1});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {maxChars:20});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {maxChars:255, useCharacterMasking:false});
//-->
</script>

