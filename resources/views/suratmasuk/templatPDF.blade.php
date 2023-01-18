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

<h2>Laporan Surat Masuk</h2>
<table id="myTable">
    <thead>
        <tr>
            <th>No. Surat</th>
            <th>Jenis Surat</th>
            <th>Perihal</th>
            <th>Pengirim</th>
            <th>Tanggal Surat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{ $row->no_surat }}</td>
                <td>{{ $row->jenis_surat }}</td>
                <td>{{ $row->perihal }}</td>
                <td>{{ $row->pengirim }}</td>
                <td>{{ date('d-m-Y', strtotime($row->tanggal_surat)) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


</body>
</html>