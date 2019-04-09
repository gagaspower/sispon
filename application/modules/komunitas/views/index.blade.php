@extends('admin')
@section('content')
<div class="box-header with-border">
    <h3 class=" text-center"><i class="ion ion-person-add"></i> Masuk atau Daftar ?</h3>
</div>
@php
$CI = &get_instance();
echo $CI->session->flashdata("k");
@endphp
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#login" data-toggle="tab">Masuk</a></li>
      <li><a href="#register" data-toggle="tab">Daftar Baru</a></li>
    </ul>
    <div class="tab-content">
      <div class="active tab-pane" id="login">
          <form action="<?php echo base_url('komunitas/login');?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-login">
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-5">
              <input type="email" class="form-control" id="email" name="email" placeholder="email@domain.com" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Password</label>

            <div class="col-sm-5">
              <input type="password" class="form-control" id="password" name="password" placeholder="****">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-5">
              <button type="submit" class="btn btn-danger" id="login">Submit</button>
            </div>
          </div>
        </form>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="register">
          <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" id="form-daftar">
          <div class="form-group">
            <label for="inputName" class="col-sm-3 control-label">Nama Anda</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="nama" name="nama"  autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail" class="col-sm-3 control-label">Nama Komunitas</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="nama_komunitas" name="nama_komunitas" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
              <label for="inputEmail" class="col-sm-3 control-label">Tgl Berdiri Komunitas</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="tgl_berdiri_komunitas" name="tgl_berdiri_komunitas" autocomplete="off">
              </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-3 control-label">Jumlah Anggota Komunitas</label>
                <div class="col-sm-3">
                  <input type="number" class="form-control" id="jumlah_anggota_komunitas" name="jumlah_anggota_komunitas" autocomplete="off" min="0">
                </div>
              </div>
              <div class="form-group">
                  <label for="inputEmail" class="col-sm-3 control-label">Nama Ketua Komunitas</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="ketua_komunitas" name="ketua_komunitas" autocomplete="off" min="0">
                  </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-3 control-label">Alamat Sekretariat Komunitas</label>
                    <div class="col-sm-6">
                      <textarea class="form-control" id="alamat_komunitas" name="alamat_komunitas"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="inputEmail" class="col-sm-3 control-label">No. Telp Komunitas</label>
                      <div class="col-sm-6">
                        <input type="text" class="form-control" id="tlp_komunitas" name="tlp_komunitas" autocomplete="off">
                      </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-6">
                          <input type="email" name="email_komunitas" class="form-control" id="email_komunitas"  autocomplete="off">
                        </div>
                      </div> 
                      <div class="form-group">
                          <label for="inputEmail" class="col-sm-3 control-label">Password</label>
                          <div class="col-sm-6">
                            <input type="password" name="password_komunitas" class="form-control" id="password_komunitas"  autocomplete="off">
                          </div>
                        </div>                    
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-5">
              <button type="button" class="btn btn-danger" id="daftar">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /.tab-content -->
  </div>
@endsection
@section('js-bottom')
<script>
$('#tgl_berdiri_komunitas').datepicker({
  format:"yyyy-mm-dd",
  autoclose: true
});


$("#daftar").click(function () {
var nama = $("#nama").val();
var nama_komunitas = $("#nama_komunitas").val();
var tgl_berdiri = $("#tgl_berdiri_komunitas").val();
var jumlah_anggota = $("#jumlah_anggota_komunitas").val();
var ketua_komunitas = $("#ketua_komunitas").val();
var alamat_komunitas = $("#alamat_komunitas").val();
var tlp_komunitas = $("#tlp_komunitas").val();
var email = $("#email_komunitas").val();
var password = $("#password_komunitas").val();


if( "" == nama){
  swal({
    type: 'error',
    title: 'Nama wajib diisi.',
    showConfirmButton: true
    });
    return false;
}
if( "" == nama_komunitas){
  swal({
    type: 'error',
    title: 'Nama Komunitas atau karangtaruna wajib diisi.',
    showConfirmButton: true
    });
    return false;
}
if( "" == tgl_berdiri){
  swal({
    type: 'error',
    title: 'Tanggal Berdiri Komunitas wajib diisi.',
    showConfirmButton: true
    });
    return false;
}
if( "" == jumlah_anggota){
  swal({
    type: 'error',
    title: 'Jumlah anggota komunitas wajib diisi.',
    showConfirmButton: true
    });
    return false;
}
if( "" == ketua_komunitas){
  swal({
    type: 'error',
    title: 'Nama ketua komunitas wajib diisi.',
    showConfirmButton: true
    });
    return false;
}
if( "" == alamat_komunitas){
  swal({
    type: 'error',
    title: 'Alamat sekretariat komunitas wajib diisi.',
    showConfirmButton: true
    });
    return false;
}
if( "" == tlp_komunitas){
  swal({
    type: 'error',
    title: 'Nomor telp komunitas wajib diisi.',
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
    url: "<?php echo base_url();?>komunitas/cek_email",
    data: new FormData($("#form-daftar")[0]),
    dataType:'json',
    async:false,
    type:'post',
    processData: false,
    contentType: false,
    success:function(response){
        console.log(response);
        if(response != null){
          swal({
              type: 'error',
              title: "Email sudah terdaftar. Gunakan Email lain !",
              showConfirmButton: true
            })
        }else{
          $.ajax({
                    url: "<?php echo base_url();?>komunitas/store",
                    data: new FormData($("#form-daftar")[0]),
                    dataType:'json',
                    async:false,
                    type:'post',
                    processData: false,
                    contentType: false,
                    success:function(response){
                        console.log(response);
                        swal({
                          type: 'success',
                          title: "Selamat !! Komunitas anda berhasil di registrasi.",
                          showConfirmButton: true
                        })
                         disable_all();                  
                    },
                    error: function(data){
                        swal({
                            type: 'error',
                            title: 'Ops! Saat ini tidak bisa melakukan registrasi.',
                            showConfirmButton: true
                            })
                    }
                });
        }

    },
    error: function(data){
      console.log(data);
        swal({
            type: 'error',
            title: 'Ops! Saat ini tidak bisa melakukan registrasi.',
            showConfirmButton: true
            })
      }
    });
});


function disable_all(){
    $('#nama').attr("disabled",true);   
    $('#nama_komunitas').attr("disabled",true);   
    $('#tgl_berdiri_komunitas').attr("disabled",true);   
    $('#jumlah_anggota_komunitas').attr("disabled",true);   
    $('#ketua_komunitas').attr("disabled",true);   
    $('#alamat_komunitas').attr("disabled",true);   
    $('#tlp_komunitas').attr("disabled",true);   
    $('#email_komunitas').attr("disabled",true);   
    $('#password_komunitas').attr("disabled",true); 
    $("#daftar").hide();           
}
</script>
@endsection