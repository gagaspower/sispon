@extends('admin')
@section('content')
<div class="box-body">
    <div class="row">
      <section class="content-header">
        <div class="pull-left"><h3><i class="ion ion-clipboard"></i> Daftar Komunitas</h3></div>
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
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Tlp</th>
                <th>Action</th>
              </tr>
          </thead>
          <tbody>
                @foreach($result as $row)
              <tr>
                  <td>{{ $row['nama_komunitas'] }}</td>
                  <td>{{ $row['alamat_komunitas'] }}</td>
                  <td>{{ $row['email_komunitas'] }}</td>
                  <td>{{ $row['tlp_komunitas'] }}</td>
                  <td>
                    <button type="button" class="btn btn-flat btn-xs btn-danger btn-space" onclick="window.location.href='<?php echo base_url('organisasi/delete/'.$row['id']);?> '"><i class="fa fa-trash"></i> Hapus</button>
                </td>
              </tr>
                 @endforeach
          </tbody>
      </table>
    </div>
  </div>
@endsection