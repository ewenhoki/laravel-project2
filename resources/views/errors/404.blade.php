<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/img/logo-unpad.png')}}">
    <title>Error 404</title>
    <link href="{{asset('admin/dist/css/style.css')}}" rel="stylesheet">
    <!-- This page CSS -->
    <link href="{{asset('admin/dist/css/pages/error-pages.css')}}" rel="stylesheet">
</head>

<body>
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body center-align">
                <h1>404</h1>
                <h3>Halaman Tidak Ditemukan !</h3>
                <p class="m-t-30 m-b-30">KLIK TOMBOL DIBAWAH INI UNTUK KEMBALI</p>
                <a href="/" class="btn btn-round red waves-effect waves-light m-b-40">Kembali ke Beranda</a>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{asset('admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('admin/dist/js/materialize.min.js')}}"></script>
</body>

</html>