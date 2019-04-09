@extends('admin')
@section('content')
<div class="box-header with-border">
        <h3 class="box-title"><i class="ion ion-clipboard"></i> Edit Menu</h3>
    </div>
  <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal" id="form">
  <input type="hidden" name="id" id="id_menu" value="{{ $menu['id']}}">
    <div class="box box-success">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="nama" class="col-sm-2 control-label">Nama Menu</label>
                      <div class="col-sm-4">
                        <input type="text" name="nama_menu" class="form-control" id="nama_menu" autocomplete="off" value="{{$menu['nama_menu']}}">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="nama" class="col-sm-2 control-label">Link Menu</label>
                      <div class="col-sm-4">
                        <input type="text" name="link_menu" class="form-control" id="link_menu" autocomplete="off" value="{{$menu['link_menu']}}">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="nama" class="col-sm-2 control-label">Icon Menu</label>
                      <div class="col-sm-4">
                        <input type="text" name="icon_menu" class="form-control" id="icon_menu" autocomplete="off" value="{{$menu['icon_menu']}}">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="nama" class="col-sm-2 control-label">Parent Menu</label>
                      <div class="col-sm-4">
                       <select name="parent_id" id="parent_id" class="form-control select2">
                            <option value="0">--pilih--</option>
                            @foreach($parents as $row)
                              <option value="{{$row['id']}}" <?php if($row['id'] == $menu['parent_id']) echo "selected"; ?> >{{$row['nama_menu']}}</option>
                            @endforeach
                       </select>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="nama" class="col-sm-2 control-label">Role Menu</label>
                      <div class="col-sm-4">
                       <select name="menu_role_id" id="menu_role_id" class="form-control select2">
                          <option value="0">--pilih--</option>
                            @foreach($roles as $r)
                              <option value="{{$r['id']}}" <?php if($r['id'] == $menu['menu_role_id']) echo "selected"; ?> >{{$r['nama_role']}}</option>
                            @endforeach
                       </select>
                      </div>
                  </div>
                </div>
  
        </div>
      <div class="box-footer">
           <button type="button" class="btn btn-default" onclick="window.location.href='<?php echo base_url('menu/show_menu');?>'"><i class="fa fa-refresh"></i> Kembali</button>
        <button type="button" class="btn btn-info" id="simpan_menu"><i class="fa fa-save"></i> Simpan</button>
      </div>
    </div>
  </form> 
@endsection
@section('js-bottom')
<script>
            $("#simpan_menu").click(function () {
                var id = $("#id_menu").val();
                var nama = $("#nama_menu").val();
                var link = $('#link_menu').val();
                var parent = $("#parent_id").val();
                var role = $("#menu_role_id").val();
                var icon = $("#icon_menu").val();

                if( "" == nama){
                  swal({
                    type: 'error',
                    title: 'Nama menu wajib diisi.',
                    showConfirmButton: true
                    });
                    return false;
                }

              if( "" == role){
                    swal({
                      type: 'error',
                      title: 'Role menu wajib diisi.',
                      showConfirmButton: true
                        });
                        return false;
                }
                $.ajax({
                    url:'<?php echo base_url();?>menu/update',
                    data: {
                        id : id,
                        nama : nama,
                        link : link,
                        icon : icon,
                        parent : parent,
                        role : role
                      },
                    dataType:'json',
                    type:'post',
                      success: function(data){
                      console.log(data);
                      swal({
                        type: 'success',
                        title: 'Menu telah disimpan.',
                        showConfirmButton: true
                        });
                        disable_all();
                   },
                    error: function(data){
                      console.log(data)
                      swal({
                        type: 'error',
                        title: 'Menu gagal disimpan.',
                        showConfirmButton: true
                        });
                    }
                });
            });


            function disable_all(){
              $('#nama_menu').attr("disabled",true);
                $('#link_menu').attr("disabled",true);
                $('#menu_role_id').select2("enable",false);
                $('#parent_id').select2("enable",false);
                $('#icon_menu').attr("disabled",true);           
            }
</script>
@endsection