<?php
include('palidasi.php'); 
require_once('Connections/konek.php'); 

$pesan = "";
if(isset($s_userid)){
	$sql 		= "SELECT * FROM tb_user WHERE no_id = '$s_userid'";
	$sql_query 	= mysql_query($sql,$konek) or die(mysql_error());
	$result		= mysql_fetch_assoc($sql_query);
	$password 	= $result['password'];
	
	if (isset($_POST["password0"]) && $_POST['password0'] != ''){		
		$password0 = md5($_POST['password0']);
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$password3 = $_POST['password0']; 	
		
		if(strlen($password0) < 6 || strlen($password1) < 6 || strlen($password2) < 6){
			$pesan = "* Password harus diisi minimal 6 karakter";	
		}elseif($password0 != $password){
			$pesan = "* Password Lama Salah";	
		}elseif($password1 != $password2){
			$pesan = "* Confirm Password Salah";		
		}elseif($password0 == md5($password1)){
			$pesan = "* Password lama dan baru masih sama";
		}else{
			$new_password 	= md5($password1);
			$sql_update 	= "UPDATE tb_user SET  password='$new_password' WHERE no_id='$s_userid'";
			$Result1 		= mysql_query($sql_update, $konek) or die(mysql_error());			
			$pesan 			= "* Perubahan password berhasil";
			$password1 		= '';
			$password2 		= '';
			$password3 		= '';
		}
	}
}
?>
<?php 
$judul 		= "Change Password";
$title 		= "$judul";
$refresh 	= "";
include('doctype.php');
include("cssjs.php"); 
?>        
<script type="text/javascript">
      $(document).ready(function() {
		  $("#password0").focus();
  	    $(':input:not([type="submit"]):not([type="reset"])').each(function() {
	        $(this).focus(function() {
	            $(this).addClass('hilite');
	        }).blur(function() {
	            $(this).removeClass('hilite');});
	     });
      });    
</script>
<?php include("atas.php"); ?>
	<form action="" method="post" name="form1" id="form1">
        <table border="1" cellpadding="5" cellspacing="10" align="center">
          <tr>
            <td><table border="0" cellpadding="2" cellspacing="1">
              <tr>
                <td align="left">Old Password</td>
                <td align="center">:</td>
                <td align="left">
                <span id="sprypassword1">          
                <label>
                  <input type="password" name="password0" id="password0"  
                value="<?php echo $password3; ?>"/>
                  <span class="passwordMinCharsMsg">Minimum 6 number of characters.</span></label>
                </span>                
                </td>
              </tr>
              <tr>
                <td align="left">New Password</td>
                <td align="center">:</td>
                <td align="left">
                <span id="sprypassword2">         
                <label>
                  <input type="password" name="password1" id="password1"  
                value="<?php echo $password1; ?>"/>
                  <span class="passwordMinCharsMsg">Minimum 6 number of characters.</span></label>
                </span> 
              </tr>
              <tr>
                <td align="left">Confirm Password</td>
               <td align="center">:</td>
                <td align="left">
                <span id="sprypassword3">        
                <label>
                  <input type="password" name="password2" id="password2"  
                value="<?php echo $password2; ?>"/>
                  <span class="passwordMinCharsMsg">Minimum 6 number of characters.</span></label>
                </span> 
                </td>
              </tr>
              <tr>
                <td align="left" nowrap="nowrap">&nbsp;</td>
                <td align="center">&nbsp;</td>
                <td align="right" nowrap="nowrap"><label>
                  <input type="submit" name="Save" id="Save" value="Change" />
                  </label></td>
              </tr>
              </table></td>
          </tr>
        </table>
        </form>
<?php include('bawahb.php');?>
<script type="text/javascript">
<!--
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:6});
var sprypassword2 = new Spry.Widget.ValidationPassword("sprypassword2", {minChars:6});
var sprypassword3 = new Spry.Widget.ValidationPassword("sprypassword3", {minChars:6});
//-->
</script>
