<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  @foreach ($infos as $info)
    
    <link rel="icon" type="image/png" href="{{ $info->logo ? asset($info->logo) : asset('assets/img/noimg.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ $info->logo ? asset($info->logo) : asset('assets/img/noimg.png') }}">
    <!-- <link rel="icon" type="image/png" href="../assets/img/logo-smk.png"> -->
    @endforeach
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Guru - @yield('title')</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
    name='viewport' />
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/css/jquery-editable.css"
    rel="stylesheet" />

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script>$.fn.poshytip = { defaults: null }</script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jquery-editable/js/jquery-editable-poshytip.min.js"></script>

  <!-- Custom CSS for animation -->
  <style>
    .navbar-brand-container {
      width: 100%;
      height: 100%;
      overflow: hidden;
      display: inline-block;
    }

    .navbar-brand {
      display: inline-block;
      white-space: nowrap;
      box-sizing: border-box;
      width: 100%;
      height: 100%;
    }

    .navbar-brand span {
      display: inline-block;
      padding-right: 100%;
      /* Tambahkan ruang kosong di kanan teks */
      animation: marquee 20s linear infinite;
      /* Perpanjang durasi animasi */
    }

    @keyframes marquee {
      00% {
        transform: translateX(100%);
      }

      100% {
        transform: translateX(-100%);
      }
    }
  </style>
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar" data-color="navy" data-active-color="danger">
      @foreach ($infos as $info)
      @include('guru.layouts.sidebar')
    @endforeach

    </div>
    <div class="main-panel">
      <!-- Navbar -->
      @include('guru.layouts.topbar')

      <!-- End Navbar -->

      <!-- Content -->
      @yield('content')
      <!-- End Content -->
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <div class="credits ml-auto">
              <span class="copyright">
                ©
                <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i>
                by Nadhif Adyatmaz - Supported by Politeknik Negeri Malang
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- Core JS Files -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Google Maps Plugin -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!-- Notifications Plugin -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  {{--
  <script>
    $(document).ready(function () {
      demo.initChartsPages();
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var canvas = document.getElementById('myCanvas');
      var ctx = canvas.getContext('2d');
      var img = new Image();
      img.src = '../assets/img/smk-full.png'; // Ganti dengan path gambar Anda
      img.onload = function () {
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
      }
    });
  </script> --}}

  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

  <script>
    $(document).ready(function () {
      $('#myDataTable').DataTable();
    });
  </script>
</body>

</html>