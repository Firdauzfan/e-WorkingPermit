<?php   
	  if($s_bagian == "Facility Management") {
		  include("tab_fm.php");
	  }elseif($s_bagian == "In Building") {
		  include("tab_ib.php");
	  }elseif($s_bagian == "Admin") {
		  include("tab_admin.php");
	  }elseif($s_bagian == "Departement") {
		  include("tab_di.php");
	  }elseif($s_bagian == "Security" or $s_bagian == "Maintenance") {
		  include("tab_user.php");
	  }else{  	  
	  include("tab.php");	  
	  }
 ?>