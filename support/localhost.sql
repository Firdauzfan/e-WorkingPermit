-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 14. Maret 2011 jam 17:44
-- Versi Server: 5.1.41
-- Versi PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wp_db`
--
CREATE DATABASE `wp_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `wp_db`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_artikel`
--

CREATE TABLE IF NOT EXISTS `tb_artikel` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `kategori` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `isiartikel` longtext COLLATE latin1_general_ci NOT NULL,
  `pengirim` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `urlparam` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `konter` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=25 ;

--
-- Dumping data untuk tabel `tb_artikel`
--

INSERT INTO `tb_artikel` (`id`, `judul`, `kategori`, `isiartikel`, `pengirim`, `tanggal`, `urlparam`, `konter`) VALUES
(14, 'Pengumuman', 'Informasi', 'Mulai hari minggu xl berencana mengadakan temu kangen dengan bos besar ', '', '2010-12-23 04:43:30', NULL, 2),
(16, 'Landasan Teori', 'Bab 2', 'Penggunaan teori pendukung sangatlah penting dalam penulisan program, karena akan mudah menemukan jalan keluar dari berbagai masalah yang dihadapi dalam penulisan program dan agar program yang dihasilkan dapat berjalan dengan baik dan sesuai dengan permasalahan yang sedang dihadapi.  Maka untuk melengkapi penyusunan tugas akhir ini, penulis menggunakan berbagai buku bacaan sebagai dasar teori pendukung dalam memahami pembuatan program. dfasdf', '', '2010-12-25 01:03:49', NULL, 0),
(17, 'Konsep Dasar Program', 'Bab 2', 'Bahasa pemrograman adalah bahasa yang di pakai oleh programmer untuk menulis kumpulan instruksi, dengan kata lain program adalah suatu rangkaian aktivitas instruksi dalam  bahasa komputer yang di susun secara logis dan sistematis. sedangkan Menurut Sugiyono (2005:21) memberikan pengertian bahwa Program ialah ?Suatu rangkaian instruksi-instruksi dalam bahasa komputer yang disusun secara logis dan sistematis?\r\nBahasa pemrograman (programming language) merupakan bagian dari software yang sangat diperlukan dalam sistem komputer  tanpa adanya bahasa pemrograman kita tidak bisa memanfaatkan komputer sebagai alat pengolahan atau analisa data bahasa komputer, juga merupakan sarana komunikasi yang membatasi antara manusia dengan komputer.  pemrograman komputer bukan hanya sekedar menulis suatu urutan instruksi yang harus di kerjakan oleh komputer, akan tetapi bertujuan untuk memecahkan suatu masalah serta membuat mudah pekerjaan yang diinginkan oleh pemakaian.\r\nAda lima (5) langkah  yang dapat dilakukan oleh seorang pemrograman dalam  pemecahan suatu masalah dengan menggunakan program komputer, yaitu :\r\n1.	Menganalisa dan memahami persoalan yang ada, kemudian mengembangkan suatu urutan  logika untuk menyelesaikan masalah tersebut dalam bentuk algoritma.\r\n2.	Menentukan bentuk data apa saja yang diperlukan sebagai input didalam program yang akan di buat, serta apa saja yang akan dihasilkan sebagai output dari program yang akan di buat.\r\n3.	Pengkodean dari algoritma yang sudah di buat,  serta diterjemahkan ke dalam bentuk statement yang sesuai dan terdapat di dalam bahasa pemrograman yang digunakan.\r\n4.	Melakukan tes program dari  logika yang sudah dibuat, apakah program tersebut sudah benar dan bebas dari kesalahan atau masih harus diperbaiki kembali.\r\n5.	Melakukan pendokumentasian program sebagai back-up (cadangan) yang mana  ini penting untuk dijalankan sebagai usaha pengembangan program selanjutnya.\r\nDalam penulisan Tugas Akhir ini penulis menggunakan bahasa pemrograman Microsoft Visual Foxpro 9.0 yang merupakan bahasa pemrograman visual yang berorientasi pada objek dan juga sebagai sistem manajemen database relasional. Microsoft Visual Foxpro 9.0 merupakan bahasa pemrograman yang cukup mudah dan fraktis karena dilengkapi dengan tool help yang sangat lengkap dan segudang wizard yang mempermudah kita untuk membuat program  hanya dengan cara men-drag dan drop suatu objek di dalam  pembuatan program tersebut.\r\n', 'admin', '2010-12-25 01:53:58', NULL, 0),
(18, 'Perancangan Program ', 'Bab 2', 'Suatu program komputer dalam penerapannya tidak hanya sekedar menulis aturan instruksi- instruksi  tapi juga bertujuan untuk memecahkan masalah dari kasus yang timbul, meningkatkan kualitas kerja serta membantu  pengambilan keputusan. Dalam merancang sebuah program, tentu tidak lepas dari kualitas bahasa pemrograman. Bahasa pemrograman dapat dikatakan berkualitas apabila :\r\n1.	Mampu menggambarkan secara jelas algoritma yang dibuat oleh pemrogramnya.\r\n2.	Sintak dan simatiknya harusnya konsisten dan tidak bermakna ganda.\r\n3.	Mampu mendukung berbagai tipe data.\r\n4.	Dapat dipakai oleh berbagai tipe mesin komputer.\r\n5.	Mempunyai fasilitas subprograming.\r\n6.	Mudah dipelajari dan memiliki jangkauan luas pada berbagai aplikasi pemrograman. oker\r\nSelain kualitas dari program itu sendiri, perlu diperhatikan juga struktur dasar pemrogramannya, antara lain yaitu :\r\na.	Interaktif\r\nSuatu program dikatakan interaktif jika program tersebut dapat digunakan dengan mudah dan pemakai mengerti tentang  dari program itu sendiri.\r\n\r\n\r\n\r\nb.	Efesien\r\nSuatu program dikatakan efesien apabila memenuhi tiga hal, yaitu efesien pernyataan, efesien pemakaian memori, dan efesien pemakaian piranti masukan dan keluaran.\r\nLangkah-langkah pembuatan program secara umum adalah :\r\n1.	Mendefinisikan masalah.\r\n2.	Membuat flowchart.\r\n3.	Membuat program.\r\n4.	Melakukan tes program.\r\n5.	Membuat dokumentasi program.\r\nPenulisan program di komputer  terbagi dua sifat, yaitu yang beorientasi pada program dan beorientasi pada data. Penulisan program yang beorientasi pada program mempunyai ciri struktur program selalu berubah apabila volume datanya bertambah sehingga bersifat statis dan fleksibel. Sedangkan penulisan program yang berorientasi pada data mempunyai ciri programnya tetap walaupun volume datanya bertambah sehingga program ini sangat fleksibel.\r\nDalam menulis suatu kode program, tentu tak lepas dari tiga hal yaitu, sintaksis, simatik, dan kebenaran logika. Sintaksis berati aturan penulisan atau tata bahasa dari program itu sendiri, simatik adalah arti yang terkandung didalam pernyataan tersebut. Sedangkan kebenaran logika merupakan kesalahan dalam menginterprestasikan persoalan yang dihadapi.\r\n', 'admin', '2010-12-23 04:43:12', NULL, 0),
(19, 'Normalisasi', 'Bab 2', 'Pengertian normalisasi Menurut Supardi (2004:75) ?Normalisasi adalah teknik desain database dengan memecahkan atribut-atribut menjadi beberapa bagian kelompok/entiti sehingga didapat tabel yang optimal/normal.? tujuan normalisasi sendiri ialah supaya kita dapat menghindari dari kesulitan pada saat  menambah atau insert, menghapus atau delete, mengubah atau  update, membaca atau retrieve, pada suatu tabel di database. Bila ada kesulitan pada pengujian tersebut maka relasi tersebut dipecahkan pada beberapa tabel lagi, atau dengan kata lain perancangan yang dilakukan belum mendapat suatu database yang optimal', 'admin', '2010-12-23 04:13:36', NULL, 0),
(20, 'Teknik Pengkodean', 'Bab 2', 'Kode digunakan untuk tujuan mengklasifikasikan data, memasukan data kedalam komputer dan untuk mengambil bermacam-macam informasi yang berhubungan dengannya. Kode dapat dibentuk dari kumpulan angka, huruf dan karakter-karakter khusus. Angka merupakan simbol yang banyak digunakan pada sistem kode. Akan tetapi kode yang berbentuk angka lebih dari 6 digit akan sangat sulit untuk diingat. Kode numerik (numeric code) menggunakan 10 macam kombinasi angka didalam kode. Kode alphanumerik (alphanumeric code) merupakan kode yang menggunakan gabungan angka, huruf dan karakter-karakter khusus. te', '', '2010-12-23 04:41:52', NULL, 0),
(21, 'Diagram Alur (Flowchart)', 'Bab 2', 'Berhubungan komputer membutuhkan hal-hal yang terperinci, maka bahasa pemrograman bukan merupakan alat yang boleh dikatakan baik untuk merancang sebuah algoritma awal. Alat yang banyak dipakai untuk membuat algoritma, Flowchart Menurut Sugiyono (2005:29) adalah: ?Gambar simbol-simbol yang digunakan untuk menggambarkan urutan proses atau instruksi-instruksi yang terjadi didalam suatu program komputer secara sistematis dan logis?. \r\nFlowchart merupakan arus pengendalian suatu algoritma yang membuat bagaimana suatu rangkaian kegiatan secara logis dan sistematis. Suatu diagram alir dapat memberikan gambaran dua dimensi yang berupa simbol-simbol grafis. Simbol-simbol tesebut dipakai untuk menunjukkan berbagai kegiatan operasi dan jalur pengendalian.\r\n', 'admin', '2010-12-23 04:13:44', NULL, 0),
(22, 'Diagram Alur', 'Bab 2', 'Berhubungan komputer membutuhkan hal-hal yang terperinci, maka bahasa pemrograman bukan merupakan alat yang boleh dikatakan baik untuk merancang sebuah algoritma awal. Alat yang banyak dipakai untuk membuat algoritma, Flowchart Menurut Sugiyono (2005:29) adalah: ?Gambar simbol-simbol yang digunakan untuk menggambarkan urutan proses atau instruksi-instruksi yang terjadi didalam suatu program komputer secara sistematis dan logis?. \r\nFlowchart merupakan arus pengendalian suatu algoritma yang membuat bagaimana suatu rangkaian kegiatan secara logis dan sistematis. Suatu diagram alir dapat memberikan gambaran dua dimensi yang berupa simbol-simbol grafis. Simbol-simbol tesebut dipakai untuk menunjukkan berbagai kegiatan operasi dan jalur pengendalian.\r\n', 'admin', '0000-00-00 00:00:00', NULL, 0),
(23, 'Tinjauan Kasus', 'Bab 2', 'Toko ?XYZ? merupakan sebuah toko yang bergerak dalam bidang penjualan perlengkapan alat-alat komputer, barang-barang yang terjual di toko ?XYZ? langsung dicatat kasir kedalam buku penjualan barang dengan cara yang manual, serta dibuatkan tanda bukti pembayaran yang berupa bon kontan berdasarkan jenis dan harga barang yang tejual tersebut. Buku penjualan barang ini yang nantinya dijadikan dfd', '', '2010-12-23 01:56:51', NULL, 0),
(24, 'ghgfh', 'gfh', 'Yang beneran dikit lah', 'ghggh', '2010-12-23 04:51:57', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_option`
--

