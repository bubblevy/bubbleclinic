@extends('layouts.main.index')
@section('container')
<style>
  .apexcharts-legend-series {
    display: none;
  }

  .apexcharts-title-text {
    font-size: 1rem;
    font-weight: 700 !important;
  }
</style>
<div class="row">
  <div class="col-6 col-lg-3 mb-4">
    <div class="card h-100">
      <div class="card-body px-3 py-4-5">
        <div class="row p-2 p-lg-0">
          <div class="col-md-4">
            <div class="stats-icon" style="background-color: #008080;">
              <i class="bx bx-group text-white fs-3"></i>
            </div>
          </div>
          <div class="col-md-8">
            <h6 class="text-muted mt-3 mt-lg-0 fw-bold mb-2">Pasien Hari ini</h6>
            <h6 class="mb-0 fw-bold">{{ $patientsToday }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3 mb-4">
    <div class="card h-100">
      <div class="card-body px-3 py-4-5">
        <div class="row p-2 p-lg-0">
          <div class="col-md-4">
            <div class="stats-icon" style="background-color: #ff7f50;">
              <i class="bx bx-group text-white fs-3"></i>
            </div>
          </div>
          <div class="col-md-8">
            <h6 class="text-muted mt-3 mt-lg-0 mb-2 fw-bold">Pasien Kemarin</h6>
            <h6 class="mb-0 fw-bold">{{ $patientsYesterday }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-6 col-lg-3 mb-4">
    <div class="card h-100">
      <div class="card-body px-3 py-4-5">
        <div class="row p-2 p-lg-0">
          <div class="col-md-4">
            <div class="stats-icon" style="background-color: #800080 ;">
              <i class="bx bx-group text-white fs-3"></i>
            </div>
          </div>
          <div class="col-md-8">
            <h6 class="text-muted mt-3 mt-lg-0 mb-2 fw-bold">Pasien Bulan ini</h6>
            <h6 class="mb-0 fw-bold">{{ $patientsMonthly }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="col-6 col-lg-3 mb-4">
    <div class="card h-100">
      <div class="card-body px-3 py-4-5">
        <div class="row p-2 p-lg-0">
          <div class="col-md-4">
            <div class="stats-icon" style="background-color: #6a5acd;">
              <i class="bx bx-group text-white fs-3"></i>
            </div>
          </div>
          <div class="col-md-8">
            <h6 class="text-muted mt-3 mt-lg-0 mb-2 fw-bold">Total Pasien</h6>
            <h6 class="mb-0 fw-bold">{{ $totalPatient }}</h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 col-lg-5 order-0 mb-4">
    <div class="card h-100">
      <div class="card-header">
        <div>
          <h5 class="card-title m-0 me-2 fw-bold mb-2" style="font-family: poppins; font-size:1rem;">Data Antrian</h5>
          <small class="text-muted" style="font-family: poppins; font-size:12px; color:rgb(86, 106, 127) !important;">Berikut daftar nomor antrian pasien hari ini</small>
        </div>
      </div>
      <div class="card-body">
        @if(!$patients->isEmpty())
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex flex-column align-items-center gap-1">
            <h2 class="mb-2 fw-bold" style="color:#566a7f;">{{ $numberQueueNow->queueNumber->number }}</h2>
            <span>Nomor Antrian Sekarang</span>
          </div>
          <div id="usersChart" data-laki-laki="{{ $totalLakiLaki }}" data-perempuan="{{ $totalPerempuan }}"></div>
        </div>
        <ul class="p-0 m-0">
          @foreach($patients as $patient)
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              @if($patient->gender == 'Perempuan')
              <img src="{{ asset('assets/img/profil-images-default/girl.jpeg') }}" alt="Profile Image" class="rounded">
              @else
              <img src="{{ asset('assets/img/profil-images-default/man.jpeg') }}" alt="Profile Image" class="rounded">
              @endif
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-1 text-capitalize">{{ $patient->name }}</h6>
                <small class="text-muted d-block">{{ Str::limit($patient->created_at->locale('id')->diffForHumans(), 30, '...') }}</small>
              </div>
              <div class="user-progress d-flex align-items-center gap-1">
                <span class="badge badge-center bg-info rounded-pill">{{ $patient->queueNumber->number }}</span>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
        @else
        <p class="text-center"><i class="bx bx-info-circle fs-6" style="margin-bottom: 2px;"></i>&nbsp;Belum ada antrian</p>
        @endif
      </div>
    </div>
  </div>

  <div class="col-md-6 col-lg-7 order-2 mb-4">
    <div class="card h-100">
      <div class="card-body">
        {!! $chart->container() !!}
      </div>
    </div>
  </div>
</div>


<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
@endsection
