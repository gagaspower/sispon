@extends('admin')
@section('content')
    <div class="box-header with-border">
        <h3 class="box-title"><i class="ion ion-clipboard"></i> Revisi Permohonan Sponsorship</h3>
    </div>
  @php
    $CI = &get_instance();
    echo $CI->session->flashdata("k");
  @endphp
  <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" id="form">
    <input type="hidden" name="id" value="{{$proposal['id']}}">
    <input type="hidden" name="komunitas" value="{{ $proposal['komunitas_id']}}">
    <div class="box box-success">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Nomor Permohonan</label>
                    <div class="col-sm-8">
                      <input type="text" name="kode_pengajuan" id="kode_pengajuan" class="form-control" value="{{ $proposal['kode_pengajuan']}}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">Judul Permohonan</label>
                    <div class="col-sm-8">
                      <input type="text" name="judul_pengajuan" id="judul_pengajuan" class="form-control" value="{{ $proposal['judul_pengajuan']}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="col-sm-2 control-label">File Proposal </label>
                    <div class="col-sm-6">
                        <input type="file" name="file_proposal" id="file_proposal">
                    </div>
                </div> 
              </div>
        </div>
      <div class="box-footer">
           <button type="button" class="btn btn-default" onclick="window.location.href='<?php echo base_url('permohonan/show_permohonan');?>'"><i class="fa fa-refresh"></i> Kembali</button>
        <button type="button" class="btn btn-info" id="simpan_permohonan"><i class="fa fa-rocket"></i> Kirim</button>
      </div>
    </div>
  </form> 
@endsection
@section('js-bottom')
<script>

            $("#simpan_permohonan").click(function () {
                var judul = $("#judul_pengajuan").val();
  
                if( "" == judul){
                  swal({
                    type: 'error',
                    title: 'Judul Permohonan wajib diisi.',
                    showConfirmButton: true
                    });
                    return false;
                }


                $.ajax({
                    url: "<?php echo base_url();?>permohonan/update",
                    data: new FormData($("#form")[0]),
                    dataType:'json',
                    async:false,
                    type:'post',
                    processData: false,
                    contentType: false,
                    success:function(response){
                        console.log(response);
                        swal({
                          type: 'success',
                          title: "Permohonan sponsorship berhasil diupdate.",
                          showConfirmButton: true
                        })
                         disable_all();                  
                    },
                    error: function(data){
                        swal({
                            type: 'error',
                            title: 'Permohonan sponsorship gagal diupdate.',
                            showConfirmButton: true
                            })
                    }
                });
            });


            function disable_all(){
                $('#judul_pengajuan').attr("disabled",true);            
            }
</script>
@endsection