<!DOCTYPE html>
<html>
<head>
<style>
#myTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#myTable td, #myTable th {
  border: 1px solid #ddd;
  padding: 8px;
  font-size: 11px;
}

#myTable tr:nth-child(even){background-color: #f2f2f2;}

#myTable tr:hover {background-color: #ddd;}

#myTable th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #04AA6D;
  color: white;
  font-size: 11px;
}

h2 {
    text-align: center;
}
</style>
</head>
<body>

<h2>Disposisi Surat Masuk</h2>
<table id="myTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Intruksi</th>
            <th>Daftar Penerima</th>
            <th>Nomor Surat</th>
            <th>Catatan</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->intruksi }}</td>
                <td>{{ $data->kepada }}</td>
                <td>{{ $data->surat_masuk->no_surat }}</td>
                <td>{{ $data->catatan }}</td>
            </tr>
    </tbody>
</table>


</body>
</html>