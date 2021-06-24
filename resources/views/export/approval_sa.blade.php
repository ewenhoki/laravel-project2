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
	margin-left: 60px;
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
    </style>
</head>
<body>
    <h5 class="marginheader" align="left">UNIVERSITAS PADJADJARAN</h5>
    <h6 class="marginheaderkiri" align="left">FAKULTAS MATEMATIKA DAN ILMU PENGETAHUAN ALAM</h6>
    <h6 class="marginheaderkiri" align="left">DEPARTEMEN MATEMATIKA</h6>
    <hr style="border-bottom: 2px">
    <h5 class="text-center">LEMBAR PERSETUJUAN PENGAJUAN TUGAS AKHIR</h5>
    <br>
    <br>
    <p class="marginkiri">Dengan ini Ketua Program Studi S1 Matematika FMIPA Unpad menyatakan bahwa:</p>
    <p class="marginkiri" style="margin-top:30px;">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <b> {{ $student->user->name }}</b></p>
    <p class="marginkiri" style="margin-top:30px;">NPM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  : <b> {{ $student->npm }}</b></p>
    <p class="marginkiri" style="margin-top:30px;">Judul Skripsi : <b> {{ $student->file->title }}</b></p>
    <br>
    <p class="marginkiri">Telah mendapatkan persetujuan pengajuan tugas akhir dengan prosedur dan ketentuan yang berlaku.</p>
    <br>
    @if($student->lecturers()->wherePivot('order',1)->first() && $student->lecturers()->wherePivot('order',2)->first())
    @if($student->lecturers()->wherePivot('order',1)->first()->pivot->progress>=2 && $student->lecturers()->wherePivot('order',1)->first()->pivot->progress>=2)
    <p class="text-center">Mengetahui :</p>
    <table align="center" width="100%">
        <tr>
            <td class="text-center">Calon Pembimbimg I</td>
            <td class="text-center">Calon Pembimbing II</td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <table align="center" width="100%">
        <tr>
            <th class="text-center">({{ $student->lecturers()->wherePivot('order',1)->first()->user->name }})</th>
            <th class="text-center">({{ $student->lecturers()->wherePivot('order',2)->first()->user->name }})</th>
        </tr>
    </table>
    <br>
    @endif
    @endif
    <p class="text-center">Disetujui oleh :</p>
    <p class="text-center">Ketua Program Studi S1 Matematika</p>
    <br>
    <br>
    <br>
    <p class="text-center"><b>({{ $kaprodi->name }})</b></p>
</body>
</html>