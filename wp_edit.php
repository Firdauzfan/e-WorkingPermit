<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
require_once('Connections/konek.php'); 
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

session_start();
if(isset($_SESSION['MM_Username'])){
   $username = $_SESSION['MM_Username'];   
  
if (isset($_GET['no_wp'])) {
  	$wp_id = $_GET['no_wp'];
	$sql 		= "SELECT * FROM `$tb_wp` WHERE `no_wp` = '$wp_id'";
	$sqlquery 	= mysql_query($sql,$konek) or die(mysql_error());
	$rowe 		= mysql_fetch_assoc($sqlquery);
	$jam1 		= $rowe['jam_mulai']; 
	$jam2 		= $rowe['jam_selesai'];
	$jam3 		= $rowe['jam_mulai_1']; 
	$jam4 		= $rowe['jam_selesai_1'];
	if ($jam1 == '00:00:00'){
		$jam1 = '';
	}
	if ($jam2 == '00:00:00'){
		$jam2 = '';
	}
	if ($jam3 == '00:00:00'){
		$jam3 = '';
	}
	if ($jam4 == '00:00:00'){
		$jam4 = '';
}}}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<style type="text/css">
<!--
.eng {	font-style: italic;
	font-family: "MS Serif", "New York", serif;
	font-size: 10px;
	color: #666;
}
.grs {	text-decoration: underline;
	font-family: "MS Serif", "New York", serif;
	font-size: 14px;
}
.jdl {
	color: #963;
	font-family: "MS Serif", "New York", serif;
	font-size: 16px;
	font-style: normal;
	font-weight: bold;
	text-transform: uppercase;
	text-decoration: underline;
}
#jd {	color: #F00;
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 36px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #00F;
}
a:hover {
	text-decoration: underline;
	color: #900;
}
a:active {
	text-decoration: none;
}
a {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 14pt;
}
-->
</style>
</head>

<body  onload="MM_preloadImages('img/t_home1.jpg','img/t_Workingpermit1.jpg','img/t_contact1.jpg','img/t_download1.jpg')">

