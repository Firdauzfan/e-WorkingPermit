<?php
if(file_exists('img/header/'.$tempat.'.jpg')){
	$chead = $tempat;
}else{
	$chead = 0;
}
echo 
"<table width='100%' border='0' cellpadding='0'>
  <tr>
    <td><img src='img/header/$chead.jpg' width='976' /></td>
  </tr>
  <tr>
    <td align='right' valign='bottom'  background='img/tab_menu.jpg'>";
	include("tabs.php"); 
    echo "</td>
  </tr>
</table>";
?>




