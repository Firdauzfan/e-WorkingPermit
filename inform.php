<?php
include('palidasi.php');
require_once('Connections/konek.php');
$sql 		= "SELECT * FROM tb_info where lok='$tempat' ";
$sql_query	= mysql_query($sql, $konek) or die(mysql_error());
$result		= mysql_fetch_assoc($sql_query); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
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
</script>

<head>
<title>Informasi</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;	
}
a:hover {
	text-decoration: none;	
}
a:active {
	text-decoration: none;	
}
	
.infoisi {
	font-size: 10pt;
	color: #575757;
}
.judul {font-size: 9pt;
	font-weight: normal;
	color: #999;
	font-family: "Courier New", Courier, monospace;
}
-->
</style>

<?php
    $sql1 ="select value from tb_config where path='path'";
    $r = mysql_query($sql1);
    $d = mysql_fetch_array($r);
    $path = $d['value'];
  ?>

</head>
<body onload="MM_preloadImages('../wp1/img/i_regwpa.jpg','../wp1/img/i_reglista.jpg','../wp1/img/i_wplista.jpg','../wp1/img/i_passworda.jpg','../wp1/img/i_myaccounta.jpg')">
<table width="980" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php include("head.php"); ?></td>
  </tr>
  <tr>
    <td><table width="100%" cellpadding="0">
      <tr>
        <td><table width="99%" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td nowrap="nowrap"><span class="judul">Information</span></td>
            <td align="right" nowrap="nowrap"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
           <td width="22%" valign="top"><img src="../wp1/img/LogoX.png" width="210" height="199" /></td>
            <td width="78%" bordercolor="#666666" ><table border="0" cellspacing="0" cellpadding="5" class="">
               <tr>
                 <td>SELAMAT DATANG DI MENU E-WORKING PERMIT UNTUK DEPARTMENT IN CHARGE <br />
             Menu-menu yang dapat digunakan sebagai berikut:<br /><br />

<table border="0" cellpadding="1" cellspacing="0" class="infoisi">
  <tr>

                     <td valign="middle">1.</td>
                     <td><a href="regkerjaibfm.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image20','','../wp1/img/i_regwpa.jpg',1)"><img src="../wp1/img/i_regwp.jpg" name="Image20" width="98" height="40" border="0" id="Image20" /></a></td>
                     <td valign="top"><span class="infoisi">Digunakan untuk meregistrasikan vendor anda untuk bekerja. Registrasi
                      dilakukan setiap kali vendor anda ingin mengajukan working permit</span>.</td>
                   </tr>
                   <tr>
                     <td valign="middle">2.</td>
                     <td><a href="reg_list_di.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','../wp1/img/i_reglista.jpg',1)"><img src="../wp1/img/i_reglist.jpg" name="Image21" width="98" height="40" border="0" id="Image21" /></a></td>
                     <td valign="top" class="infoisi">Menampilkan data registrasi yang pernah anda buat dan menampilkan nomor
                      registrasi yang harus anda serahkan kepada vendor anda untuk pembuatan working permit. </td>
                   </tr>
                   <tr>
                     <td valign="middle">3.</td>
                     <td><a href="wp_list_di.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image22','','../wp1/img/i_wplista.jpg',1)"><img src="../wp1/img/i_wplist.jpg" name="Image22" width="98" height="40" border="0" id="Image22" /></a></td>
                     <td valign="top" class="infoisi">Menampilkan data working permit yang telah vendor anda buat.</td>
                   </tr>
                   <tr>
                     <td valign="middle">4.</td>
                     <td><a href="password.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image23','','../wp1/img/i_passworda.jpg',1)"><img src="../wp1/img/i_password.jpg" name="Image23" width="98" height="40" border="0" id="Image23" /></a></td>
                     <td valign="top" class="infoisi">Digunakan untuk mengganti password </td>
                   </tr>
                   <tr>
                     <td valign="middle">5.</td>
                     <td><a href="user_edit.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image24','','../wp1/img/i_myaccounta.jpg',1)"><img src="../wp1/img/i_myaccount.jpg" name="Image24" width="98" height="40" border="0" id="Image24" /></a></td>
                     <td valign="top" class="infoisi">Digunakan untuk mengubah data diri, seperti Department,
                      Email, Phone, Title dan Photo</td>
                   </tr>
               </table>
             <p class="infoisi">Note; Nomor Registrasi working permit didapat setelah registrasi working permit anda diapprove oleh pihak Facility Management <?php  echo $building;?>, untuk mempercepat proses approve silahkan menghubungi Facility Management <?php  echo $building;?> di ext <?php  echo $result['extfm'];?>.<br />
               Terima kasih.</td>
               </tr>
             </table></td>           
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php include("foot.php"); ?></td>
  </tr>
</table>
</body>
</html>
