@extends('admin')
@section('content')
<div class="box-body">
    <div class="row">
      <section class="content-header">
        <div class="pull-left"><h3><i class="ion ion-clipboard"></i> Daftar Pengguna</h3></div>
          <div class="pull-right"> <button type="button " class="btn btn-info btn-flat btn-sm" onclick="window.location.href='<?php echo base_url('pengguna/create')?>'">
            <i class="fa fa-plus-square"></i> Tambah Pengguna</button>
          </div>
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
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
          </thead>
          <tbody>
                @foreach($result as $row)
              <tr>
                  <td>{{ $row['nama'] }}</td>
                  <td>{{ $row['email'] }}</td>
                  <td>{{ $row['nama_role'] }}</td>
                  <td>
                    <button type="button" class="btn btn-flat btn-xs btn-info btn-space" onclick="window.location.href='<?php echo base_url('pengguna/edit/'.$row['id']);?> '"><i class="fa fa-pencil-square-o"></i> Edit</button>
                    <button type="button" class="btn btn-flat btn-xs btn-danger btn-space" onclick="window.location.href='<?php echo base_url('pengguna/destroy/'.$row['id']);?> '"><i class="fa fa-trash"></i> Hapus</button>
                </td>
              </tr>
                 @endforeach
          </tbody>
      </table>
      {{-- {!! $pagination->render() !!} --}}
    </div>
  </div>
@endsection