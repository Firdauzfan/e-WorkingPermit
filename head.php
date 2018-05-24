<?php
if(file_exists('img/header/'.$tempat.'.jpg')){
	$chead = $tempat;
}else{
	$chead = 0;
}
echo 
"<table width='100%' border='0' cellpadding='0'>
  <tr>
    <td><img src='img/header/$chead.jpg' width='100%' height='75%'/></td>
  </tr>
  <tr>
    <td align='right' valign='bottom'  background='img/tab_menu.jpg' width='100%'>";
	include("tabs.php"); 
    echo "</td>
  </tr>
</table>";
?>




