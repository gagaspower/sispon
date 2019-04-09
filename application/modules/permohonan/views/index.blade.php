@extends('admin')
@section('content')
<div class="box-body">
    <div class="row">
      <section class="content-header">
        <div class="pull-left"><h3><i class="ion ion-clipboard"></i> Daftar Permohonan Sponsorship</h3></div>
        <?php 
        $ci = &get_instance();
        if($ci->session->userdata('role') == 2 ){ ?>
          <div class="pull-right"> <button type="button " class="btn btn-info btn-flat btn-sm" onclick="window.location.href='<?php echo base_url('permohonan/tambah_permohonan')?>'">
            <i class="fa fa-plus-square"></i> Buat Permohonan</button>
          </div>
        <?php } ?>
      </section>
    </div>
  </div>
  @php
    $CI = &get_instance();
    echo $CI->session->flashdata("k");
  @endphp
  <div class="box box-success">
    <div class="box-body">
      <table id="table"
            class="table table-striped"
            data-pagination="true" 
            data-toggle="table" 
            data-search="true"  
            data-page-size="20"
            data-toolbar="#toolbar">
          <thead>
              <tr>
                <th>Kode Permohonan</th>
                <th>Tgl. Permohonan</th>
                <th>Judul Permohonan</th>
                <th>Status Permohonan</th>
                <th>Action</th>
              </tr>
          </thead>
          <tbody>
                @foreach($result as $row)
              <tr>
                  <td>{{ $row['kode_pengajuan'] }}</td>
                  <td class="text-center">{{ \Carbon\Carbon::parse($row['tgl_pengajuan'])->format('d/m/Y') }}</td>
                  <td>{{ $row['judul_pengajuan']}} </td>
                  <td class="text-center">
                      {{--  status 01 proposal baru--}}
                      @if($row['status_pengajuan'] == '01')
                      <span class="text-aqua">Pending</span>
                      {{-- status 02 proposal sedang diproses --}}
                      @elseif($row['status_pengajuan'] == '02')
                      <span class="text-green">Sedang Diproses</span>
                      {{-- status 03 proposal disetujuai --}}
                      @elseif($row['status_pengajuan'] == '03')
                      <span class="text-light-blue">Di setujui</span>
                      {{-- status 04 ditolak --}}
                      @else 
                      <span class="text-red">Ditolak</span>
                      @endif
                  </td>
                  <td>
                    @if($row['status_pengajuan'] == '01')
                    <?php 
                    $ci = &get_instance();
                    if($ci->session->userdata('role') == 2 ){ 
                    ?>
                    <button type="button" class="btn btn-flat btn-xs btn-info btn-space" onclick="window.location.href='<?php echo base_url('permohonan/edit/'.$row['id']);?> '"><i class="fa fa-pencil-square-o"></i> Revisi</button>                 
                    <?php 
                    }
                    //  $ci = &get_instance();
                     if($ci->session->userdata('role') == 1 ){ ?>
                    <button type="button" class="btn btn-flat btn-xs btn-warning btn-space" onclick="window.location.href='<?php echo base_url('permohonan/proses_permohonan/'.$row['id']);?> '"><i class="fa fa-rocket"></i> Proses Proposal</button>
                    <?php } ?>
                    @elseif($row['status_pengajuan'] == '02')
                    <?php 
                    $ci = &get_instance();
                    if($ci->session->userdata('role') == 1 ){ ?>
                    <button type="button" class="btn btn-flat btn-xs btn-success btn-space" onclick="window.location.href='<?php echo base_url('permohonan/approve/'.$row['id']);?> '"><i class="fa fa-check-square-o"></i> Setujui</button>
                    <button type="button" class="btn btn-flat btn-xs btn-danger btn-space" onclick="window.location.href='<?php echo base_url('permohonan/reject/'.$row['id']);?> '"><i class="fa fa-exclamation-triangle"></i> Tolak</button>
                    <?php } ?>
                    @endif
                    <button type="button" class="btn btn-flat btn-xs btn-default btn-space " onclick="window.open('<?php echo base_url('dokumen/proposal/'.$row['file_proposal']);?>')"><i class="fa fa-eye"></i> Lihat dokumen</button>
                  </td>
              </tr>
                 @endforeach
          </tbody>
      </table>
    </div>
  </div>
@endsection