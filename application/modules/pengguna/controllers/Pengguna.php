<?php 

class Pengguna extends CI_Controller {
  
  function __construct() {
    parent::__construct();
    
    $this->load->helper('url');
    $this->load->model('Pengguna_model');
    $this->load->model('jabatan/Jabatan_model');
    $this->load->library('session');
    if ( !$this->session->userdata('is_logged_in') && !$this->session->userdata('email'))
    { 
      return redirect(''.base_url().''); 
    }
  }
  
  public function show_pengguna(){
    $result= Pengguna_model::join('tbl_roles','tbl_roles.id','=','users.role_id')
                          ->select('users.*','tbl_roles.nama_role')
                          ->get();
    
    return view('pengguna.index',compact('result'));
  }


  public function create()
  {
      $jabatans = Jabatan_model::all();
      return view('pengguna.add',compact('jabatans'));
  }

    public function store()
    {
      $simpan = new Pengguna_Model();
      $simpan->nama = trim($this->input->post('nama'));
      $simpan->email = trim($this->input->post('email'));
      $simpan->role_id = $this->input->post('jabatan_id');
      $simpan->_komunitas = 0;
      $simpan->password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
      $simpan->save();
      if($simpan){
        echo json_encode($simpan);
      }else{
        echo json_encode('Gagal Menyimpan data');
      }
    }


    public function edit($id)
    {
      $pengguna = Pengguna_Model::where('id',$id)->first();
      $jabatans = Jabatan_model::all();
      return view('pengguna.edit',compact('pengguna','jabatans'));
    }


    public function update()
    {
      $simpan = Pengguna_Model::where('id',$this->input->post('id'))->first();
      // jika password dikosongi
      if(empty($this->input->post('password'))){
        $simpan->nama = trim($this->input->post('nama'));
        $simpan->email = trim($this->input->post('email'));
        $simpan->role_id = $this->input->post('jabatan_id');
        $simpan->_komunitas = 0;
        $simpan->update();
        if($simpan){
          echo json_encode($simpan);
        }else{
          echo json_encode('Gagal Menyimpan data');
        }
        // jika password diisi
      }else{
        $simpan->nama = trim($this->input->post('nama'));
        $simpan->email = trim($this->input->post('email'));
        $simpan->role_id = $this->input->post('jabatan_id');
        $simpan->_komunitas = 0;
        $simpan->password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $simpan->update();
        if($simpan){
          echo json_encode($simpan);
        }else{
          echo json_encode('Gagal Menyimpan data');
        }
      }

    }



    public function destroy($id)
    {
      $del = Pengguna_Model::where('id',$id)->delete();
      if($del){
        $this->session->set_flashdata('k','<div class="alert alert-success">Pengguna telah dihapus.</div>');
        return redirect(''.base_url().'pengguna/show_pengguna');
      }else{
        $this->session->set_flashdata('k','<div class="alert alert-danger">Pengguna gagal dihapus.</div>');
        return redirect(''.base_url().'pengguna/show_pengguna');
      }
    }
  
}
