
<!DOCTYPE html>
<html>
<head>
    <title><?= $judul ?></title>
<style>

body{
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}
#customers {
  border-collapse: collapse;
  width: 100%;
  
}

#customers td {
  border: 0px solid $#ddd;
  padding: 8px;
  font-size: 12px;
}
#customers th{
  padding: 8px;
  font-size: 12px;
}


#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #858796;
  color: white;
}
</style>
</head>
<body>
<table border="0" width="100%">
    <tr>
        <td align="center"><h1>Laporan Data Barang</h1></td>
    </tr>
    <tr>
        <td align="center">
            
            
        </td>
    </tr>
</table>
<br>
<table id="customers">
  <tr>
    <th>No</th>
    <th>ID Barang</th>
    <th>Nama Barang</th>
    <th>Kategori Barang</th>
    <th>Satuan</th>
  </tr>
      <?php $no=1; foreach ($data as $b) { ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $b->id_barang ?></td>
          <td><?= $b->nama_barang ?></td>
          <td><?= $b->kategori_barang ?></td>
          <td><?= $b->nama_satuan ?></td>
          
        </tr>
        <?php } ?>
</table>

</body>
</html>
