<?php 

class Permohonan extends CI_Controller {
  
  function __construct() {
    parent::__construct();
    
    $this->load->helper('url');
    $this->load->model('permohonan/Permohonan_model');
    $this->load->model('komunitas/Komunitas_model');
    $this->load->model('pengguna/Pengguna_model');
    $this->load->library('session');
    $this->load->library('upload');
    if ( !$this->session->userdata('is_logged_in') && !$this->session->userdata('email'))
    { 
      return redirect('/','refresh'); 
    }
  }
  
    public function show_permohonan()
    {
        if($this->session->userdata('komunitas_id') == 0 && $this->session->userdata('role') ==1 ){
          $result = Permohonan_model::all();
        }
        else{
          $result = Permohonan_model::where('komunitas_id',$this->session->userdata('komunitas_id'))->get();
        }
        return view('permohonan.index',compact('result'));
    }


    public function tambah_permohonan()
    {
              // membuat kode pelunasan unik
      $query = $this->db->query("SELECT MAX(id) as maxKode FROM tbl_permohonan");
      $data  = $query->result_array();
      $kodePermohonan = @$data['maxKode'];
      $noUrut = (int) substr($kodePermohonan, 3, 3);
      $noUrut++;
      $char = date('Y/m/d');
      $newID = 'SISP/PERMOHONAN/'.$char . '/'.sprintf("%03s", $noUrut);

      $komunitas = Pengguna_model::where('id',$this->session->userdata('user_id'))->first();

      return view('permohonan.add',compact('newID','komunitas'));
    }

    public function store()
    {
            $namafile = "file_".time(); //nama file beri nama langsung dan diikuti fungsi time
            $config['upload_path'] 		= './dokumen/proposal/'; //path folder
            $config['allowed_types'] 	= 'pdf'; //type yang dapat diakses bisa anda sesuaikan
            $config['max_size'] 		= '3072'; //maksimum besar file 3M
            $config['file_name'] 		= $namafile; //nama yang terupload nantinya
            $this->upload->initialize($config);
            if(!$this->upload->do_upload('file_proposal'))
            {
              $this->session->set_flashdata("k", "<div class='alert alert-danger'>File proposal harus PDF</div>");
              redirect(''.base_url().'permohonan/tambah_permohonan');
          }
          else{
              $simpan = new Permohonan_model();
              $simpan->kode_pengajuan = $this->input->post('kode_pengajuan');
              $simpan->tgl_pengajuan = date('Ymd');
              $simpan->judul_pengajuan = trim($this->input->post('judul_pengajuan'));
              $simpan->komunitas_id   = $this->input->post('komunitas');
              $simpan->file_proposal = $this->upload->data('file_name');
              $simpan->status_pengajuan = '01';
              $simpan->save();
              if($simpan){
                echo json_encode(['Message' => 'Permohonan berhasil dikirim','File Proposal'=>$simpan->file_proposal]);
              }else{
                echo json_encode(['Message'=>'Gagal mengirim permohonan']);
              }
          }
    }


    public function edit($id)
    {
        $proposal = Permohonan_model::where('id',$id)->first();
        return view('permohonan.edit',compact('proposal'));
    }


    public function update()
    {
      $namafile = "file_".time(); //nama file beri nama langsung dan diikuti fungsi time
      $config['upload_path'] 		= './dokumen/proposal/'; //path folder
      $config['allowed_types'] 	= 'pdf'; //type yang dapat diakses bisa anda sesuaikan
      $config['max_size'] 		= '3072'; //maksimum besar file 3M
      $config['file_name'] 		= $namafile; //nama yang terupload nantinya
      $this->upload->initialize($config);
      // jika ada gambar yang di upload
      if($_FILES['file_proposal']['name']) {
        if( $this->upload->do_upload('file_proposal')){

          // ambil gambar lama dan dihapus sebelum diganti
          $ambil = Permohonan_model::where('id',$this->input->post('id'))->first();
          @unlink('./dokumen/proposal/'.$ambil->file_proposal);

          // mulai simpan gambar baru
          $simpan = Permohonan_model::where('id',$this->input->post('id'))->first();
          $simpan->kode_pengajuan = $this->input->post('kode_pengajuan');
          $simpan->tgl_pengajuan = date('Ymd');
          $simpan->judul_pengajuan = trim($this->input->post('judul_pengajuan'));
          $simpan->komunitas_id   = $this->input->post('komunitas');
          $simpan->file_proposal = $this->upload->data('file_name');
          $simpan->status_pengajuan = '01';
          $simpan->update();
          if($simpan){
            echo json_encode(['Message' => 'Permohonan berhasil diupdate']);
          }else{
            echo json_encode(['Message'=>'Permohonan Gagal diupdate']);
          }
        }else{
          $this->session->set_flashdata("k", "<div class='alert alert-danger'>file proposal harus bentuk PDF</div>");
          redirect(''.base_url().'permohonan/edit/'.$this->input->post('id'));
        }
      }else{
        // jika tidak ada gambar yang diupload
        $simpan = Permohonan_model::where('id',$this->input->post('id'))->first();
        $simpan->kode_pengajuan = $this->input->post('kode_pengajuan');
        $simpan->tgl_pengajuan = date('Ymd');
        $simpan->judul_pengajuan = trim($this->input->post('judul_pengajuan'));
        $simpan->komunitas_id   = 1;
        $simpan->status_pengajuan = '01';
        $simpan->update();
        if($simpan){
          echo json_encode(['Message' => 'Permohonan berhasil diupdate']);
        }else{
          echo json_encode(['Message'=>'Permohonan Gagal diupdate']);
        }
      }
    }



    public function proses_permohonan($id)
    {
      $proses = Permohonan_model::where('id',$id)->update(['status_pengajuan' => '02']);
      if($proses){
        $this->session->set_flashdata("k", "<div class='alert alert-success'>Status permohonan telah diproses.</div>");
        redirect(''.base_url().'permohonan/show_permohonan');
      }else{
        $this->session->set_flashdata("k", "<div class='alert alert-danger'>Tidak bisa mengubah status permohonan.</div>");
        redirect(''.base_url().'permohonan/show_permohonan');       
      }
    }


    public function approve($id)
    {
      $proses = Permohonan_model::where('id',$id)->update(['status_pengajuan' => '03']);
      if($proses){
        $this->session->set_flashdata("k", "<div class='alert alert-success'>Status permohonan telah disetujui.</div>");
        redirect(''.base_url().'permohonan/show_permohonan');
      }else{
        $this->session->set_flashdata("k", "<div class='alert alert-danger'>Tidak bisa mengubah status permohonan.</div>");
        redirect(''.base_url().'permohonan/show_permohonan');       
      }
    }


    public function reject($id)
    {
      $proses = Permohonan_model::where('id',$id)->update(['status_pengajuan' => '04']);
      if($proses){
        $this->session->set_flashdata("k", "<div class='alert alert-success'>Status permohonan telah direject atau ditolak.</div>");
        redirect(''.base_url().'permohonan/show_permohonan');
      }else{
        $this->session->set_flashdata("k", "<div class='alert alert-danger'>Tidak bisa mengubah status permohonan.</div>");
        redirect(''.base_url().'permohonan/show_permohonan');       
      }
    }

    public function destroy($id)
    {

    }
  
}
