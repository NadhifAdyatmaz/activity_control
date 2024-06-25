@extends('admin/master')

@section('title', 'Dashboard')

<style>
  .marquee-container {
    width: 100%;
    overflow: hidden;
    background: #f8f9fa;
    padding: 10px 0;
  }

  .marquee {
    display: inline-block;
    white-space: nowrap;
    animation: marquee 15s linear infinite;
  }

  @keyframes marquee {
    0% {
      transform: translateX(100%);
    }
    100% {
      transform: translateX(-100%);
    }
  }
</style>

@section('admin')
<div class="content">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <a href="{{ route('admin.masterdata.guru') }}">
            <div class="row">
              <div class="col-5 col-md-4">
                <div class="icon-big text-center icon-warning">
                  <i class="nc-icon nc-single-02 text-warning"></i>
                </div>
              </div>
              <div class="col-7 col-md-8">
                <div class="numbers">
                  <p class="card-category">Total Guru</p>
                  <p class="card-title">{{ $guru_count }}
                  <p>
                </div>
              </div>
            </div>
          </a>
        </div>
        <!-- <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-refresh"></i>
            Update Now
          </div>
        </div> -->
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
        <a href="{{ route('admin.jadwal') }}">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-tile-56 text-primary"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Total Jadwal</p>
                <p class="card-title">{{ $jadwal_count }}
                <p>
              </div>
            </div>
          </div>
          </a>
        </div>
        <!-- <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-refresh"></i>
            Update Now
          </div>
        </div> -->
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
        <a href="{{ route('admin.jurnal') }}">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-map-big text-danger"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Total Jurnal</p>
                <p class="card-title">{{ $jurnal_count }}
                <p>
              </div>
            </div>
          </div>
          </a>
        </div>
        <!-- <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-refresh"></i>
            Update Now
          </div>
        </div> -->
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-tap-01 text-primary"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Approval</p>
                <p class="card-title">{{ $approval }}
                <p>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="card-footer ">
          <hr>
          <div class="stats">
            <i class="fa fa-refresh"></i>
            Update now
          </div>
        </div> -->
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card ">
        <div class="card-header ">
          <!-- <h5 class="card-title">Users Behavior</h5>
                <p class="card-category">24 Hours performance</p> -->
        </div>
        <div class="card-body ">
        <div class="row">
  <div class="col-md-12">
      <div class="marquee-container">
        <div class="marquee">
          <h1>SMK Negeri 1 Tanjung Bumi - Mendidik Setulus Hati</h1>
        </div>
      </div>
    </div>
        </div>
        </div>
        <!-- <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-history"></i> Updated 3 minutes ago
                </div>
              </div> -->
      </div>
    </div>
  </div>
  <!-- <div class="row">
  <div class="col-md-12">
      <div class="marquee-container">
        <div class="marquee">
          <p>Ini adalah teks berjalan yang menyesuaikan besar konten. Tambahkan teks yang Anda inginkan di sini.</p>
        </div>
      </div>
    </div>
        </div> -->
</div>
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
</script>
@endsection