<table width="980"  border="0" align="center" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF">
<tr>
  <td><table width="100%" border="0">
    <tr>
      <td><?php include('header.php');?></td>
      </tr>
    <tr>
      <td align="right" valign="bottom"  background="img/tab_menu.jpg"><?php include ("tab.php");?></td>
      </tr>
  </table></td>
  </tr>

  <tr>
    <td><form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
      <table width="980" border="0" align="center" cellpadding="0" cellspacing="1">
        <tr>
          <td colspan="13" align="left" valign="bottom" bgcolor="#CCCCCC"><table width="100%" border="0" cellspacing="0" cellpadding="3">
            <tr>
                <td valign="top"><strong id="jd">E-Working Permit</strong></td>
              <td align="right" valign="bottom"><label>
                NO WP 
                    <input name="no_wp" type="text" id="no_wp" value="<?php echo $wp_id; ?>" size="10" readonly="readonly" />
              </label></td>
              </tr>
          </table></td>
          </tr>
        <tr>
          <td height="2" bgcolor="#0000FF"colspan="13"></td>
        </tr>
        <tr>
          <td colspan="3" ><u class="grs">GEDUNG</u><br />
            <em class="eng">BUILDING</em></td>
          <td width="196" >:
            <label>
              <input name="gedung" type="text" id="gedung" value="JNB Bintaro" size="8" />
            </label></td>
          <td width="115" align="left">&nbsp;</td>
          <td width="41" align="left">&nbsp;</td>
          <td width="83" align="left"><u class="grs">LANTAI</u><br />
            <span class="eng"><em>FLOOR</em></span></td>
          <td width="140" align="left">:
            <label>
              <input name="lantai" type="text" id="lantai" size="10" />
            </label></td>
          <td width="22" align="left">&nbsp;</td>
          <td width="115" align="right">STATUS</td>
          <td width="134" align="right"><label> :
            <select name="status" id="status">
              <option selected="selected"> </option>
              <option>Baru</option>
              <option>Perpanjang</option>
              <option>Maintenance</option>
              <option>Lain-lain</option>
            </select>
          </label></td>
        </tr>
        <tr>
          <td colspan="4" bgcolor="#CCCCCC"><span class="jdl">KONTRAKTOR</span><br />
            <em class="eng">CONTRACTOR&nbsp;</em></td>
          <td colspan="9" bgcolor="#CCCCCC"><input name="kontraktor" type="text" id="kontraktor" size="30" /></td>
          </tr>
        <tr>
          <td width="15">&nbsp;</td>
          <td width="41">A.</td>
          <td colspan="2"><span class="grs">NAMA</span><br />
            <em class="eng">NAME</em></td>
          <td colspan="4"><label>
            <input name="nama_kontraktor" type="text" id="nama_kontraktor" size="35" />
          </label></td>
          <td colspan="5" rowspan="8" align="center" valign="top" bgcolor="#CCCCCC"><?php include("kalender.php");?></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="2"><span class="grs">TELP / NO. HP<br />
          </span><span class="eng">PHONE </span></td>
          <td colspan="4"><label>
            <input name="telp_kontraktor" type="text" id="telp_kontraktor" size="30" />
            <br />
          </label></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>C.</td>
          <td colspan="2"><span class="grs">JUMLAH ORANG</span><br />
            <span class="eng">QUANTITY OF PERSON</span></td>
          <td colspan="4"><label>
            <input name="jml_orang" type="text" id="jml_orang" size="10" />
            Orang</label></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>D.</td>
          <td colspan="2"><span class="grs">JENIS PEKERJAAN</span><br />
            <span class="eng">JOB DESCRIPTION </span></td>
          <td colspan="4"><label>
            <textarea name="jns_pekerjaan" id="jns_pekerjaan" cols="35" rows="2"></textarea>
          </label></td>
          </tr>
        <tr>
          <td colspan="4" bgcolor="#CCCCCC" class="jdl">DEPARTEMENT INCHARGE</td>
          <td colspan="4" bgcolor="#CCCCCC" class="jdl"><input name="dept_incharge" type="text" id="dept_incharge" size="28" /></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>A.</td>
          <td colspan="2"><span class="grs">NAMA</span><br />
            <em class="eng">NAME</em></td>
          <td colspan="4"><input name="nama_dept" type="text" id="nama_dept" size="35" /></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="2"><span class="grs">NOMER ID</span><br />
            <span class="eng">ID NUMBER</span></td>
          <td colspan="4"><span class="eng">
            <input type="text" name="no_id" id="no_id" />
          </span></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>C.</td>
          <td colspan="2"><span class="grs">TELP / NO. HP<br />
          </span><span class="eng">PHONE </span></td>
          <td colspan="4"><span class="eng">
            <input name="telp_dept" type="text" id="telp_dept" size="30" />
          </span></td>
          </tr>
        <tr>
          <td colspan="13" bgcolor="#CCCCCC"><span class="grs"><span class="jdl">JADWAL DI hari  KERJA</span></span><br />
            <span class="eng">WORKING DAYS&nbsp;</span></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>A.</td>
          <td colspan="2"><span class="grs">TANGGAL </span><br />
            <span class="eng">  DATE</span></td>
          <td colspan="9" rowspan="2" valign="top"><table width="61%" border="0">
            <tr>
              <td width="41%"><label>
                <select name="thn_m1" id="thn_m1">
                  <option></option>
                  <option><?php echo date('Y') ?> </option>
                  <option><?php echo date('Y')+1 ?> </option>                 
                  </select>
                <select name="bln_m1" id="bln_m1">
                  <option></option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  </select>
                <select name="tgl_m1" id="tgl_m1">
                  <option></option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
                  </select>
                </label></td>
              <td width="10%" align="left">s. d </td>
              <td width="49%"><select name="thn_m2" id="thn_m2">
                <option></option>
                <option><?php echo date('Y') ?> </option>
                  <option><?php echo date('Y')+1 ?> </option>   
                </select>
                <select name="bln_m2" id="bln_m2">
                  <option></option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  </select>
                <select name="tgl_m2" id="bln_m4">
                  <option></option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
                  </select></td>
              </tr>
            <tr>
              <td><select name="jam_m1" id="bln_m6">
                <option></option>
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
                </select>
                <select name="menit_m1" id="bln_m5">
                  <option></option>
                  <option>00</option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
                  <option>32</option>
                  <option>33</option>
                  <option>34</option>
                  <option>35</option>
                  <option>36</option>
                  <option>37</option>
                  <option>38</option>
                  <option>39</option>
                  <option>40</option>
                  <option>41</option>
                  <option>42</option>
                  <option>43</option>
                  <option>44</option>
                  <option>45</option>
                  <option>46</option>
                  <option>47</option>
                  <option>48</option>
                  <option>49</option>
                  <option>50</option>
                  <option>51</option>
                  <option>52</option>
                  <option>53</option>
                  <option>54</option>
                  <option>55</option>
                  <option>56</option>
                  <option>57</option>
                  <option>58</option>
                  <option>59</option>
                  </select></td>
              <td align="left">s.d</td>
              <td><select name="jam_m2" id="bln_m7">
                <option></option>
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
                </select>
                <select name="menit_m2" id="bln_m8">
                  <option></option>
                  <option>00</option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
                  <option>32</option>
                  <option>33</option>
                  <option>34</option>
                  <option>35</option>
                  <option>36</option>
                  <option>37</option>
                  <option>38</option>
                  <option>39</option>
                  <option>40</option>
                  <option>41</option>
                  <option>42</option>
                  <option>43</option>
                  <option>44</option>
                  <option>45</option>
                  <option>46</option>
                  <option>47</option>
                  <option>48</option>
                  <option>49</option>
                  <option>50</option>
                  <option>51</option>
                  <option>52</option>
                  <option>53</option>
                  <option>54</option>
                  <option>55</option>
                  <option>56</option>
                  <option>57</option>
                  <option>58</option>
                  <option>59</option>
                  </select></td>
              </tr>
          </table></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="2"><span class="grs">JAM </span><br />
            <span class="eng"> TIME</span></td>
          </tr>
        <tr>
          <td colspan="13" bgcolor="#CCCCCC"><span class="grs"><span class="jdl">UNTUK hari  SABTU DAN HARI LIBUR</span></span><br />
            <span class="eng">WORKING DAYS&nbsp;</span><br /></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>A.</td>
          <td colspan="2"><span class="grs">TANGGAL </span><br />
            <span class="eng"> DATE</span></td>
          <td colspan="9" rowspan="2" align="left" valign="top"><table width="61%" border="0">
            <tr>
              <td width="40%"><label>
                <select name="thn_m3" id="thn_m3">
                  <option></option>
                  <option><?php echo date('Y') ?> </option>
                  <option><?php echo date('Y')+1 ?> </option>   
                </select>
                <select name="bln_m3" id="bln_m3">
                  <option></option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                </select>
                <select name="tgl_m3" id="tgl_m3">
                  <option></option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
                </select>
              </label></td>
              <td width="10%" align="left">s. d </td>
              <td width="50%"><select name="thn_m4" id="thn_m4">
                <option></option>
                <option><?php echo date('Y') ?> </option>
                  <option><?php echo date('Y')+1 ?> </option>   
              </select>
                <select name="bln_m4" id="bln_m9">
                  <option></option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                </select>
                <select name="tgl_m4" id="bln_m10">
                  <option></option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
                </select></td>
            </tr>
            <tr>
              <td><select name="jam_m3" id="jam_m">
                <option></option>
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
              </select>
                <select name="menit_m3" id="menit_m">
                  <option></option>
                  <option>00</option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
                  <option>32</option>
                  <option>33</option>
                  <option>34</option>
                  <option>35</option>
                  <option>36</option>
                  <option>37</option>
                  <option>38</option>
                  <option>39</option>
                  <option>40</option>
                  <option>41</option>
                  <option>42</option>
                  <option>43</option>
                  <option>44</option>
                  <option>45</option>
                  <option>46</option>
                  <option>47</option>
                  <option>48</option>
                  <option>49</option>
                  <option>50</option>
                  <option>51</option>
                  <option>52</option>
                  <option>53</option>
                  <option>54</option>
                  <option>55</option>
                  <option>56</option>
                  <option>57</option>
                  <option>58</option>
                  <option>59</option>
                </select></td>
              <td align="left">s.d</td>
              <td><select name="jam_m4" id="jam_m2">
                <option></option>
                <option>01</option>
                <option>02</option>
                <option>03</option>
                <option>04</option>
                <option>05</option>
                <option>06</option>
                <option>07</option>
                <option>08</option>
                <option>09</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
              </select>
                <select name="menit_m4" id="menit_m2">
                  <option></option>
                  <option>00</option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
                  <option>32</option>
                  <option>33</option>
                  <option>34</option>
                  <option>35</option>
                  <option>36</option>
                  <option>37</option>
                  <option>38</option>
                  <option>39</option>
                  <option>40</option>
                  <option>41</option>
                  <option>42</option>
                  <option>43</option>
                  <option>44</option>
                  <option>45</option>
                  <option>46</option>
                  <option>47</option>
                  <option>48</option>
                  <option>49</option>
                  <option>50</option>
                  <option>51</option>
                  <option>52</option>
                  <option>53</option>
                  <option>54</option>
                  <option>55</option>
                  <option>56</option>
                  <option>57</option>
                  <option>58</option>
                  <option>59</option>
                </select></td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>B.</td>
          <td colspan="2"><span class="grs">JAM </span><br />
            <span class="eng"> TIME</span></td>
          </tr>
        <tr>
          <td height="31" colspan="13" align="right" bgcolor="#CCCCCC"><input type="submit" name="submit" id="submit" value="Simpan" />            <input type="reset" name="reset" id="reset" value="Batal" /></td>
        </tr>
        </table>
      <input type="hidden" name="MM_insert" value="form1" />
      <input type="hidden" name="MM_insert" value="form1" />
    </form></td>
  </tr>

  <tr>
    <td> <img src="img/foother.JPG" width=100%/>
  </td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($rec_wp_input);
?>
