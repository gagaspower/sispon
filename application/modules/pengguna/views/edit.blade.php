@extends('admin')
@section('content')
<div class="box-header with-border">
        <h3 class="box-title"><i class="ion ion-clipboard"></i> Edit Pengguna</h3>
    </div>
  <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" id="form">
  <input type="hidden" name="id" id="id_pengguna" value="{{ $pengguna['id']}}">
    <div class="box box-success">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-4">
                      <input type="text" name="nama" class="form-control" id="nama_pengguna" autocomplete="off" value="{{$pengguna['nama']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-4">
                      <input type="email" name="email" class="form-control" id="email_pengguna" autocomplete="off" value="{{$pengguna['email']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Jabatan</label>
                    <div class="col-sm-4">
                     <select name="jabatan_id" id="jabatan_id" class="form-control select2">
                          @foreach($jabatans as $row)
                            <option value="{{$row['id']}}" <?php if($row['id'] == $pengguna['role_id']) echo "selected"; ?>>{{$row['nama_role']}}</option>
                          @endforeach
                     </select>
                    </div>
                </div>
                    <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-4">
                      <input type="password" name="password" class="form-control" id="pass_pengguna" autocomplete="off">
                    </div>
                </div>
              </div>
  
        </div>
      <div class="box-footer">
           <button type="button" class="btn btn-default" onclick="window.location.href='<?php echo base_url('pengguna/show_pengguna');?>'"><i class="fa fa-refresh"></i> Kembali</button>
        <button type="button" class="btn btn-info" id="simpan_pengguna"><i class="fa fa-save"></i> Simpan</button>
      </div>
    </div>
  </form> 
@endsection
@section('js-bottom')
<script>
            $("#simpan_pengguna").click(function () {
                var id = $("#id_pengguna").val();
                var nama = $("#nama_pengguna").val();
                var email = $('#email_pengguna').val();
                var jabatan = $("#jabatan_id").val();
                var password = $("#pass_pengguna").val();

                if( "" == nama){
                  swal({
                    type: 'error',
                    title: 'Nama wajib diisi.',
                    showConfirmButton: true
                    });
                    return false;
                }

              if( "" == email){
                    swal({
                      type: 'error',
                      title: 'Email wajib diisi.',
                      showConfirmButton: true
                        });
                        return false;
                }
                if( "" == jabatan){
                    swal({
                      type: 'error',
                      title: 'jabatan/Role wajib diisi.',
                      showConfirmButton: true
                        });
                        return false;
                }
                $.ajax({
                    url:'<?php echo base_url();?>pengguna/update',
                    data: {
                        id : id,
                        nama : nama,
                        email : email,
                        jabatan_id : jabatan,
                        password : password
                      },
                    dataType:'json',
                    type:'post',
                      success: function(data){
                      console.log(data);
                      swal({
                        type: 'success',
                        title: 'Pengguna telah disimpan.',
                        showConfirmButton: true
                        });
                        disable_all();
                   },
                    error: function(data){
                      console.log(data)
                      swal({
                        type: 'error',
                        title: 'Pengguna gagal disimpan.',
                        showConfirmButton: true
                        });
                    }
                });
            });


            function disable_all(){
                $('#nama_pengguna').attr("disabled",true);
                $('#email_pengguna').attr("disabled",true);
                $('#jabatan_id').select2("enable",false);
                $('#pass_pengguna').attr("disabled",true);              
            }
</script>
@endsection