<!DOCTYPE html>
<html>

<head>
    <style>
        #myTable {
            font-family: 'Times New Roman', Times, serif;
            border-collapse: collapse;
            width: 100%;
            border-color: black;
        }

        #myTable td,
        #myTable th {
            border: 2px solid #000000;
            padding: 8px;
            font-size: 11px;
            vertical-align: top;
        }

        #myTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            font-weight: normal;
            display: block;
        }

        h3,
        p {
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
            text-align: center;
            font-weight: bold;
        }

        p {
            font-size: 12px;
        }

        .field {
            font-size: 13px;
            line-height: 1.5;
        }

        img {
            width: 120px;
            height: 120px;
        }

        .image {
            float: left;
            width: 20%;
            text-align: right;
            margin-left: 20px;
        }

        .text {
            width: 80%;
            margin-left: 20px;
        }

        .row {
            border: 2px solid #000000;
            border-bottom: 0;
            padding: 10 10 10 10;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="row th">
    <div class="image">
        <img src="{{ public_path('assets\images\logo-jateng.jpg') }}">
    </div>
    <div class="text">
        <h4>
            PEMERINTAH PROVINSI JAWA TENGAH <br>
            DINAS PENDIDIKAN DAN KEBUDAYAAN
        </h4>
        <h3>
            SEKOLAH MENENGAH ATAS NEGERI 1 <br>
            KAJEN
        </h3>
        <p class="center">
            Alamat : Jl. Mandurorejo Kajen Telp. (0285) 381708 Pekalongan 51161 <br>
            Website : www.smankajen.sch.id Email : sman1kajen@yahoo.com
        </p>
    </div>
    </div>

    <table id="myTable">
        <tbody>
            <tr>
                <td colspan="1">
                    <p class="field">
                        Nomor Agenda;: {{ $data->surat_masuk->no_surat }} <br>
                        Tanggal: {{ $today->format('d-m-Y') }}
                    </p>
                </td>
                <td colspan="1">
                    <p class="field">
                        Diselesaikan Tanggal: <br>
                          Yang Menyelesaikan:
                    </p>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <p class="field">
                        Perihal: {{ $data->surat_masuk->perihal }} <br>
                        Tanggal Surat: {{ date('d-m-Y', strtotime($data->surat_masuk->tanggal_surat)) }} <br>
                        Pengirim: {{ $data->surat_masuk->pengirim }}
                    </p>
                </td>
            </tr>

            <tr>
                <td class="center">
                    <h3>INTRUKSI</h3> <br>
                    <p class="field">{{ $data->intruksi }}</p>
                </td>
                <td class="center">
                    <h3>DITERUSKAN KEPADA</h3> <br>
                    <p class="field">{{ $data->kepada }}</p>
                </td>
            </tr>

            <tr>
                <td>
                    <p class="field">
                        Catatan: <br>
                        {{ $data->catatan }}
                    </p>
                </td>
                <td>
                    <p class="field">
                        Kajen, {{ $today->format('d-m-Y') }} <br>
                        Kepala Sekolah,
                        <br>
                        <br>
                        <br>
                        <br>
                        <u>IRCHAM JUNAIDI, S.Pd., M.Pd.</u> <br>
                        NIP. 196810171994031007
                    </p>
                </td>
            </tr>
        </tbody>
    </table>


</body>

</html>