<?php
session_start();
session_destroy();
echo $_SESSION['nama'];	
echo "<br>";
echo $_SESSION['telp'];
?>