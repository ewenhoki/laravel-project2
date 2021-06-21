<!DOCTYPE html>
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
    </style>
</head>
<body>
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
    <div class="footer">
        <p>{{ $date }}</p>
    </div>
</body>
</html>