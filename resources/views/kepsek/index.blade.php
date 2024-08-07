@extends('kepsek/master')

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

@section('content')
<div class="content">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-single-02 text-warning"></i>
              </div>
            </div>
            {{-- <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">User</p>
                <p class="card-title">150
                <p>
              </div>
            </div> --}}
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Total Guru</p>
                <p class="card-title">{{ $guru_count }}
                  {{--
                <p class="card-title">10
                <p> --}}
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            {{-- <i class="fa fa-refresh"></i>
            Update Now --}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
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
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            {{-- <i class="fa fa-calendar-o"></i>
            Last day --}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
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
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            {{-- <i class="fa fa-clock-o"></i>
            In the last hour --}}
          </div>
        </div>
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
        <div class="card-footer ">
          <hr>
          <div class="stats">
            {{-- <i class="fa fa-refresh"></i>
            Update now --}}
          </div>
        </div>
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
      </div>
    </div>
  </div>
</div>
@endsection