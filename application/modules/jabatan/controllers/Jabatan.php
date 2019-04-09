<?php 

class jabatan extends CI_Controller {
  
  function __construct() {
    parent::__construct();
    
    $this->load->helper('url');
    $this->load->model('Jabatan_model');
    $this->load->library('session');
    if ( !$this->session->userdata('is_logged_in') && !$this->session->userdata('email'))
    { 
      return redirect('/','refresh'); 
    }
  }
  
    public function show_jabatan()
    {
      $result = Jabatan_model::all();
      return view('jabatan.index',compact('result'));
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