CREATE TABLE IF NOT EXISTS `tb_option` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `option_name` text NOT NULL,
  `option_value` longtext NOT NULL,
  `autoload` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `tb_option`
--

INSERT INTO `tb_option` (`id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'header_name', 'XL INFORMATION', 'yes'),
(2, 'footer_name', 'XLku', 'no'),
(3, 'gfdfsg', 'sfgsdfg', 'yrd'),
(4, 'gfdfsg', 'sfgsdfg', 'yrd');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_regkerja`
--

CREATE TABLE IF NOT EXISTS `tb_regkerja` (
  `no_id` varchar(20) NOT NULL,
  `kontraktor` varchar(50) DEFAULT NULL,
  `job_des` text NOT NULL,
  `qop` varchar(11) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `no_reg` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Waiting',
  `date` datetime NOT NULL,
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `lantai` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`no`),
  KEY `no_id` (`no_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data untuk tabel `tb_regkerja`
--

INSERT INTO `tb_regkerja` (`no_id`, `kontraktor`, `job_des`, `qop`, `mulai`, `selesai`, `no_reg`, `status`, `date`, `no`, `lantai`) VALUES
('90001234', 'PT. ARISTA JAYA', 'Monitoring ', '4', '2011-02-23', '2011-02-25', '90200924110537', 'App', '2011-02-24 16:59:34', 19, '3'),
('90001111', 'PT. JAYA KENCANA', 'Pemasangan Pc', '3', '2011-02-25', '2011-02-27', '30226625110819', 'App', '2011-02-25 08:24:53', 21, '2'),
('90002287', 'PT. MANORIAN', 'Monitoring', '3', '2011-02-26', '2011-02-27', '30209128110417', 'App', '2011-02-26 13:58:04', 22, '2'),
('90004321', 'PT. JAYA BAKTI', 'Monitoring', '2', '2011-02-28', '2011-02-28', '60203528110424', 'App', '2011-02-28 13:33:03', 23, '2'),
('90004321', 'PT. MUARA BARU', 'Monitotring', '2', '2011-02-28', '2011-02-28', '40209728110419', 'App', '2011-02-28 13:35:51', 24, '2'),
('90004321', 'PT. JUAN', 'Monitoring', '2', '2011-02-28', '2011-02-28', '80203528110422', 'App', '2011-02-28 13:41:28', 25, '3'),
('90002287', 'PT. SINECO', 'Maintenance', '3', '2011-02-28', '2011-02-28', '70209828110554', 'App', '2011-02-28 17:09:12', 26, '4'),
('90009999', 'RAJA MANDALA', 'Conection Joky Pamp', '4', '2011-02-03', '2011-02-14', '70229728110526', 'App', '2011-02-28 17:26:28', 27, '1'),
('32800003', 'PT. MULYA JAYA', 'Pm 3 Bulanana', '2', '2011-03-01', '2011-03-02', '70353301110114', 'App', '2011-03-01 13:51:21', 28, '2'),
('90002287', 'PT. MULYA JAYA', 'Pemasangan Handle Kunci Lemari Gm', '2', '2011-03-13', '2011-03-20', '90347213111117', 'App', '2011-03-13 23:46:22', 29, '2'),
('32800003', 'BUANA JAYA', 'Monitoring', '2', '2011-03-14', '2011-03-21', '-', 'Waiting', '2011-03-14 06:27:37', 30, '3'),
('97897998', 'DF', 'Df', '3', '2011-03-14', '2011-03-14', '-', 'Waiting', '2011-03-14 17:19:25', 31, '3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `no_id` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `bagian` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` varchar(30) DEFAULT NULL,
  `status` char(10) NOT NULL DEFAULT 'Aktif',
  `salah` int(11) DEFAULT '0',
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `departement` varchar(50) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`no_id`, `nama`, `title`, `password`, `bagian`, `email`, `telp`, `status`, `salah`, `no`, `departement`, `photo`) VALUES
('12078212', 'Bae', 'Teknisi', '5255e7e4751a507aa7d61a4e8417d61f', 'Admin', 'bae@yahoo.com', '08187878787', 'Aktif', 0, 1, 'Maintenance', 'poto/11372062139images (2).jpg'),
('90002287', 'Sukarman', 'Supervisor', 'e10adc3949ba59abbe56e057f20f883e', 'Facility Management', 'sukarman@xl.co.id', '08154547875', 'Aktif', 0, 20, 'Facility Management', NULL),
('32800001', 'Sahlani', 'Leader ', 'e10adc3949ba59abbe56e057f20f883e', 'Maintenance', 'sahlani@xl.co.id', '0817857875787', 'Aktif', 0, 21, 'Mentenance', NULL),
('32800003', 'Rahmat', 'Teknisi', 'e10adc3949ba59abbe56e057f20f883e', 'In Building', 'rahmat@xl.co.id', '08178578787', 'Aktif', 0, 22, 'In Building', NULL),
('30001234', 'Ali', 'Danru', 'e10adc3949ba59abbe56e057f20f883e', 'Security', 'ali@xl.co.id', '0878745784578', 'Aktif', 0, 23, 'Security', NULL),
('90001111', 'Joko', 'Manager', 'e10adc3949ba59abbe56e057f20f883e', 'Departement', 'joko@xl.com', '08785478787', 'Aktif', 0, 25, 'NOC', NULL),
('90004321', 'Bejo', 'Manager', 'e10adc3949ba59abbe56e057f20f883e', 'Departement', 'bejo@yahoo.com', '0818782578787', 'Aktif', 0, 26, 'Noc', NULL),
('32165487', 'Darjo', 'Manager', 'e10adc3949ba59abbe56e057f20f883e', 'In Building', 'darjo@xl.com', '08145787877', 'Aktif', 0, 30, 'Inbuilding', 'poto/pen.JPG'),
('90002222', 'Joni', 'Manager', 'e10adc3949ba59abbe56e057f20f883e', 'Facility Management', 'joni@xl.co.id', '081478787', 'Aktif', 0, 31, 'Maintenance', 'poto/images (2).jpg'),
('97897998', 'Dfd', 'D', 'e10adc3949ba59abbe56e057f20f883e', 'Departement', 'dd.fdf@fg.gfh', '058878764', 'Aktif', 0, 32, 'F', 'poto/11372171924images (2).jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_wp`
--

CREATE TABLE IF NOT EXISTS `tb_wp` (
  `no_wp` varchar(5) NOT NULL,
  `gedung` varchar(20) NOT NULL,
  `lantai` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `kontraktor` varchar(100) NOT NULL,
  `nama_kontraktor` varchar(50) NOT NULL,
  `telp_kontraktor` varchar(50) NOT NULL,
  `jml_orang` int(11) NOT NULL,
  `jns_pekerjaan` varchar(100) NOT NULL,
  `poto` varchar(250) DEFAULT NULL,
  `dept_incharge` varchar(100) NOT NULL,
  `nama_dept` varchar(100) NOT NULL,
  `no_id` varchar(50) NOT NULL,
  `telp_dept` varchar(30) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `tgl_mulai_l` date DEFAULT NULL,
  `tgl_selesai_l` date DEFAULT NULL,
  `jam_mulai_1` time DEFAULT NULL,
  `jam_selesai_1` time DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `approve_kt` varchar(10) NOT NULL,
  `no_id_kt` varchar(50) NOT NULL,
  `tgl_app_kt` datetime DEFAULT NULL,
  `approve_dt` varchar(10) NOT NULL,
  `nama_app_dt` varchar(50) NOT NULL,
  `no_id_dt` varchar(50) NOT NULL,
  `tgl_app_dt` datetime DEFAULT NULL,
  `approve_ib` varchar(10) NOT NULL,
  `nama_app_ib` varchar(50) NOT NULL,
  `no_id_ib` varchar(50) NOT NULL,
  `tgl_app_ib` datetime DEFAULT NULL,
  `approve_fm` varchar(10) NOT NULL,
  `nama_app_fm` varchar(50) NOT NULL,
  `no_id_fm` varchar(50) NOT NULL,
  `tgl_app_fm` datetime DEFAULT NULL,
  `approve_mt` varchar(10) NOT NULL,
  `nama_app_mt` varchar(50) NOT NULL,
  `no_id_mt` varchar(50) NOT NULL,
  `tgl_app_mt` datetime DEFAULT NULL,
  `approve_st` varchar(15) NOT NULL,
  `nama_app_st` varchar(50) NOT NULL,
  `no_id_st` varchar(50) NOT NULL,
  `tgl_app_st` datetime DEFAULT NULL,
  `sts` varchar(3) NOT NULL DEFAULT 'Yes',
  `no_reg` varchar(20) NOT NULL,
  PRIMARY KEY (`no_wp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_wp`
--

INSERT INTO `tb_wp` (`no_wp`, `gedung`, `lantai`, `status`, `kontraktor`, `nama_kontraktor`, `telp_kontraktor`, `jml_orang`, `jns_pekerjaan`, `poto`, `dept_incharge`, `nama_dept`, `no_id`, `telp_dept`, `tgl_mulai`, `tgl_selesai`, `tgl_mulai_l`, `tgl_selesai_l`, `jam_mulai_1`, `jam_selesai_1`, `jam_mulai`, `jam_selesai`, `approve_kt`, `no_id_kt`, `tgl_app_kt`, `approve_dt`, `nama_app_dt`, `no_id_dt`, `tgl_app_dt`, `approve_ib`, `nama_app_ib`, `no_id_ib`, `tgl_app_ib`, `approve_fm`, `nama_app_fm`, `no_id_fm`, `tgl_app_fm`, `approve_mt`, `nama_app_mt`, `no_id_mt`, `tgl_app_mt`, `approve_st`, `nama_app_st`, `no_id_st`, `tgl_app_st`, `sts`, `no_reg`) VALUES
('00003', 'JNB Bintaro', '3', 'Baru', 'PT. ARISTA JAYA', 'Mulo', '054878784', 4, 'Monitoring ', 'poto/Blue hills.jpg', 'Fault Management', 'Mulianto', '90001234', '081875787878', '2011-02-26', '2011-02-26', NULL, NULL, '00:00:00', '00:00:00', '07:00:00', '17:00:00', 'App', '', '2011-02-26 14:15:24', 'App', 'Mulianto', '90001234', '2011-02-26 14:19:59', 'App', 'Rahmat', '32800003', '2011-02-28 16:04:20', 'App', 'Sukarman', '90002287', '2011-02-28 16:02:51', 'App', 'Sahlani', '32800001', '2011-02-26 14:21:17', 'App', 'Ali', '30001234', '2011-02-28 16:05:34', 'Yes', '90200924110537'),
('00004', 'JNB Bintaro', '3', 'Baru', 'PT. JUAN', 'Murwadi', '081784787878', 2, 'Monitoring', 'poto/pen.JPG', 'Noc', 'Bejo', '90004321', '0818782578787', '2011-02-28', '2011-02-28', NULL, NULL, '00:00:00', '00:00:00', '09:00:00', '17:00:00', 'App', '', '2011-02-28 16:11:51', 'App', 'Bejo', '90004321', '2011-02-28 16:13:56', 'App', 'Rahmat', '32800003', '2011-02-28 16:16:16', 'App', 'Sukarman', '90002287', '2011-02-28 16:15:25', 'App', 'Sahlani', '32800001', '2011-02-28 16:14:58', 'App', 'Ali', '30001234', '2011-02-28 16:17:20', 'Yes', '80203528110422'),
('00005', 'JNB Bintaro', '2', 'Baru', 'PT. MANORIAN', 'Joni', '08154578787', 3, 'Monitoring', 'poto/pen3.JPG', 'Facility Management', 'Sukarman', '90002287', '08154547875', '2011-02-28', '2011-02-28', NULL, NULL, '00:00:00', '00:00:00', '08:00:00', '17:00:00', 'App', '', '2011-02-28 16:29:31', 'App', 'Sukarman', '90002287', '2011-03-02 14:11:32', 'App', 'Darjo', '32165487', '2011-03-08 14:03:44', 'App', 'Sukarman', '90002287', '2011-03-02 14:10:05', '-', '', '', NULL, '-', '', '', NULL, 'Yes', '30209128110417'),
('00006', 'JNB Bintaro', '1', 'Baru', 'RAJA MANDALA', 'Faisal', '0875965656', 4, 'Conection Joky Pamp', 'poto/_MG_1097.JPG', 'NOC', 'Asa', '90009999', '087684768736', '2011-02-02', '2011-02-02', '2011-02-28', '2011-02-28', '22:25:00', '17:35:00', '08:05:00', '20:15:00', 'App', '', '2011-02-28 17:32:44', 'App', 'Asa', '90009999', '2011-02-28 17:33:58', 'App', 'Darjo', '32165487', '2011-03-08 14:03:45', '-', '', '', NULL, 'App', 'Sahlani', '32800001', '2011-02-28 17:36:47', '-', '', '', NULL, 'Yes', '70229728110526'),
('00007', 'JNB Bintaro', '2', 'Baru', 'PT. MULYA JAYA', 'Mulyanto', '08154787578', 2, 'Pm 3 Bulanana', 'poto/pen.JPG', 'In Building', 'Rahmat', '32800003', '08178578787', '2011-03-01', '2011-03-03', NULL, NULL, '00:00:00', '00:00:00', '09:00:00', '17:00:00', 'App', '', '2011-03-01 13:57:29', 'App', 'Rahmat', '32800003', '2011-03-01 14:09:00', 'App', 'Darjo', '32165487', '2011-03-08 14:03:52', '-', '', '', NULL, '-', '', '', NULL, '-', '', '', NULL, 'Yes', '70353301110114');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_wp1`
--

CREATE TABLE IF NOT EXISTS `tb_wp1` (
  `no_wp` varchar(5) NOT NULL,
  `gedung` varchar(20) NOT NULL,
  `lantai` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `kontraktor` varchar(100) NOT NULL,
  `nama_kontraktor` varchar(50) NOT NULL,
  `telp_kontraktor` varchar(50) NOT NULL,
  `jml_orang` int(11) NOT NULL,
  `jns_pekerjaan` varchar(100) NOT NULL,
  `poto` varchar(250) DEFAULT NULL,
  `dept_incharge` varchar(100) NOT NULL,
  `nama_dept` varchar(100) NOT NULL,
  `no_id` varchar(50) NOT NULL,
  `telp_dept` varchar(30) DEFAULT NULL,
  `tgl1` date DEFAULT NULL,
  `tgl2` date DEFAULT NULL,
  `tgl3` date DEFAULT NULL,
  `tgl4` date DEFAULT NULL,
  `tgl5` date DEFAULT NULL,
  `tgl6` date DEFAULT NULL,
  `tgl7` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `approve_kt` varchar(10) NOT NULL,
  `no_id_kt` varchar(50) NOT NULL,
  `tgl_app_kt` datetime DEFAULT NULL,
  `approve_dt` varchar(10) NOT NULL,
  `nama_app_dt` varchar(50) NOT NULL,
  `no_id_dt` varchar(50) NOT NULL,
  `tgl_app_dt` datetime DEFAULT NULL,
  `approve_ib` varchar(10) NOT NULL,
  `nama_app_ib` varchar(50) NOT NULL,
  `no_id_ib` varchar(50) NOT NULL,
  `tgl_app_ib` datetime DEFAULT NULL,
  `approve_fm` varchar(10) NOT NULL,
  `nama_app_fm` varchar(50) NOT NULL,
  `no_id_fm` varchar(50) NOT NULL,
  `tgl_app_fm` datetime DEFAULT NULL,
  `approve_mt` varchar(10) NOT NULL,
  `nama_app_mt` varchar(50) NOT NULL,
  `no_id_mt` varchar(50) NOT NULL,
  `tgl_app_mt` datetime DEFAULT NULL,
  `approve_st` varchar(15) NOT NULL,
  `nama_app_st` varchar(50) NOT NULL,
  `no_id_st` varchar(50) NOT NULL,
  `tgl_app_st` datetime DEFAULT NULL,
  `sts` varchar(3) NOT NULL DEFAULT 'Yes',
  `no_reg` varchar(20) NOT NULL,
  PRIMARY KEY (`no_wp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_wp1`
--

INSERT INTO `tb_wp1` (`no_wp`, `gedung`, `lantai`, `status`, `kontraktor`, `nama_kontraktor`, `telp_kontraktor`, `jml_orang`, `jns_pekerjaan`, `poto`, `dept_incharge`, `nama_dept`, `no_id`, `telp_dept`, `tgl1`, `tgl2`, `tgl3`, `tgl4`, `tgl5`, `tgl6`, `tgl7`, `jam_mulai`, `jam_selesai`, `approve_kt`, `no_id_kt`, `tgl_app_kt`, `approve_dt`, `nama_app_dt`, `no_id_dt`, `tgl_app_dt`, `approve_ib`, `nama_app_ib`, `no_id_ib`, `tgl_app_ib`, `approve_fm`, `nama_app_fm`, `no_id_fm`, `tgl_app_fm`, `approve_mt`, `nama_app_mt`, `no_id_mt`, `tgl_app_mt`, `approve_st`, `nama_app_st`, `no_id_st`, `tgl_app_st`, `sts`, `no_reg`) VALUES
('00001', 'XL JNB Bintaro', '2', 'Baru', 'pt. mulya jaya', 'Eko', '084754788787', 2, 'pemasangan handle pintu ruang gm', 'poto/11371235056Eko1.jpg', 'FACILITY MANAGEMENT', 'Sukarman', '90002287', '08154547875', '2011-03-13', '2011-03-14', '2011-03-15', NULL, NULL, NULL, NULL, '09:00:00', '17:00:00', 'App', '', '2011-03-13 23:51:39', 'App', 'Sukarman', '90002287', '2011-03-14 06:40:24', 'App', 'Rahmat', '32800003', '2011-03-14 06:44:25', 'App', 'Sukarman', '90002287', '2011-03-14 06:40:37', 'App', 'Sahlani', '32800001', '2011-03-14 06:45:25', 'App', 'Ali', '30001234', '2011-03-14 06:46:15', 'Yes', '90347213111117');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
