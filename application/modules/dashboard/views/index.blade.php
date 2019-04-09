@extends('admin')
@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{ $total_permohonan }}</h3>
          <p>Total Permohonan</p>
        </div>
        <div class="icon">
          <i class="ion ion-soup-can-outline"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>
            {{ $proses_permohonan }}
          </h3>
          <p>Permohonan Diproses</p>
        </div>
        <div class="icon">
          <i class="ion ion-soup-can-outline"></i>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3>
             {{ $reject_permohonan }}
          </h3>
          <p>Permohonan Ditolak</p>
        </div>
        <div class="icon">
          <i class="ion ion-soup-can-outline"></i>
        </div>
      </div>
    </div>


    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3>
              {{ $approve_permohonan }}
          </h3>
        <p>Permohonan Disetujui</p>
        </div>
        <div class="icon">
          <i class="ion ion-soup-can-outline"></i>
        </div>
      </div>
    </div>
  </div>

@endsection