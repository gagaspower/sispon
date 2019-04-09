<?php 

class Dashboard extends CI_Controller {
  
  function __construct() {
    parent::__construct();
    
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->model('permohonan/Permohonan_model');
    $this->load->model('komunitas/Komunitas_model');
    if ( !$this->session->userdata('is_logged_in') && !$this->session->userdata('email'))
    { 
      return redirect('/','refresh'); 
    }
  }
  
    public function index()
    {
      // hitung jumlah permohonan total
      $total_permohonan = Permohonan_model::count();
      // hitung permohonan di proses
      $proses_permohonan = Permohonan_model::where('status_pengajuan','02')->count();
      // hitung permohonan di reject atau tolak
      $reject_permohonan = Permohonan_model::where('status_pengajuan','04')->count();
      // hitung permohonan di setujui
      $approve_permohonan = Permohonan_model::where('status_pengajuan','03')->count();
      return view('dashboard.index',compact('total_permohonan','proses_permohonan','reject_permohonan','approve_permohonan'));
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



    public function destroy($id)
    {

    }
  
}
