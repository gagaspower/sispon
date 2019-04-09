<?php 

class Komunitas extends CI_Controller {
  
  function __construct() {
    parent::__construct();
    
    $this->load->helper('url');
    $this->load->model('Komunitas_model');
    $this->load->model('pengguna/Pengguna_model');
    $this->load->library('session');
  }
  
    public function index()
    {
      return view('komunitas.index');
    }


    public function create()
    {

    }

    public function store()
    {
        $simpan = new Komunitas_model();
        $simpan->nama_komunitas         = trim($this->input->post('nama_komunitas'));
        $simpan->tgl_berdiri_komunitas  = $this->input->post('tgl_berdiri_komunitas');
        $simpan->jumlah_anggota_komunitas = $this->input->post('jumlah_anggota_komunitas');
        $simpan->ketua_komunitas        = trim($this->input->post('ketua_komunitas'));
        $simpan->alamat_komunitas       = trim($this->input->post('alamat_komunitas'));
        $simpan->email_komunitas        = trim($this->input->post('email_komunitas'));
        $simpan->tlp_komunitas          = trim($this->input->post('tlp_komunitas'));
        $simpan->save();
        if($simpan){
          $simpan_user = new Pengguna_model();
          $simpan_user->role_id = 2;
          $simpan_user->_komunitas = $simpan->id;
          $simpan_user->nama       = trim($this->input->post('nama'));
          $simpan_user->email      = trim($this->input->post('email_komunitas'));
          $simpan_user->password   = password_hash($this->input->post('password_komunitas'), PASSWORD_BCRYPT);
          $simpan_user->save();
          echo json_encode(['Message'=>'Komunitas baru telah terdaftar']);
        }else{
          echo json_encode(['Message'=>'Komunitas baru gaga didaftarkan']);
        }
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


    public function cek_email()
    {
      $cek = Pengguna_model::where('email',$this->input->post('email_komunitas'))->first();
      echo json_encode($cek);
    }

    
    public function login()
    {
      $username = $this->input->post('email');
      $password = $this->input->post('password');
      
      
        $sql2 = $this->db->select("*")
                        ->from("users")
                        ->where("email", $username)
                        ->get();
      
      
      
             foreach($sql2->result() as $user_level){
      
                 $user_id = $user_level->id;
                 $nama = $user_level->nama;
                 $email = $user_level->email;
                 $role = $user_level->role_id;
                 $komunitas_id = $user_level->_komunitas;
                 $user_password_db = $user_level->password;
      
             }
      
             $data = array(
      
                 'user_id'      => $user_id,
                 'email'        => $email,
                 'nama'         => $nama,
                 'password'     => $user_password_db,
                 'role'         => $role,
                 'komunitas_id' => $komunitas_id,
                 'is_logged_in' => 1
      
             );
             $this->session->set_userdata($data);
             if(password_verify($password,$user_password_db)){
                 redirect('dashboard');
      
             }else{
              $this->session->set_flashdata('k','<div class="alert alert-danger text-center"><b>Email atau password tidak cocok.</b></div>');
              return redirect('/','refresh');
             }
    }

    public function logout()
    {
      $this->session->unset_userdata('user_id');
      $this->session->unset_userdata('email');
      $this->session->unset_userdata('is_logged_in');
      $this->session->unset_userdata('nama');
      $this->session->unset_userdata('role');
      $this->session->unset_userdata('komunitas_id');
      $this->session->sess_destroy();
      redirect('/','refresh');  // <!-- note that
    }
  
}
