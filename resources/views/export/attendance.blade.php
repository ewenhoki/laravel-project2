{{-- <!DOCTYPE html>
<html>
<head>
	<title>Absensi Bimbingan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        tr {
            line-height: 15px;
            min-height: 15px;
            height: 15px;
        }
        .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        text-align: left;
        }
        body, html {
            height: 100%;
            background-image: url({{ public_path('watermark/bimbingan.png') }});
            background-position: top left;
            background-repeat: no-repeat;
            background-size: 100%;
            width:100%;
            height:100%;
        }
        @page {
            margin: 0px 0px 0px 0px !important;
            padding: 0px 0px 0px 0px !important;
        }
    </style>
</head>
<body>
    <div class="container">
    <h5 class="text-left">UNIVERSITAS PADJADJARAN</h5>
    <h6 class="text-left">FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM</h6>
    <h6 class="text-left">DEPARTEMEN MATEMATIKA</h6>
    <br>
    <h5 class="text-center">ABSENSI BIMBINGAN TUGAS AKHIR</h5>
    <hr>
    <p>NPM&nbsp;&nbsp; : {{ auth()->user()->student->npm }}</p>
    <p>Dosen : {{ $lecturer->user->name }}</p>
    <table class="table table-bordered">
        <tr>
            <th class="text-center">No.</th>
            <th class="text-center">Judul</th>
            <th class="text-center">Deskripsi</th>
            <th class="text-center">Waktu</th>
        </tr>
        @foreach ($attendance as $key => $attend)
        <tr>
            <td class="text-center">{{ $key+1 }}</td>
            <td>{{$attend->title }}</td>
            <td>{{$attend->description}}</td>
            <td class="text-center">{{$attend->date_time}}</td>
        </tr>
        @endforeach
    </table>
    <p class="text-right">{{ $date->locale('id')->isoFormat('dddd, D MMMM Y') }}</p> 
    <p class="text-right">{{ $lecturer->user->name }}</p>
    <p class="text-right">{{ $lecturer->nip }}</p>
        <p>{{ $date }}</p>
</div>
</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
	<title>Absensi Bimbingan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
    body{
        font-family: "Times New Roman";
        }
    h5{
        font-size: 120%;
    }
    table,th,td{
        border: 1px solid black;
        padding: 6px;
    }
    table{
        border-collapse: collapse;
    }
    th{
        height: 30px;
    }
    td{
        word-wrap: break-word;
    }
        tr {
            line-height: 15px;
            min-height: 15px;
            height: 15px;
        }
.footer{
    width: 100%;
    height: 50px;
    padding-left: 10px;
    line-height: 50px;
    position: absolute;
    bottom: 0px;
}
        body, html {
            height: 100%;
            background-image: url({{ public_path('watermark/bimbingan.png') }});
            background-position: top left;
            background-repeat: no-repeat;
            background-size: 100%;
            width:100%;
            height:100%;
        }
        @page {
            margin: 0px 0px 0px 0px !important;
            padding: 0px 0px 0px 0px !important;
        }
.marginkiri{
	margin-left: 40px;
}
.marginkanan{
    margin-right: 40px;
}
.marginheader{
    margin-top: 40px;
    margin-left: 40px;
}
.margintabel{
    margin-left: 10px;
    margin-right: 10px;
}
    </style>
</head>
<body>
    <h5 class="marginheader" align="left">UNIVERSITAS PADJADJARAN</h5>
    <h6 class="marginkiri" align="left">FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM</h6>
    <h6 class="marginkiri" align="left">DEPARTEMEN MATEMATIKA</h6>
    <br>
    <h5 class="text-center">ABSENSI BIMBINGAN TUGAS AKHIR</h5>
    <hr style="border-bottom: 2px">
    <p class="marginkiri">Nama&nbsp; : {{ auth()->user()->name }}</p>
    <p class="marginkiri">NPM&nbsp;&nbsp;  : {{ auth()->user()->student->npm }}</p>
    <p class="marginkiri">Dosen Pembimbing : {{ $lecturer->user->name }}</p>
    <table class="margintabel" style="width:100%">
        <tr>
            <th style="width:5%" class="text-center">No.</th>
            <th style="width:40%" class="text-center">Judul</th>
            <th style="width:40%" class="text-center">Deskripsi</th>
            <th style="width:15%" class="text-center">Waktu</th>
        </tr>
        @foreach ($attendance as $key => $attend)
        <tr>
            <td style="width:5%" class="text-center">{{ $key+1 }}</td>
            <td style="width:40%">{{$attend->title }}</td>
            <td style="width:40%">{{$attend->description}}</td>
            <td style="width:15%" class="text-center">{{$attend->date_time}}</td>
        </tr>
        @endforeach
    </table>
    <br>
    <p class="marginkanan" align="right">{{ $date->locale('id')->isoFormat('dddd, D MMMM Y') }}</p> 
    <br>
    <br>
    <p class="marginkanan" align="right">{{ $lecturer->user->name }}</p>
    <p class="marginkanan" align="right">NIP.{{ $lecturer->nip }}</p>
    <div class="footer">
        <p>{{ $date }}</p>
    </div>
</body>
</html>