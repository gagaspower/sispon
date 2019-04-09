@extends('admin')
@section('content')
<div class="box-header with-border">
        <h3 class="box-title"><i class="ion ion-clipboard"></i> Tambah Pengguna</h3>
    </div>
  <center><div id="result"></div></center>
  <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" id="form">
    <div class="box box-success">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-4">
                      <input type="text" name="nama" class="form-control" id="nama_pengguna" autocomplete="off">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-4">
                      <input type="email" name="email" class="form-control" id="email_pengguna" autocomplete="off">
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
      <div class="box-footer text-center">
           <button type="button" class="btn btn-default" onclick="window.location.href='<?php echo base_url('pengguna/show_pengguna');?>'"><i class="fa fa-refresh"></i> Kembali</button>
        <button type="button" class="btn btn-info" id="simpan_pengguna"><i class="fa fa-save"></i> Simpan</button>
      </div>
    </div>
  </form> 
@endsection
@section('js-bottom')
<script>
            $("#simpan_pengguna").click(function () {
                var nama = $("#nama_pengguna").val();
                var email = $('#email_pengguna').val();
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


                if( "" == password){
                    swal({
                        type: 'error',
                        title: 'Password wajib diisi.',
                        showConfirmButton: true
                        });
                        return false;
                }

                $.ajax({
                    url:'<?php echo base_url();?>pengguna/store',
                    data: {
                        nama : nama,
                        email : email,
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
                $('#pass_pengguna').attr("disabled",true);
              
            }
</script>
@endsection