<?php
$rTahun		= date('y');
$rBulan		= date('m');
$rHari		= date('d');
$rJam		= date('h');
$rMenit		= date('i');
$rDetik		= date('s');
$rAcak1 	= rand(1,26);
$rAcak2		= rand(31,56);	
$rAcak3		= rand(10,99);
if($rAcak1 == 1){$cAcak1 = 'A';}
if($rAcak1 == 2){$cAcak1 = 'B';}
if($rAcak1 == 3){$cAcak1 = 'C';}
if($rAcak1 == 4){$cAcak1 = 'D';}
if($rAcak1 == 5){$cAcak1 = 'E';}
if($rAcak1 == 6){$cAcak1 = 'F';}
if($rAcak1 == 7){$cAcak1 = 'G';}
if($rAcak1 == 8){$cAcak1 = 'H';}
if($rAcak1 == 9){$cAcak1 = 'I';}
if($rAcak1 == 10){$cAcak1 = 'J';}
if($rAcak1 == 11){$cAcak1 = 'K';}
if($rAcak1 == 12){$cAcak1 = 'L';}
if($rAcak1 == 13){$cAcak1 = 'M';}
if($rAcak1 == 14){$cAcak1 = 'N';}
if($rAcak1 == 15){$cAcak1 = 'O';}
if($rAcak1 == 16){$cAcak1 = 'P';}
if($rAcak1 == 17){$cAcak1 = 'Q';}
if($rAcak1 == 18){$cAcak1 = 'R';}
if($rAcak1 == 19){$cAcak1 = 'S';}
if($rAcak1 == 20){$cAcak1 = 'T';}
if($rAcak1 == 21){$cAcak1 = 'U';}
if($rAcak1 == 22){$cAcak1 = 'V';}
if($rAcak1 == 23){$cAcak1 = 'W';}
if($rAcak1 == 24){$cAcak1 = 'X';}
if($rAcak1 == 25){$cAcak1 = 'Y';}
if($rAcak1 == 26){$cAcak1 = 'Z';}

if($rAcak2 == 31){$cAcak2 = 'A';}
if($rAcak2 == 32){$cAcak2 = 'B';}
if($rAcak2 == 33){$cAcak2 = 'C';}
if($rAcak2 == 34){$cAcak2 = 'D';}
if($rAcak2 == 35){$cAcak2 = 'E';}
if($rAcak2 == 36){$cAcak2 = 'F';}
if($rAcak2 == 37){$cAcak2 = 'G';}
if($rAcak2 == 38){$cAcak2 = 'H';}
if($rAcak2 == 39){$cAcak2 = 'I';}
if($rAcak2 == 40){$cAcak2 = 'J';}
if($rAcak2 == 41){$cAcak2 = 'K';}
if($rAcak2 == 42){$cAcak2 = 'L';}
if($rAcak2 == 43){$cAcak2 = 'M';}
if($rAcak2 == 44){$cAcak2 = 'N';}
if($rAcak2 == 45){$cAcak2 = 'O';}
if($rAcak2 == 46){$cAcak2 = 'P';}
if($rAcak2 == 47){$cAcak2 = 'Q';}
if($rAcak2 == 48){$cAcak2 = 'R';}
if($rAcak2 == 49){$cAcak2 = 'S';}
if($rAcak2 == 50){$cAcak2 = 'T';}
if($rAcak2 == 51){$cAcak2 = 'U';}
if($rAcak2 == 52){$cAcak2 = 'V';}
if($rAcak2 == 53){$cAcak2 = 'W';}
if($rAcak2 == 54){$cAcak2 = 'X';}
if($rAcak2 == 55){$cAcak2 = 'Y';}
if($rAcak2 == 56){$cAcak2 = 'Z';}

$acak = "$rAcak2$cAcak1$rDetik$cAcak2$rAcak3";
?>