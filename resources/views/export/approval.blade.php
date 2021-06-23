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
            line-height: 60%;
        }
        .marginkanan{
            margin-right: 40px;
            line-height: 60%;
        }
        .marginheader{
            margin-top: 40px;
            margin-left: 40px;
        }
        .marginheaderkiri{
            margin-left: 40px;
            line-height: 90%;
        }
        .margintabel{
            margin-left: 30px;
            margin-right: 30px;
        }
    </style>
</head>
<body>
    <h5 class="marginheader" align="left">UNIVERSITAS PADJADJARAN</h5>
    <h6 class="marginheaderkiri" align="left">FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM</h6>
    <h6 class="marginheaderkiri" align="left">DEPARTEMEN MATEMATIKA</h6>
    <h5 class="text-center">SURAT PERSETUJUAN</h5>
    <hr style="border-bottom: 2px">
    <p class="marginkiri" style="margin-top:20px;">Nama&nbsp; : {{ auth()->user()->name }}</p>
    <p class="marginkiri">NPM&nbsp;&nbsp;  : {{ auth()->user()->student->npm }}</p>
    <p class="marginkiri">Dosen Pembimbing : {{ $lecturer_1->user->name }}</p>

    <br>
    <p class="marginkanan" align="right">{{ $date->locale('id')->isoFormat('dddd, D MMMM Y') }}</p> 
    <br>
    <br>
    <p class="marginkanan" align="right">{{ $kaprodi->name }}</p>
    <div class="footer">
        <p>{{ $date }}</p>
    </div>
</body>
</html>