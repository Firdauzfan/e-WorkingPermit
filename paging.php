<span class="paging">
<?php
// Paging
if($total_pages > 1){
	if($hal > 1){
		$prev = ($page - 1);
		if ($cari == ""){
		echo "<a href=$_SERVER[PHP_SELF]?hal=$prev><font color='#0000FF' >Prev</font></a> "; 
		}else{
			echo "<a href=$_SERVER[PHP_SELF]?cari=$cari&hal=$prev><font color='#0000FF' >Prev</font></a> "; 
		}		
	}else{
		echo "<font color='#CCCCCC'>Prev</font>";
	}
	for($i = 1; $i <= $total_pages; $i++){
		if ((($i >= $hal - 3) && ($i <= $hal + 3)) || ($i == 1) || ($i == $total_pages)){
			if (($showPage == 1) && ($i != 2)){
				echo "<font color='#CCCCCC'>...</font>";
			}
			if (($showPage != ($total_pages - 1)) && ($i == $total_pages)){
				echo  "<font color='#CCCCCC'>...</font>";
			}
			if ($i == $hal){
				echo " <font color='#CCCCCC'>$i</font> ";
			}else{
				if ($cari == ""){
					echo "<a href=$_SERVER[PHP_SELF]?hal=$i><font color='#0000FF' >$i</font></a> "; 
				}else{
					echo "<a href=$_SERVER[PHP_SELF]?cari=$cari&hal=$i><font color='#0000FF' >$i</font></a> "; 
				}		
				$showPage = $i;
			}
		}
	}
	if($hal < $total_pages){
		$next = ($page + 1);
		if ($cari == ""){
			echo "<a href=$_SERVER[PHP_SELF]?hal=$next><font color='#0000FF' >Next</font></a> "; 
		}else{
			echo "<a href=$_SERVER[PHP_SELF]?cari=$cari&hal=$next><font color='#0000FF' >Next</font></a> "; 
		}		
	}else{
		echo "<font color='#CCCCCC'>Next</font>";
	}
}
?>
</span>