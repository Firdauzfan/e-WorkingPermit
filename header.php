<?php 
if(file_exists('img/header/'.$tempat.'.jpg')){
	$chead = $tempat;
}else{
	$chead = 0;
}
echo 
"<table width='100%' border='0' cellpadding='0' cellspacing='0'> 
	<tr>
    	<td><img src='img/header/$chead.jpg' width='976' /></td>
  	</tr>
</table>";
?>
