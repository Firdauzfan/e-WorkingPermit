<?php 
if(!isset($building)){
	$cfoot	= "E-WORKING PERMIT";
}else{
	$cfoot = $building;
}
echo "<table width='100%' border='0' align='center'>
<tr><td height='40' background='img/foother.JPG'><marquee behavior='scroll' scrolldelay='200' >
<font color='#FFFFFF'><strong>$cfoot</strong></font></marquee></td></tr></table>";
?>
