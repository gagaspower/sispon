@extends('admin')
@section('content')
<div class="box-body">
    <div class="row">
      <section class="content-header">
        <div class="pull-left"><h3><i class="ion ion-clipboard"></i> Daftar Role</h3></div>
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
                <th>Roles</th>
                <th>Action</th>
              </tr>
          </thead>
          <tbody>
                @foreach($result as $row)
              <tr>
                  <td>{{ $row['nama_role'] }}</td>
                  <td>
                    <button type="button" class="btn btn-flat btn-xs btn-info btn-space" onclick="window.location.href='<?php echo base_url('jabatan/edit/'.$row['id']);?> '"><i class="fa fa-pencil-square-o"></i> Edit</button>
                </td>
              </tr>
                 @endforeach
          </tbody>
      </table>
    </div>
  </div>
@endsection