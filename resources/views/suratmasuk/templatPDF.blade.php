<!DOCTYPE html>
<html>

<head>
    <style>
        #myTable {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #myTable td,
        #myTable th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 11px;
        }

        #myTable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #myTable tr:hover {
            background-color: #ddd;
        }

        #myTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: lightslategray;
            color: white;
            font-size: 11px;
        }

        h1,
        h2,
        h3,
        h5,
        p {
            text-align: center;
            margin-bottom: 0;
            margin-top: 5px;
        }

        h4 {
            text-align: center;
            margin-bottom: 0;
            margin-top: 0;
            font-weight: normal;
        }

        h3 {
            font-weight: bold;
        }

        p {
            font-size: 12px;
        }

        hr.solid-1 {
            border-top: 1px solid #000000;
            margin-top: 2px;
        }

        hr.solid-3 {
            margin-top: 6px;
            margin-bottom: 0;
            border-top: 3px solid #000000;
        }
    </style>
</head>

<body>
    <h4>
        PEMERINTAH PROVINSI JAWA TENGAH <br>
        DINAS PENDIDIKAN DAN KEBUDAYAAN
    </h4>
    <h3>
        SEKOLAH MENENGAH ATAS NEGERI 1 <br>
        KAJEN
    </h3>
    <p>
        Alamat: Jl. Mandurorejo Kajen Telp. (0285) 381708 Pekalongan 51161 <br>
        Website : www.smankajen.sch.id Email : sman1kajen@yahoo.com
    </p>

    <hr class="solid-3">
    <hr class="solid-1">

    <br>
    <h3>Laporan Surat Masuk</h3>
    <br>

    <table id="myTable">
        <thead>
            <tr>
                <th>No.</th>
                <th>No. Surat</th>
                <th>Jenis Surat</th>
                <th>Perihal</th>
                <th>Pengirim</th>
                <th>Tanggal Surat</th>
                <th>Tanggal Terima</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->no_surat }}</td>
                    <td>{{ $row->jenis_surat->nama_jenis }}</td>
                    <td>{{ $row->perihal }}</td>
                    <td>{{ $row->pengirim }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->tanggal_surat)) }}</td>
                    <td>{{ date('d-m-Y', strtotime($row->tanggal_terima)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>

</html>
