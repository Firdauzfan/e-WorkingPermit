<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
require_once('Connections/konek.php'); 
if (isset( $_GET['no'])){
	
	$no 		= $_GET['no'];
	$sql 		= "SELECT * FROM $tb_reg WHERE md5(no) = '$no'";
	$sqlquery 	= mysql_query($sql,$konek) or die(mysql_error());
	$hasil		= mysql_fetch_assoc($sqlquery);
	
	if ($hasil){
		$g_noid 	= $hasil['no_id'];
		$g_noreg 	= $hasil['no_reg'];	
		$g_kont 	= $hasil['kontraktor'];
		$g_jobdes 	= $hasil['job_des'];
		$g_qop 		= $hasil['qop'];	
		$g_lantai 	= $hasil['lantai'];
		$g_tglreg 	= $hasil['req_time'];
		$g_cek 		= $hasil['cek'];
	}
}

// save ke database -----------------------------------------

if (isset($_POST["no_reg"]) && $_POST["no_reg"] != '') {
	$ip_comp = getenv(REMOTE_ADDR);
	// if($ip_comp != $ip_client){die("e-working permit<br>Pembuatan working permit hanya pada komputer yang telah ditentukan
	// di $building. <a href='javascript:history.back(1)'><br>Klik disini untuk kembali</a>");}
	
	//hasil post dari form
	$no_reg 		=$_POST['no_reg'];
	$no_reg2 		=$_POST['no_reg2'];
	$noid_pic		=$_POST['no_id'];	
	$lantai 		=$_POST['lantai'];
	$status 		=$_POST['status'];
	$kontraktor 	=$_POST['kontraktor'];
	$nama_kont	 	=$_POST['nama_kontraktor'];
	$telp_kont		=$_POST['telp_kontraktor'];
	$qop 			=$_POST['jml_orang'];
	$job_des 		=$_POST['jns_pekerjaan'];
	$tools			=$_POST['tools'];
	$photo 			=$_POST['upload'];
	$tgl1 			=$_POST['tgl1'];
	$tgl2 			=$_POST['tgl2'];
	$tgl3 			=$_POST['tgl3'];
	$tgl4 			=$_POST['tgl4'];
	$tgl5 			=$_POST['tgl5'];
	$tgl6 			=$_POST['tgl6'];
	$tgl7 			=$_POST['tgl7'];
	$tgl8 			=$_POST['tgl8'];
	$tgl_reg		=$_POST['tgl_reg'];
	$jam_mulai 		=$_POST['jam_mulai'];
	$menit_mulai 	=$_POST['menit_mulai'];
	$jam_selesai 	=$_POST['jam_selesai'];
	$menit_selesai 	=$_POST['menit_selesai'];
	
	$jamm			= $jam_mulai.':'.$menit_mulai.':'.'00';
	$jams			= $jam_selesai.':'.$menit_selesai.':'.'00';
	
	if ($jam_selesai == '00') {$jam_palid = '24';} else {$jam_palid = $jam_selesai;}
	
	if($_POST["cek"] == "no"){$appib ="No";}else{$appib = "-";}

	//cek department Incharge
	$sql 			= "SELECT * FROM  tb_user where no_id = '$noid_pic' and  status = 'Aktif'";
	$sql_query 		= mysql_query($sql, $konek) or die(mysql_error());
	$result			= mysql_fetch_assoc($sql_query);
		
	if (!$result){die("Department In cahrge tidak terdaftar atau sudah tidak aktif<a href='javascript:history.back(1)'>Back</a>");}
	$nama_pic 		= $result['nama'];
	$dept_pic 		= $result['departement'];
	$telp_pic 		= $result['telp'];							
	
	if (!empty($tgl1)){
		$mulai = $tgl1;
	}elseif (!empty($tgl2)){
		$mulai = $tgl2;
	}elseif (!empty($tgl3)){
		$mulai = $tgl3;
	}elseif (!empty($tgl4)){
		$mulai = $tgl4;
	}elseif (!empty($tgl5)){
		$mulai = $tgl5;
	}elseif (!empty($tgl6)){
		$mulai = $tgl6;
	}elseif (!empty($tgl7)){
		$mulai = $tgl7;
	}else{
		$mulai = $tgl8;
	}	

	//upload Photo
	$fileName 	= $_FILES['upload']['name'];  
	$fileSize 	= $_FILES['upload']['size'];
	$tmpName  	= $_FILES['upload']['tmp_name'];
	$fileType 	= $_FILES['upload']['type'];
	$typefile 	= substr($fileType,0,5);
	$uploadDir 	= 'vendor/';
	$unikName 	= gmdate('ymdHis',time()+60*60*7);
	$ex_nama 	= explode(" ", $nama_kont);
	$im_nama 	= implode("", $ex_nama);	
	
  // include('uploadjpg.php');
	$uploadfile = $uploadDir.$unikName.".jpg";
	$photo 		= $uploadfile;	
	// $addfile 	= "../wp1/".$fileup;
		
	if ($no_reg != $no_reg2){
		$pesan = "Nomer registrasi anda salah, silakan hubungi Department in charge (Orang yang memerintahkan anda untuk berkerja)";
	}elseif ($status == ''){
		$pesan = "Status kerja harus diisi";
	}elseif($tgl1=='' and $tgl2=='' and $tgl3=='' and $tgl4=='' and $tgl5=='' and $tgl6=='' and $tgl7=='' and $tgl8==''){
		$pesan = "Tanggal harus diisi";
	}elseif($tgl1 !='' and $tgl2 !='' and $tgl3 !='' and $tgl4 !='' and $tgl5 !='' and $tgl6 !='' and $tgl7 !='' and $tgl8 !=''){
		$pesan = "Maksimal 7 hari";
	}elseif($jam_mulai=='hour' or $jam_selesai=='hour'){
		$pesan = "Jam harus diisi";
	}elseif($tgl1 !='' and $tgl2=='' and $tgl3=='' and $tgl4=='' and $tgl5=='' and $tgl6=='' and $tgl7=='' and $tgl8=='' and 
	($jam_mulai > $jam_palid or $jam_mulai == $jam_selesai)){
		$pesan = "Jam yang anda pilih salah";
	}else{	

	if (!isset($_COOKIE["save"])){		
		setcookie("save", "Simpan", time() + 60);
		
	//nomor urut	
	$sql 		= "SELECT max(no_wp) as num FROM $tb_wp";
	$sql_query	= mysql_query($sql, $konek) or die(mysql_error());
	$result 	= mysql_fetch_assoc($sql_query);
	$jml 		= $result['num']+1;
	$trek 		= str_repeat('0',5 - strlen($jml)).$jml; 
	
	// $upload = move_uploaded_file($tmpName, $addfile);
	// if (!$upload) {die (" File gagal diupload");}
	//proses insert	
	
		$insertSQL = "INSERT INTO $tb_wp (
					 no_wp, gedung, lantai, status, kontraktor, nama_kontraktor, telp_kontraktor, 
					 jml_orang, jns_pekerjaan, tools, dept_incharge, nama_dept, no_id, telp_dept,
					 tgl0, tgl1, tgl2, tgl3, tgl4, tgl5, tgl6, tgl7, tgl8,
					 tgl_app_dt, nama_app_dt, no_id_dt, jam_mulai, jam_selesai, tgl_app_kt, approve_kt,
					 approve_dt, approve_ib, approve_fm, approve_mt, approve_st, no_reg, poto, lokasi) 
					 VALUES(
					 '$trek', '$building', '$lantai', '$status', '$kontraktor', '$nama_kont', '$telp_kont',
					 '$qop', '$job_des', '$tools', '$dept_pic', '$nama_pic', '$noid_pic', '$telp_pic',
					 '$mulai', '$tgl1', '$tgl2', '$tgl3', '$tgl4', '$tgl5', '$tgl6', '$tgl7', '$tgl8',
					 '$tgl_reg', '$nama_pic', '$noid_pic', '$jamm', '$jams', '$time', 'App',
					 'App', '$appib', '-', '-',	'-', '$no_reg', '$photo', '$tempat')";  	  
		  $Result1 = mysql_query($insertSQL, $konek) or die(mysql_error()); 
		  
		  $updateSQL = "UPDATE $tb_reg SET status = 'used' WHERE no_reg = '$no_reg'";
		  $Result2 = mysql_query($updateSQL, $konek) or die(mysql_error());
		  
		 //sms/email working permit	  
		  $sms_judul		= " e-Working Permit $building";
		  $sms_waktu		= gmdate('d M Y  H:i:s',time()+60*60*7);
		  $sms_isi			= "Approve working permit ". strtoupper($kontraktor);
		  $sms_footer		= "Create by ". ucwords(strtolower($nama_kont))."($telp_kont)";
		  $sms_pesan 		= "$sms_judul. \r\n \r\n $sms_isi. \r\n \r\n $sms_footer.";
		  
      //sms/email ke Departement incharge       
      $sms_isi1   = "Your vendor ".strtoupper($nama_kont)."($telp_kont) from $kontraktor has been Created e-working permit";    
      $sms_pesan1  = "$sms_judul. \r\n \r\n $sms_isi1.";
      //sms ke in charge
      $sms_no_id  = $noid_pic;
      // include('sms_no_id.php');
      // include('sms2.php'); 
      
      if($_POST["cek"] == "yes"){
			include('sendmailcwp.php');
      include('sendmailfm1.php');
		  }else{
			include('sendmailcwp1.php');
      include('sendmailfm1.php');
		   }		  
		  // include('sms2.php'); 	  	
		  
		  

		  header('Location: '.'wp_tampil.php');
		}
	}
}
//end save ----------------------------------------------------------------------------------------				   
?>

