<?php 

class Organisasi extends CI_Controller {
  
  function __construct() {
    parent::__construct();
    
    $this->load->helper('url');
    $this->load->model('komunitas/Komunitas_model');
    $this->load->model('permohonan/Permohonan_model');
    $this->load->library('session');
    if ( !$this->session->userdata('is_logged_in') && !$this->session->userdata('email'))
    { 
      return redirect(''.base_url().''); 
    }
  }
  
    public function show_organisasi(){
      $result = Komunitas_model::get();
      return view('organisasi.index',compact('result'));
    }


    public function create()
    {

    }

    public function store()
    {

    }


    public function edit($id)
    {

    }


    public function update()
    {


    }



    public function delete($id)
    {
      $del = Komunitas_model::where('id',$id)->delete();
      if($del){
        $hapus_file_permohonan = Permohonan_model::where('komunitas_id',$id)->get();
        foreach($hapus_file_permohonan as $proposal){
          @unlink('./dokumen/proposal/'.$proposal->file_proposal);
        }
        Permohonan_model::where('komunitas_id',$id)->delete();
        $this->session->set_flashdata('k','<div class="alert alert-success">Komunitas telah dihapus.</div>');
        return redirect(''.base_url().'organisasi/show_organisasi');
      }else{
        $this->session->set_flashdata('k','<div class="alert alert-danger">Komunitas gagal dihapus.</div>');
        return redirect(''.base_url().'organisasi/show_organisasi');
      }
    }
  
}
