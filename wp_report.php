<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
include('palidasi.php'); 
if ($s_bagian != 'Admin'){header('Location: '.'login.php');}
require_once('Connections/konek.php'); 
include('page.php');

if (isset($_POST["thn"])){
	$thn = $_POST["thn"];	 
	if ($_POST["bulan"] == "Januari"){
		$bln = 1;
	}
	if ($_POST["bulan"] == "Februari"){
		$bln = 2;
	}
	if ($_POST["bulan"] == "Maret"){
		$bln = 3;
	}
	if ($_POST["bulan"] == "April"){
		$bln = 4;
	}
	if ($_POST["bulan"] == "Mei"){
		$bln = 5;
	}
	if ($_POST["bulan"] == "Juni"){
		$bln = 6;
	}
	if ($_POST["bulan"] == "Juli"){
		$bln = 7;
	}
	if ($_POST["bulan"] == "Agustus"){
		$bln = 8;
	}
	if ($_POST["bulan"] == "September"){
		$bln = 9;
	}
	if ($_POST["bulan"] == "Oktober"){
		$bln = 10;
	}
	if ($_POST["bulan"] == "November"){
		$bln = 11;
	}
	if ($_POST["bulan"] == "Desember"){
		$bln = 12;
	}
	
	$sql 		= "SELECT * FROM $tb_wp where month(tgl0) = $bln and year(tgl0) = $thn ORDER BY `no_wp` asc ";
	$query_jml 	= "SELECT count(*) as num FROM $tb_wp where month(tgl0) = $bln and year(tgl0) = $thn ORDER BY `no_wp` asc ";
}else{
	$sql 		= "SELECT * FROM $tb_wp ORDER BY `no_wp` asc ";
	$sql 		= sprintf("%s LIMIT %d, %d", $sql, $startRow, $maxRows);
	$query_jml = "SELECT count(*) as num FROM $tb_wp";
}

$Recordset1 	= mysql_query( $sql, $konek) or die(mysql_error());
$result			= mysql_fetch_assoc($Recordset1);
$hasil_jml 		= mysql_query($query_jml, $konek) or die(mysql_error());
$banyak_jml 	= mysql_fetch_assoc($hasil_jml);
$jml_row 		= $banyak_jml['num'];
$total_pages 	= ceil($jml_row / $maxRows);
?>
<?php 
$judul 		= "Working Permit Report";
$title 		= "$judul";
$refresh 	= "";
include('doctype.php');
?>
<link href="css/utama.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><?php include("head.php"); ?></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
              <td width="35%" nowrap="nowrap"><span class="judul"><?php echo $judul;?></span></td>
              <td width="65%" align="right" nowrap="nowrap"><label>
                <select name="bulan" id="bulan" style="height:14pt; font-size:11px;">
                  <option value="Januari" <?php if (!(strcmp("Januari", $_POST['bulan']))) 
			  {echo "selected=\"selected\"";} ?>>Januari</option>
                  <option value="Februari" <?php if (!(strcmp("Februari", $_POST['bulan']))) 
			  {echo "selected=\"selected\"";} ?>>Februari</option>
                  <option value="Maret" <?php if (!(strcmp("Maret", $_POST['bulan']))) {echo "selected=\"selected\"";} ?>>Maret</option>
                  <option value="April" <?php if (!(strcmp("April", $_POST['bulan']))) {echo "selected=\"selected\"";} ?>>April</option>
                  <option value="Mei" <?php if (!(strcmp("Mei", $_POST['bulan']))) {echo "selected=\"selected\"";} ?>>Mei</option>
                  <option value="Juni" <?php if (!(strcmp("Juni", $_POST['bulan']))) {echo "selected=\"selected\"";} ?>>Juni</option>
                  <option value="Juli" <?php if (!(strcmp("Juli", $_POST['bulan']))) {echo "selected=\"selected\"";} ?>>Juli</option>
                  <option value="Agustus" <?php if (!(strcmp("Agustus", $_POST['bulan']))) 
			  {echo "selected=\"selected\"";} ?>>Agustus</option>
                  <option value="September" <?php if (!(strcmp("September", $_POST['bulan']))) 
			  {echo "selected=\"selected\"";} ?>>September</option>
                  <option value="Oktober" <?php if (!(strcmp("Oktober", $_POST['bulan']))) 
			  {echo "selected=\"selected\"";} ?>>Oktober</option>
                  <option value="November" <?php if (!(strcmp("November", $_POST['bulan']))) 
			  {echo "selected=\"selected\"";} ?>>November</option>
                  <option value="Desember" <?php if (!(strcmp("Desember", $_POST['bulan']))) 
			  {echo "selected=\"selected\"";} ?>>Desember</option>
                </select>
                <select name="thn" id="thn" style="height:14pt; font-size:11px;" >
                  <option value="2018" <?php if (!(strcmp(2017, $_POST['thn']))) {echo "selected=\"selected\"";} ?>>2018</option>
                  <option value="2019" <?php if (!(strcmp(2018, $_POST['thn']))) {echo "selected=\"selected\"";} ?>>2019</option>
				          <option value="2020" <?php if (!(strcmp(2019, $_POST['thn']))) {echo "selected=\"selected\"";} ?>>2020</option>
                </select>
              </label>
                <input name="cari" type="submit" value="Filter..." style="height:16pt; font-size:9px" /></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">
            <tr class="head">
              <th rowspan="2">No</th>
              <th rowspan="2">No WP</th>
              <th colspan="2">Tanggal</th>
              <th rowspan="2">Nama Vendor</th>
              <th rowspan="2">Jenis Pekerjaan</th>
              <th rowspan="2">Lantai</th>
              <th rowspan="2">Personil</th>
            </tr>
            <tr class="head">
              <th>Mulai</th>
              <th>Selesai</th>
            </tr>
            <?php do { ?>
            <?php 
		  $no_wp 	= $result['no_wp'];		 
		  $nomer 	= $nomer+1; 
		  $sts 		=  $result['sts'];
		  $tgl1 	=  $result['tgl1'];
		  $tgl2 	=  $result['tgl2'];
		  $tgl3 	=  $result['tgl3'];
		  $tgl4 	=  $result['tgl4'];
		  $tgl5 	=  $result['tgl5'];
		  $tgl6 	=  $result['tgl6'];
		  $tgl7 	=  $result['tgl7'];		  
          include('tgl.php');		 
		  ?>
            <tr class="isi" height="21">
              <td><?php if($jml_row > 0 ){ echo  $nomer; }?></td>
              <td><?php echo $no_wp; ?></td>
              <td nowrap="nowrap"><?php echo $mulai; ?></td>
              <td nowrap="nowrap"><?php echo $selesai; ?></td>
              <td align="left"><?php echo strtoupper($result['kontraktor']); ?></td>
              <td align="left"><?php echo ucwords(strtolower($result['jns_pekerjaan'])); ?></td>
              <td nowrap="nowrap"><?php echo $result['lantai']; ?></td>
              <td nowrap="nowrap"><?php echo $result['jml_orang']; ?>
                <?php if($jml_row > 0 ){ echo  ' Orang'; }?></td>
            </tr>
            <?php } while ($result= mysql_fetch_assoc($Recordset1)); ?>
            <tr class="isik">
              <td colspan="15"><?php  
		  if (!isset($_POST["thn"]))  { 
		  include("paging.php"); }
		  ?></td>
            </tr>
          </table>
<?php include('bawahc.php');?>
