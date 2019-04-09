<?php 

class Menu extends CI_Controller {
  
  function __construct() {
    parent::__construct();
    
    $this->load->helper('url');
    $this->load->model('Menu_model');
    $this->load->model('jabatan/Jabatan_model');
    $this->load->library('session');
    if ( !$this->session->userdata('is_logged_in') && !$this->session->userdata('email'))
    { 
      return redirect(''.base_url().''); 
    }
  }
  
  public function show_menu(){

      $this->db->select('tbl_menu.*,tbl_roles.nama_role');
      $this->db->from('tbl_menu');
      $this->db->join('tbl_roles','tbl_roles.id = tbl_menu.menu_role_id');
        $query = $this->db->get();
        $menus = $query->result_array();

    return view('menu.index',compact('menus'));
  }


  public function tambah_menu()
  {
      $parents = Menu_model::all();
      $roles = Jabatan_model::all();
      return view('menu.add',compact('parents','roles'));
  }

    public function store()
    {
      $simpan = new Menu_model();
      $simpan->nama_menu = trim($this->input->post('nama'));
      $simpan->link_menu = trim($this->input->post('link'));
      $simpan->icon_menu = trim($this->input->post('icon'));
      $simpan->parent_id = $this->input->post('parent');
      $simpan->menu_role_id = $this->input->post('role');
      $simpan->save();
      if($simpan){
        echo json_encode($simpan);
      }else{
        echo json_encode('Gagal Menyimpan data');
      }
    }


    public function edit($id)
    {
      $menu = Menu_model::where('id',$id)->first();
      $parents = Menu_model::all();
      $roles = Jabatan_model::all();
      return view('menu.edit',compact('menu','parents','roles'));
    }


    public function update()
    {
      $simpan = Menu_model::where('id',$this->input->post('id'))->first();
      $simpan->nama_menu = trim($this->input->post('nama'));
      $simpan->link_menu = trim($this->input->post('link'));
      $simpan->icon_menu = trim($this->input->post('icon'));
      $simpan->parent_id = $this->input->post('parent');
      $simpan->menu_role_id = $this->input->post('role');
      $simpan->update();
      if($simpan){
        echo json_encode($simpan);
      }else{
        echo json_encode('Gagal Menyimpan data');
      }

    }



    public function destroy($id)
    {
      $del = Menu_model::where('id',$id)->delete();
      if($del){
        $this->session->set_flashdata('k','<div class="alert alert-success">Menu telah dihapus.</div>');
        return redirect(''.base_url().'menu/show_menu');
      }else{
        $this->session->set_flashdata('k','<div class="alert alert-danger">Menu gagal dihapus.</div>');
        return redirect(''.base_url().'menu/show_menu');
      }
    }
  
}
