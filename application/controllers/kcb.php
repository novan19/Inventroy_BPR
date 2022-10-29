<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kcb extends CI_Controller {

	public function __construct() { 
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('download');
	$this->load->library('pagination');
	$this->load->helper('cookie');
	$this->load->model('kcb_model');
  }
	
	public function index()
	{
		$data['title'] = 'Kantor Cabang';
		$data['kcb'] = $this->kcb_model->data()->result();

		$this->load->view('templates/header', $data);
		$this->load->view('kcb/index');
		$this->load->view('templates/footer');
	}
 
	public function proses_tambah()
	{
		$id_kcb = 	$this->kcb_model->buat_kode();
		$kcb = $this->input->post('kcb');
		$notelp = 	$this->input->post('notelp');
		$contact = 	$this->input->post('contact');
		
		$data=array(
			'id_kcb'=> $id_kcb,
			'nama_kcb'=> $kcb,
			'notelp'=> $notelp,
			'contact'=> $contact
		);

		$this->kcb_model->tambah_data($data, 'kcb');
		$this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil ditambahkan!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
    	redirect('kcb');
	}

	public function proses_ubah()
	{
		$id_kcb = 	$this->input->post('id_kcb');
		$kcb = $this->input->post('kcb');
		$notelp = 	$this->input->post('notelp');
		$contact = 	$this->input->post('contact');
		
		$data=array(
			'nama_kcb'=> $kcb,
			'notelp'=> $notelp,
			'contact'=> $contact
		);

		$where = array(
			'id_kcb'=>$kode
		);

		$this->kcb_model->ubah_data($where, $data, 'kcb');
		$this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil diubah!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
    	redirect('kcb');
	}

	public function proses_hapus($id)
	{
		$where = array('id_kcb' => $id );
		$this->kcb_model->hapus_data($where, 'kcb');
		$this->session->set_flashdata('Pesan','
		<script>
		$(document).ready(function() {
			swal.fire({
				title: "Berhasil dihapus!",
				icon: "success",
				confirmButtonColor: "#4e73df",
			});
		});
		</script>
		');
		redirect('kcb');
	}

	public function getData()
	{
		$id = $this->input->post('id');
    	$where = array('id_kcb' => $id );
    	$data = $this->kcb_model->detail_data($where, 'kcb')->result();
    	echo json_encode($data);
	}

}
