<?php 
error_reporting(E_ALL ^ (E_NOTICE|E_WARNING));
require_once('Connections/konek.php');
$sql 		= "SELECT * FROM tb_user where bagian = 'Admin' and no_id !='12078212' and no_id !='12345678' and lokasi = '$tempat' and status = 'Aktif'";
$sql_query 	= mysql_query($sql, $konek) or die(mysql_error());
$result		= mysql_fetch_assoc($sql_query); 

$sql2 		= "SELECT * FROM tb_info where lok='$tempat' ";
$sql_query2	= mysql_query($sql2, $konek) or die(mysql_error());
$result2	= mysql_fetch_assoc($sql_query2); 
?>
<?php 
$judul 		= "Information";
$title 		= "$judul";
include('doctype.php');
include('fancy.php');
?>
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="css/utama.css" rel="stylesheet" type="text/css" />
<?php include('atas.php');?>
      <table width="100%" border="0" cellpadding="0">
        <tr>
          <td align="left"><div id="TabbedPanels1" class="TabbedPanels">
            <ul class="TabbedPanelsTabGroup">
              <li class="TabbedPanelsTab" tabindex="0">Contact</li>
              <li class="TabbedPanelsTab" tabindex="0">Peraturan Kerja</li>
              <li class="TabbedPanelsTab" tabindex="0">Contoh Form Ijin Kerja</li>
              <li class="TabbedPanelsTab" tabindex="0">Departement In charge</li>
              <li class="TabbedPanelsTab" tabindex="0">Kontraktor / Vendor</li>
              <li class="TabbedPanelsTab" tabindex="0">Halaman Muka</li>
            </ul>
            <div class="TabbedPanelsContentGroup">
              <div class="TabbedPanelsContent">
                <table width="100%" cellpadding="0" cellspacing="0">
                  <tr>
                    <td colspan="2" align="left"><span class="had">Facility Management</span><br />
                     
                      
                      </td>
                    <td colspan="2" align="left"><span class="had">Maintenance</span><br />
                      
                      
                    </td>
                  </tr>
                  <tr>
                    <td width="9%" align="left">Lantai </td>
                    <td width="41%" align="left">: <?php  echo $result2['lantaifm']; ?></td>
                    <td width="10%" align="left">Lantai </td>
                    <td width="40%" align="left">: 
                      <?php  echo $result2['lantaimt']; ?></td>
                  </tr>
                  <tr>
                    <td align="left">Ruangan</td>
                    <td align="left">: <?php  echo $result2['ketfm']; ?></td>
                    <td align="left">Ruangan</td>
                    <td align="left">: 
                      <?php  echo $result2['ketmt']; ?></td>
                  </tr>
                  <tr>
                    <td align="left">Phone  Ext </td>
                    <td align="left">: <?php  echo $result2['extfm']; ?></td>
                    <td align="left">Phone Ext  </td>
                    <td align="left">: 
                      <?php  echo $result2['extmt']; ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left"><span class="had">In Building</span><br />
                     
                      
                      </td>
                    <td colspan="2" align="left"><span class="had">Security</span><br />
                      
                      
                    </td>
                  </tr>
                  <tr>
                    <td align="left">Lantai  </td>
                    <td align="left">: 
                      <?php  echo $result2['lantaiib']; ?></td>
                    <td align="left">Lantai </td>
                    <td align="left">: 
                      <?php  echo $result2['lantaist']; ?></td>
                  </tr>
                  <tr>
                    <td align="left">Ruangan</td>
                    <td align="left">: 
                      <?php  echo $result2['ketib']; ?></td>
                    <td align="left">Ruangan</td>
                    <td align="left">: 
                      <?php  echo $result2['ketst']; ?></td>
                  </tr>
                  <tr>
                    <td align="left">Phone  Ext  </td>
                    <td align="left">: 
                      <?php  echo $result2['extib']; ?></td>
                    <td align="left"> Phone Ext  </td>
                    <td align="left">: 
                      <?php  echo $result2['extst']; ?></td>
                  </tr>
                  <tr>
                    <td colspan="4" align="left"><span class="had">Admin</span>
                      <table width="333">
                        <?php	
	  
	  			do { ?>
                        <?php 
          $sql1 ="select value from tb_config where path='path'";
          $r = mysql_query($sql1);
          $d = mysql_fetch_array($r);
          $path = $d['value'];

				  $nomer 	= $nomer+1;
				  $nama 	= $result['nama'];
				  $no_id 	= $result['no_id'];
				  $telp 	= $result['telp'];
				  $email 	= $result['email'];
				  $bagian 	= $result['title'];
				  $photo 	= $result['photo'];				  
				  $photo 	= $path."/".$photo;
				  ?>
                        <tr >
                          <td width="51" align="center" valign="middle" nowrap="nowrap">
                          <img src="<?php echo $photo; ?>" href = "<?php echo $photo; ?>" class ="classfancy" title="<?php echo $nama;?>" 
                          width="59" height="62" border="1" align="middle" style="border-collapse:#FC0" /></td>
                          <td width="190" align="left" nowrap="nowrap"><table width="264" border="0" cellpadding="0"
                           cellspacing="2" class="id">
                            <tr>
                              <td width="49" align="left" nowrap="nowrap" class="id">Name</td>
                              <td width="12" align="left">:</td>
                              <td width="195" align="left" nowrap="nowrap"><?php echo $nama; ?></td>
                            </tr>
                            <tr>
                              <td align="left" nowrap="nowrap" class="id">Position</td>
                              <td align="left">:</td>
                              <td align="left" nowrap="nowrap"><?php echo $bagian; ?></td>
                            </tr>
                            <tr>
                              <td align="left" nowrap="nowrap" class="id">Email</td>
                              <td align="left">:</td>
                              <td align="left" nowrap="nowrap"><?php echo "<a href = 'mailto:$email'>$email</a>"; ?></td>
                            </tr>
                            <tr>
                              <td align="left" nowrap="nowrap" class="id">Phone</td>
                              <td align="left">:</td>
                              <td align="left" nowrap="nowrap"><?php echo $telp; ?></td>
                            </tr>
                          </table></td>
                        </tr>
                        <?php } while ($result = mysql_fetch_assoc($sql_query)); ?>
                      </table></td>
                  </tr>
                </table>
              </div>
              <div class="TabbedPanelsContent">
                <table width="98%" border="2" align="center" cellpadding="10" cellspacing="0" bgcolor="#CCCCCC" >
                  <tr>
                    <td  background="img/bg4.JPG"><p align="center" class="as" style="color:white"><strong>PERATURAN IJIN KERJA</strong></p>
                      <ol style="color:white">
                        <li class="bd">Karyawan  GSPE harus menyerahkan gambar dan spesifikasi pekerjaan kepada Facility  Management berupa gambar skematis sistem, lay out, schedule pekerjaan, potongan  dan gambar gambar penjelas lainnya untuk direview dan dikoordinasikan oleh Facility  Management 1 minggu sebelum pekerjaan dimulai. Gambar tersebut ditujukan ke  Facility Management dimana anda mengajukan pekerjaan.</li>
                        <li class="bd">Facility  Management akan memberikan gambar yang telah disetujui.</li>
                        <li class="bd">Pihak  Facility Management berhak membongkar instalasi yang tidak sesuai dengan  standar standard instalasi maupun yang belum mendapatkan ijin dari pihak  Facility Management ataupun dianggap membahayakan.</li>
                        <li class="bd">Form  Fit Out harus diisi dan dilengkapi sesuai dengan urutan : Kontraktor,  Departement (Karyawan GSPE), In Building, Facility Management, Mechanical  Electrical dan terakhir adalah Chief Security. Selanjutnya, Form Asli ditempel  di lantai yang akan di Fit Out.</li>
                        <li class="bd">Kontraktor  :</li>
                        <span class="bd">Kontraktor harus menyerahkan surat tertulis dari  perusahaan yang berisi ijin, jenis pekerjaan, nama pekerja  &amp; fotocopy KTP, diserahkan selambat  lambatnya 1 hari sebelum pekerjaan dimulai bersamaan dengan <strong><em>Form  Ijin Kerja</em></strong>. Formulir aslinya harus ditempel di pintu masuk lantai yang  akan dikerjakan. Ijin Fit Out tersebut harus dilakuakn pada jam kerja yaitu  Senin – Kamis pukul 08:00 – 17:00 WIB, Jum’at pukul 08:00 – 17:30 WIB, apabila  melewati jam kerja kontraktor wajib mengisi Ijin Lembur Fit Out. Formulir ini  harus diisi secara lengkap dan ditandatangani oleh pihak Kontraktor, Karyawan  GSPE, In Building, Facility Management, Technician dan Security.<br />
                          Ijin  Kerja ini berlaku selama 7 (tujuh) hari setelah tanggal diterimanya Formulir  secara lengkap. Untuk kemudahan bersama, dianjurkan untuk mengajukan formulir  ijin kerja ini sesegera mungkin. </span>
                        <li class="bd">Pekerjaan yang dilakukan oleh  kontraktor pada saat jam kerja dilarang menimbulkan suara berisik, debu, bau  dan lainnya. Pihak  Facility Management berhak memberhentikan jika terjadi pelanggaran.</li>
                        <li class="bd">Seluruh  pekerja dari Kontraktor wajib menggunakan ID Pekerja sesuai dengan data yang  dikeluarkan dari pihak Facility Management. Selama melakukan pekerjaan/Fit Out  karyawan kontraktor harus mengikuti seluruh peraturan yang dikeluarkan oleh  pihak Facility Management seperti : tidak boleh merokok dan makan di area  gedung, harus menggunakan toilet yang berada di samping posko Security yang berada dibelakang gedung, melapor ke Security FM saat datang maupun pulang &amp; tidak  diperkenankan membawa tas ke tempat bekerja. </li>
                        <li class="bd">Setiap  pekerja harus diawasi oleh supervisor yang tercantum pada Form Fit Out</li>
                        <li class="bd">Pekerjaan  yang dilakukan kontraktor seperti las, gerinda dan bahan – bahan yang  mengandung gas, harus menyiapkan fire extinguser.</li>
                        <span class="bd"> Untuk pekerjaan sipil seperti  pemasangan pool, tidak dapat dihubungkan ke plat roof dan harus menyediadakan  peralatan safety seperti : helmet, sarung tangan, safety belt dan sepatu  safety. </span>
                        <li class="bd">Untuk pekerjaan diatas plafon dan  berhubungan dengan electrical harus didampingi oleh staff Mechanical  Electrical.</li>
                        <li class="bd">Pekerja dari kontraktor dilarang  menggunakan dilarang menggunakan lift penumpang, kecuali ada ketentuan lain  atau seijin Facility Management.</li>
                        <li class="bd">Apabila terjadi kecelakaan kerja dan  keadaan bahaya segera meminta bantuan ke Posko Security secepatnya.</li>
                        <li class="bd">Dengan adanya peraturan di atas,  Facility Management berhak memberikan sangsi kepada kontraktor apabila  melakukan pelanggaran dan mencabut Ijin Kerjanya.</li>
                      </ol>
                      <p class="as" align="center" style="color:white"><strong>FACILITY MANAGEMENT GSPE</strong></p></td>
                  </tr>
                </table>
              </div>
              <div class="TabbedPanelsContent"><img src="img/contoh_wp.jpg" /></div>
              <div class="TabbedPanelsContent">
                <table width="98%" border="2" align="center" cellpadding="10" cellspacing="0" bgcolor="#FFFFFF" >
                  <tr>
                    <td align="left" ><p><strong><u>Tata Cara Registrasi Departement  In Charge</u></strong><br />
                      Untuk karyawan / employee yang ingin mengajukan izin kerja,  diharuskan melakukan registrasi terlebih dahulu sebelum memeritahkan vendor  untuk bekerja (Reginstrasi di lakukan hanya untuk Karyawan / Employee PT. GSPE sedangkan untuk team In Building dan FM tidak perlu melakukan registrasi karena untuk mendaftarkan vendor bisa langsung pada menu REG WP). <br />
                      Tata cara Registrasi WP sebagai berikut:<br />
                      Pertama-tama kunjungi website e-working permit<br />
                      Selanjutnya pilih <strong>REGISTRATION</strong>,&nbsp;&nbsp;<br />
                      Input data diri, password dan jenis pekerjaan yang ingin  diajukan.<br />
                      Setelah data diisi dengan lengkap dan benar lalu klik Submit  untuk proses penyimpanan data dan untuk pembatalan klik Reset </p>
                      <p>
                        <center>
                          <img src="img/clip_image002_0002.jpg" alt="" width="624" height="439" /><br />
                        </center>
                        <br />
                        Setelah data  berhasil disimpan, anda tidak bisa langsung login, melainkan anda harus  menunggu konfirmasi account  dari administrator. Sedangkan untuk konfirmasi  pekerjaan, anda harus menunggu konfirmasi dari Facility Management (FM). Setelah  account anda dapat konfirmasi dari administrator anda telah bisa login sebagai  department incharge. <br />
                        Note: Contoh Nomer ID  (90012345)<br />
                        <br />
                        <center>
                          <img src="img/clip_image004_0001.jpg" alt="" width="624" height="261" />
                        </center>
                        <br />
                        Untuk login anda memasukan User  Id (contoh 90012345) dan  password yang telah anda inputkan  pada saat registrasi,<br />
                        Setelah anda berhasil login maka anda akan ditampilkan menu-menu sebagai  berikut; <br />
                        1. WP LIST<br />
                        2. REG LIST<br />
                        3. REG WP<br />
                        4. CHANGE PASSWORD<br />
                        5. MY ACCOUNT<br />
                        6. LOGOUT<br />
                        <br />
                        Fungsi dan kegunaan menu-menu tersebut sebagai berikut:<br />
                        <strong>1.  WP LIST </strong>(Working Permit List) </p>
                      <p>
                        <center>
                          <img src="img/clip_image010_0001.jpg" alt="" width="624" height="182" />
                        </center>
                      </p>
                      <p> Berfungsi untuk menampilkan  seluruh working permit yang telah vendor anda buat.<br />
                        <strong>2.  REG LIST </strong>(Registration List)<br />
                        <center>
                          <img src="img/clip_image012_0002.jpg" alt="" width="624" height="195" />
                        </center>
                        <br />
                        Berfungsi untuk menampilkan seluruh registrasi yang pernah  anda buat, yang pembuatanya dilakukan pada menu REG WP (Registrasi working  permit), pada kolom No Registration di dalam menu REG LIST terdapat angka-angka  yang digunakan untuk pembuatan working permit di kantor yang anda tuju, angka-angka  tersebut yang nantinya anda serahkan ke vendor anda sesuai dengan pekerjaannya  masing-masing. <br />
                        Note:<br />
                        Nomor Registrasi ini didapatkan setelah registration working permit anda di  setujui oleh pihak facility management.  <br />
                        <br />
                        <strong>3.  REG WP</strong> (Registration Working Permit)<strong> </strong></p>
                      <p><strong>
                        <center>
                          <strong><img src="img/clip_image014_0001.jpg" alt="" width="624" height="257" /></strong>
                        </center>
                        </strong><br />
                        Berfungsi untuk  mendaftarkan vendor-vendor anda yang akan berkerja dan untuk mendapatkan Nomor  Registrasi dari Facility management kantor yang bersangkutan. REG WP ini digunakan setiap kali ada  vendor anda yang akan melakukan pembuatan working permit. didalam menu REG WP  terdapat inputan sebagia berikut:</p>
                      <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="30" valign="top"> 1 </td>
                          <td width="139" valign="top" nowrap="nowrap"><p>Contractor / Vendor</p></td>
                          <td width="18" valign="top"><p>:</p></td>
                          <td width="390" valign="top" nowrap="nowrap"><p>Nama kontraktor / vendor contoh    PT. VIO Intelligence </p></td>
                        </tr>
                        <tr>
                          <td width="30" valign="top"><p>2</p></td>
                          <td width="139" valign="top"><p>Job Description </p></td>
                          <td width="18" valign="top"><p>:</p></td>
                          <td width="390" valign="top"><p>Jenis pekerjaan yang akan    dilakukan</p></td>
                        </tr>
                        <tr>
                          <td width="30" valign="top"><p>3</p></td>
                          <td width="139" valign="top" nowrap="nowrap"><p>Quantity of person</p></td>
                          <td width="18" valign="top"><p>:</p></td>
                          <td width="390" valign="top"><p>Jumlah orang yang akan bekerja</p></td>
                        </tr>
                        <tr>
                          <td width="30" valign="top"><p>4</p></td>
                          <td width="139" valign="top"><p>Floor</p></td>
                          <td width="18" valign="top"><p>:</p></td>
                          <td width="390" valign="top"><p>Lantai tempat vendor anda    bekerja</p></td>
                        </tr>
                        <tr>
                          <td width="30" valign="top"><p>5</p></td>
                          <td width="139" valign="top"><p>Working Schedule </p></td>
                          <td width="18" valign="top"><p>:</p></td>
                          <td width="390" valign="top"><p>Jadwal pembuatan working permit</p></td>
                        </tr>
                      </table>
                      <p><strong><br />
                        4. CHANGE PASSWORD</strong><br />
                        <center>
                          <img src="img/clip_image016_0001.jpg" alt="" width="624" height="238" />
                        </center>
                        <br />
                        Berfungsi untuk merubah password</p>
                      <p><strong>5.  MY ACCOUNT</strong><br />
                        <center>
                          <img src="img/clip_image018_0002.jpg" alt="" width="624" height="295" />
                        </center>
                        <br />
                        Berfungsi untuk merubah data diri seperti </p>
                      <ol>
                        <li>Department</li>
                        <li>Email</li>
                        <li>Telepon</li>
                        <li>Title</li>
                        <li>Photo</li>
                      </ol>
                      <p><strong>6.  LOGOUT</strong><br />
                        <center>
                          <img src="img/clip_image020_0001.jpg" alt="" width="624" height="120" />
                        </center>
                        Setelah anda tidak menggunakan working permit harap  melakukan logout agar user id anda tidak disalah gunakan oleh pihak lain.<br />
                      </p></td>
                  </tr>
                </table>
                <p align="center">&nbsp;</p>
              </div>
              <div class="TabbedPanelsContent">
                <table width="98%" border="2" align="center" cellpadding="10" cellspacing="0" bgcolor="#FFFFFF" >
                      <tr>
                        <td align="left" ><strong><u>
                          <center>
                            <h3 class="isi">Tata Cara Pembuatan Izin Kerja (Working Permit)</h3>
                          </center>
                        </u></strong>
                          <p>Klik Menu  CREATE LIST <br />
                            Maka akan tampil data vendor yang  telah di registrasikan oleh department In Charge, contoh seperti gambar berikut:<br /><center>
  <img width="624" height="216" src="img/clip_image002_0003.jpg" /></center> <br />
                            Gambar 1. Daftar Vendor/Kontraktor Yang dapat membuat e-Working  Permit<br />
                            Apabila  data kontraktor/vendor anda tampil pada data tersebut, contoh PT. VIO Intelligence maka  anda dapat melakukan pembuatan working permit dengan cara mengklik <strong>Create</strong> pada kolom create,   setelah diklik maka akan tampil form inputan seperti gambar dibawah ini<br />
 <center> <img width="576" height="399" src="img/gbr01.jpg" /></center><br />
                            Gambar 2. Form inputan pembuatan e-working permit<br />
                            Lalu anda lakukan pengisian data dengan  lengkap dan benar.<br />
                            Note,</p>
                          <ul>
                            <li>Untuk inputan registration number anda harus  memasukan dengan nomer registrasi yang anda dapatkan dari Department In Charge</li>
                            <li>Tanggal kerja hanya dapat dipilih maksimal 7  hari kerja,</li>
                            <li>Untuk penginputan foto anda klik "Take Picture" pada form inputan working permit lalu hasil dari capture foto akan muncul pada kolom sebelah kanan, dan bila ingin mengulang mengambil gambar kembali bisa dilakukan dengan mengklik "Take Picture" sekali lagi</li>
                          </ul>
                          <p><center><img width="576" height="432" src="img/clip_image006_0003.jpg" alt="11523095936untitled.bmp" /></center><br />
                            Gambar 3. Fungsi untuk photo working permit<br />
                            Cara penggunaan Program Photo ialah  sebagai berikut; </p>
                          <ul>
                            <li>Take Picture</li>
                          </ul>
                          <p>Setelah itu foto berhasil diambil, bila terdapat kesalahan dalam pengambilan foto maka dapat diulang kembali untuk mengambil foto<br />
                            <br />
                            dan untuk pengecekan apakah data  anda telah berhasil tersimpan atau belum anda dapat melihatnya pada menu WP  LIST, di menu ini anda juga dapat melihat approve dari department-department  yang berkepentingan dengan working permit di GSPE.<br /><center>
  <img width="624" height="187" src="img/clip_image008_0002.jpg" /></center><br />
                            Gambar 4. Daftar vendor yang telah membuat working permit  dan menampilkan setatus approve  </p>
                          <ul>
                            <li><strong>PERMOHONAN  APPROVE </strong></li>
                          </ul>
                        <div>  <p>Setelah working  permit berhasil dibuat dan tampil pada menu WP LIST seperti  gambar di atas maka anda harus meminta Approve dari department-department  sebagai berikut;</p>
                          </div>
                          <div>
                          <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tr><td>
                          <table border="0" align="left" cellpadding="5" cellspacing="0">
                            <tr>
                              <th valign="top" align="center"><strong>No</strong></th>
                              <th valign="top" align="center"><strong>Deprtment</strong></th>
                              <th valign="top" align="center"><strong>Lantai</strong></th>
                              <th valign="top" align="center"><strong>Ruang</strong></th>
                              <th valign="top" align="center"><strong>No Ext</strong></th>
                            </tr>
                            <tr>
                              <td valign="top" align="center">1</td>
                              <td valign="top" nowrap>In Building</td>
                              <td valign="top" align="center"><?php  echo $result2['lantaiib'];?></td>
                              <td valign="top" nowrap><?php  echo $result2['ketib']; ?></td>
                              <td valign="top" nowrap="nowrap"><?php  echo $result2['extib']; ?></td>
                            </tr>
                            <tr>
                              <td valign="top" align="center">2</td>
                              <td valign="top" nowrap>Facility Management</td>
                              <td valign="top" align="center"><?php  echo $result2['lantaifm'];?></td>
                              <td valign="top" nowrap><?php  echo $result2['ketfm'];?></td>
                              <td valign="top" nowrap><?php  echo $result2['extfm'];?></td>
                            </tr>
                            <tr>
                              <td valign="top" align="center">3</td>
                              <td valign="top" nowrap>Maintenance</td>
                              <td valign="top" align="center"><?php  echo $result2['lantaimt'];?></td>
                              <td valign="top" nowrap><?php  echo $result2['ketmt'];?></td>
                              <td valign="top" nowrap><?php  echo $result2['extmt'];?></td>
                            </tr>
                            <tr>
                              <td valign="top"align="center">4</td>
                              <td valign="top" nowrap>Security</td>
                              <td valign="top"align="center"><?php  echo $result2['lantaist'];?></td>
                              <td valign="top" nowrap><?php  echo $result2['ketst'];?></td>
                              <td valign="top" nowrap><?php  echo $result2['extst'];?></td>
                            </tr>
                          </table>
                          </td></tr>
                          <tr><td>                 
                              <p>&nbsp;</p>                               
                          <p>Untuk  permohonaan Approve anda bisa menggunakan telepon yang telah disediakan.<br>
                            <br />
                            Note, <br />
                            Urutan Approve  Sebagai Berikut: In Buiding - Facility Management - Maintenance - Security.<br />
                            Sebelum In  Building (IB) melakukan approve anda tidak diperkenankan meminta approve kepada  Facility Management (FM) dan sebelum Facility Management (FM) melakukan approve  anda tidak diperkenankan meminta approve kepada Maintenace (MT) dan sebelum  Maintenace (MT) melakukan approve anda tidak diperkenankan meminta approve  kepada Security (ST)</p>
