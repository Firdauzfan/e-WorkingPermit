</head>
<body >
<form id="form1" name="form1" method="GET" action="">
<table width="980" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td><?php include("head.php"); ?></td>
  </tr>
  <tr>
    <td>
	<table width="100%" border="0" cellpadding="0">
      <tr>
        <td>
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td nowrap="nowrap"><span class="judul"><?php echo $judul;?></span></td>
            <td align="right" valign="top" nowrap="nowrap">
            <input type="text" name="cari" id="cari" value = "<?php echo $cari;?>"
            style="height:10pt; width:150pt; font-size:13px;" autocomplete="off"/>
            <input name="submit" type="submit" value="Cari..." style="height:16pt; font-size:9px" /></td>
          </tr>
        </table>
        </td>
      </tr>
      <tr>
        <td>