<?php 
$judul 		= "Create Working Permit";
$title 		= "$judul";
include('doctype.php');
include('cssjs.php');
?>
<script src="SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
      $(document).ready(function() {
		  $("#no_reg").focus();
  	    $(':input:not([type="submit"]):not([type="reset"])').each(function() {
	        $(this).focus(function() {
	            $(this).addClass('hilite');
	        }).blur(function() {
	            $(this).removeClass('hilite');});
	     });
      });  
	    
function poto(){
document.getElementById("img").src = document.getElementById("upload").value;
}
</script>
<style type="text/css">
    body { font-family: Helvetica, sans-serif; }
    h2, h3 { margin-top:0; }
    form { margin-top: 15px; }
    form > input { margin-right: 15px; }
    #results { float:right; margin:20px; padding:20px; border:1px solid; background:#ccc; }
  </style>
<?php include('atas.php');?>
<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">
      <table border="0" align="center" cellpadding="1" cellspacing="0">       
        <tr>
          <td width="148" nowrap="nowrap" >Registration Number</td>
          <td width="8" align="center" class="tt">:</td>
          <td colspan="2"><span id="sprytextfield1">
          <label>
            <input name="no_reg" type="text" id="no_reg" size="20" value="<?php echo $_POST['no_reg']; ?>" />
          </label>
          </span></td>
          <td width="222" rowspan="9" align="right" valign="top" nowrap="nowrap">
           <div id="results">Your captured image will appear here...</div>
          <!-- <img src="$photo" alt="Photo"  name="img" width="199" height="214" border="1" id="img" style="border-color:#FC6" /></td> -->
        </tr>
         <tr>
          <td>Name</td>
          <td align="center" class="tt">:</td>
          <td colspan="2"><span id="sprytextfield3">
          <label>
            <input name="nama_kontraktor" type="text" id="nama_kontraktor" size="30" value="<?php echo $_POST['nama_kontraktor']; ?>"/>
          </label>
          </span></td>
          </tr>
         <tr>
          <td>Phone</td>
          <td align="center" class="tt">:</td>
          <td colspan="2"><span id="sprytextfield4">
          <label>
            <input name="telp_kontraktor" type="text" id="telp_kontraktor" size="30" value="<?php echo $_POST['telp_kontraktor']; ?>"/>
          </label>
          </span></td>
          </tr>
            <tr>
          <td>Tools</td>
          <td align="center" class="tt">:</td>
          <td colspan="2"><span id="sprytextarea2">
            <label>
              <textarea name="tools" id="tools" cols="30" rows="2"><?php echo $_POST['tools']; ?></textarea>
            </label>
           </span></td>
          </tr>
          <tr>
          <td>Photo</td>
          <td align="center" class="tt">:</td>
          <td colspan="2"><span id="sprytextfield7">
            <div id="my_camera"></div>
            
            <!-- First, include the Webcam.js JavaScript Library -->
            <script type="text/javascript" src="js/webcam.min.js"></script>
            
            <!-- Configure a few settings and attach camera -->
            <script language="JavaScript">
              Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
              });
              Webcam.attach( '#my_camera' );
            </script>
            
            <!-- A button for taking snaps -->
            <form>
              <input type=button value="Take Picture" onClick="take_snapshot()">
            </form>
            
            <!-- Code to handle taking the snapshot and displaying it locally -->
            <script language="JavaScript">
              function take_snapshot() {
                // take snapshot and get image data
                Webcam.snap( function(data_uri) {
                  // display results in page
                  document.getElementById('results').innerHTML = 
                    '<h2>Here is your image:</h2>' + 
                    '<img id="base64image" src="'+data_uri+'"/>';
                    console.log(data_uri);
                } );
              }

              function SaveSnap(){
                  var base64image = document.getElementById("base64image").src;
                  // document.getElementById("loading").innerHTML="Saving, please wait...";
                  Webcam.upload( base64image, 'uploadjpg.php', function(code, text) {
                  console.log('Save successfully');
                  //console.log(text);
                 });
                  }
            </script>
        </span>
          </td>
          </tr>         
         <tr>
          <td>Working Status</td>
          <td align="center" class="tt">:</td>
          <td colspan="2"><span id="spryselect1">
            <label>
              <select name="status" id="status">
              	<option value="<?php echo $_POST['status']; ?>"><?php echo $_POST['status']; ?></option>
                <option value="Baru">Baru</option>
                <option value="Perpanjang">Perpanjang</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Lain-lain">Lain-lain</option>
                </select>
              </label></span>
          </td>
          </tr>
          <tr>
          <td>Contractor</td>
          <td align="center" class="tt">:</td>
          <td colspan="2" nowrap="nowrap"><span id="sprytextfield2">
          <label>
            <input name="kontraktor" type="text" id="kontraktor" value="<?php echo strtoupper($g_kont); ?>" size="40" />
          </label>
          </span></td>
          </tr>
         <tr>
          <td>Quantity of person</td>
          <td align="center" class="tt">:</td>
          <td colspan="2"><span id="sprytextfield5">
            <label>
              <input name="jml_orang" type="text" id="jml_orang" value="<?php echo $g_qop; ?>" size="10" />
              </label>
          </span></td>
          </tr>
        <tr>
          <td><p>Job Description</p></td>
          <td align="center" class="tt">:</td>
          <td colspan="2" nowrap="nowrap"><span id="sprytextarea1">
            <label>
              <textarea name="jns_pekerjaan" id="jns_pekerjaan" cols="30" rows="2"><?php echo $g_jobdes; ?></textarea>
              </label>
          </span></td>
           </tr>
        <tr>
          <td>Floors</td>
          <td align="center" class="tt">:</td>
          <td colspan="3"><span id="sprytextfield6">
            <label>
              <input name="lantai" type="text" id="lantai" value="<?php echo $g_lantai; ?>" size="40" />
            </label>
            </span></td>
        </tr>
        <tr>
          <td>Working Schedule</td>
          <td align="center" class="tt">&nbsp;</td>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td>Days and Date</td>
          <td align="center" class="tt">:</td>
          <td width="209" nowrap="nowrap">1.
            <input type="checkbox" name="tgl1" id="tgl1" value="<?php echo gmdate('Y-m-d',time()+(60*60*7)+(86400*0));?>" />
            <?php echo gmdate('l, d M Y',time()+(60*60*7)+(86400*0)); ?></td>
          <td width="44" nowrap="nowrap">&nbsp;</td>
          <td nowrap="nowrap">5.
            <input type="checkbox" name="tgl5" id="tgl5" value="<?php echo gmdate('Y-m-d',time()+(60*60*7)+(86400*4));?>" />
            <?php echo gmdate('l, d M Y',time()+(60*60*7)+(86400*4)); ?></td>
          </tr>
         <tr>
          <td>&nbsp;</td>
          <td align="center" class="tt">&nbsp;</td>
          <td nowrap="nowrap">2.
            <input type="checkbox" name="tgl2" id="tgl2" value="<?php echo gmdate('Y-m-d',time()+(60*60*7)+(86400*1));?>" />
            <?php echo gmdate('l, d M Y',time()+(60*60*7)+(86400*1)); ?></td>
          <td nowrap="nowrap">&nbsp;</td>
          <td nowrap="nowrap">6.
            <input type="checkbox" name="tgl6" id="tgl6" value="<?php echo gmdate('Y-m-d',time()+(60*60*7)+(86400*5));?>" />
            <?php echo gmdate('l, d M Y',time()+(60*60*7)+(86400*5)); ?></td>
          </tr>
         <tr>
          <td>&nbsp;</td>
          <td align="center" class="tt">&nbsp;</td>
          <td nowrap="nowrap">3.
            <input type="checkbox" name="tgl3" id="tgl3" value="<?php echo gmdate('Y-m-d',time()+(60*60*7)+(86400*2));?>" />
            <?php echo gmdate('l, d M Y',time()+(60*60*7)+(86400*2)); ?></td>
          <td nowrap="nowrap">&nbsp;</td>
          <td nowrap="nowrap">7.
            <input type="checkbox" name="tgl7" id="tgl7" value="<?php echo gmdate('Y-m-d',time()+(60*60*7)+(86400*6));?>"/>
            <?php echo gmdate('l, d M Y',time()+(60*60*7)+(86400*6)); ?></td>
          </tr>
         <tr>
          <td>&nbsp;</td>
          <td align="center" class="tt">&nbsp;</td>
          <td nowrap="nowrap">4.
            <input type="checkbox" name="tgl4" id="tgl4" value="<?php echo gmdate('Y-m-d',time()+(60*60*7)+(86400*3));?>" />
            <?php echo gmdate('l, d M Y',time()+(60*60*7)+(86400*3)); ?></td>
          <td nowrap="nowrap">&nbsp;</td>
          <td nowrap="nowrap">8.
            <input type="checkbox" name="tgl8" id="tgl8" value="<?php echo gmdate('Y-m-d',time()+(60*60*7)+(86400*7));?>"/>
            <?php echo gmdate('l, d M Y',time()+(60*60*7)+(86400*7)); ?></td>
          </tr>       
          <tr>
            <td height="30">Time</td>
            <td align="center" class="tt">:</td>
            <td colspan="3" nowrap="nowrap">Start
            <span id="spryselect2">
              <select name="jam_mulai" id="jam_mulai">
                <option value="<?php echo $_POST['jam_mulai']; ?>"><?php if (isset($_POST['jam_mulai']))
				{echo $_POST['jam_mulai'];}else{echo "hour";} ?></option>
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
              </select>
              </span>
              <select name="menit_mulai" id="menit_mulai">                
                <option>00</option>
                <option>05</option>
                <option>10</option>
                <option>15</option>
                <option>20</option>
                <option>25</option>
                <option>30</option>
                <option>35</option>
                <option>40</option>
                <option>45</option>
                <option>50</option>
                <option>55</option>
              </select> 
              finish
              <span id="spryselect3">
              <select name="jam_selesai" id="jam_selesai">
                <option value="<?php echo $_POST['jam_selesai']; ?>"><?php if (isset($_POST['jam_selesai']))
				{echo $_POST['jam_selesai'];}else{echo "hour";} ?></option>             
                <option value="00">00</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
              </select>
              </span>
                <select name="menit_selesai" id="menit_selesai">                  
                  <option>00</option>
                  <option>05</option>
                  <option>10</option>
                  <option>15</option>
                  <option>20</option>
                  <option>25</option>
                  <option>30</option>
                  <option>35</option>
                  <option>40</option>
                  <option>45</option>
                  <option>50</option>
                  <option>55</option>
                  <option>59</option>
                </select></td>
          </tr>
        <tr>
          <td>
          <input type="hidden" name="no_reg2" id="no_reg2" value="<?php echo $g_noreg; ?>" />
          <input type="hidden" name="no_id" id="no_id" value="<?php echo $g_noid; ?>" />
          <input type="hidden" name="tgl_reg" id="tgl_reg" value="<?php echo $g_tglreg; ?>" />
          <input type="hidden" name="cek" id="cek" value="<?php echo $g_cek; ?>" /></td>
          <td align="center">&nbsp;</td>
          <td colspan="3" align="right"><label>
            <input type="submit" name="button" id="button" value="Submit" onclick="SaveSnap();"/>
            <input type="reset" name="button2" id="button2" value="Reset" />
          </label></td>
        </tr>
      </table>      
</form>
<?php include('bawah.php');?>
<script type="text/javascript">
<!--
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1");
var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1", {invalidValue:"0"});
var spryselect2 = new Spry.Widget.ValidationSelect("spryselect2", {invalidValue:"0"});
var spryselect3 = new Spry.Widget.ValidationSelect("spryselect3", {invalidValue:"0"});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "integer", {minChars:6, maxChars:13});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextarea2 = new Spry.Widget.ValidationTextarea("sprytextarea2");
//-->
</script>