<p>Setelah  department-department yang bersangkutan melakukan approve anda baru bisa  melakukan aktifitas pekerjaan yang telah anda buat. Dan apabila salah satu dari  department yang ada belum melakukan approve ada tidak diperkenankan untuk  melakukan aktifitas kerja diarea JNB.  </p>
                          <p>Apabila working  permit yang anda buat telah di approve semua maka working permit anda akan  ditampilkan pada menu WORKING.</p>
                          <p>&nbsp;</p>
<p>Terima Kasih<br />
                        Facility  management GSPE</p></td></tr></table></td>
                      </tr>                      
                  </table>
              </div>
              <div class="TabbedPanelsContent">
                <table width="98%" border="2" align="center" cellpadding="10" cellspacing="0" bgcolor="#FFFFFF" >
                  <tr>
                    <td align="left" ><p>Menu-menu yang ditampilkan pertama kali pada saat kita menunjungi portal e-working permit<br/>
                      sebagai berikut:
                    </p>
                      <ol>
                        <li>CREATE  LIST</li>
                        <li>REGISTRATION</li>
                        <li>WORKING</li>
                        <li>WP  LIST</li>
                        <li>REG  REQUEST</li>
                        <li>INFO</li>
                        <li>LOGIN </li>
                      </ol>
                      <strong>1. CREATE LIST </strong>
                      <center>
                        <img src="img/clip_image026_0001.jpg" alt="" width="547" height="165" border="0" />
                      </center>
                      <br />
                      Menampilkan daftar vendor yang sudah dapat membuat  working permit.<br />
                      Cara pembuatanya dengan cara mengklik create pada kolom  create , setelah create di klik maka akan tampil menu sebagai berikut:<br />
                      <center>
                        <img src="img/clip_image028_0001.jpg" alt="" width="547" height="357" border="0" />
                      </center>
                      <br />
                      Mengisi data data vendor dengan lengkap dan benar  beserta Nomor Registrasi yang di dapat dari Department In charge
                      <p></p>
                      <br />
                      <br />
                      <strong>2. REGISTRATION</strong><br />
                      <center>
                        <img src="img/clip_image030_0001.jpg" alt="" width="547" height="395" border="0" />
                      </center>
                      <p><br />
                        Berfungsi untuk registrasi department in charge <em>selain  Facility Department dan In Building</em>, didalam menu registrasi ini terdapat Job Category yang harus di isi, job category  berfungsi untuk mendapatkan nomor registrasi ijin kerja yang nantinya  diserahkan kepada vendor anda, yang digunakan untuk pembuatan working permit.  <br />
                        Note : registrasi ini hanya dilakukan sekali. Setelah  registrasi anda sukses maka untuk mengakses menu-menu selanjutnya anda tinggal  login saja.</p>
                      <p> <strong>3. WORKING</strong></p>
                      <center>
                        <img src="img/clip_image032_0001.jpg" alt="" width="547" height="167" border="0" />
                      </center>
                      <p><br />
                        Berfungsi untuk menampilkan daftar vendor yang sedang  bekerja, untuk melihat detail working permit tinggal mengklik detail pada kolom  detail, maka akan tampil seperti gambar dibawah ini<br />
                        Note: bila working permit tidak ada menandakan vendor tersebut jam kerjanya belum mulai atau telah habis<br />
                      </p>
                      <center>
                        <img src="img/wp_baru1.jpg" alt="" width="547" height="354" border="0" />
                      </center>
                      <br />
                      <strong>4. WP LIST (working permit list)</strong><br />
                      Meampilkan daftar vendor yang belum mendapatkan approve  dari department- departement yang ada
                      <table border="0" cellspacing="0" cellpadding="2">                        
                        <tr>
                          <td valign="top">1.</td>
                          <td valign="top">IB</td>
                          <td valign="top">:</td>
                          <td valign="top">In Building</td>
                          </tr>
                        <tr>
                          <td valign="top">2.</td>
                          <td valign="top">FM</td>
                          <td valign="top">:</td>
                          <td valign="top" nowrap="nowrap">Facility Management</td>
                          </tr>
                        <tr>
                          <td valign="top">3.</td>
                          <td valign="top">MT</td>
                          <td valign="top">:</td>
                          <td valign="top">Maintenance</td>
                          </tr>
                        <tr>
                          <td valign="top">4.</td>
                          <td valign="top">ST</td>
                          <td valign="top">:</td>
                          <td valign="top">Security</td>
                          </tr>
                      </table>
                      <p>Note: urutan untuk approve sesuai susunan diatas.</p>
                      <strong>5. REG REQUEST<br />
                        </strong>Menampilkan daftar department incharge yang  meregistrasikan vendornya untuk bekerja
                      <p><strong>6. INFO</strong><br />
                        Menampilkan informasi-informasi mengenai website  working permit ini</p>
                      <strong>7. LOGIN<br />
                      </strong>Untuk masuk kedalam sub menu yang berdasarkan otoritas  masing masing  yang bersangkutan.</td>
                  </tr>
                </table>
              </div>
              </div>
            </div></td>
        </tr>
     </table>
<?php include('bawah.php');?> 
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>

