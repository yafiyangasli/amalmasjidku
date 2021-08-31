<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donation extends CI_Controller {
	public function __construct(){
		parent ::__construct();
		$this->load->model('Model');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function detail($id){
		$data['campaign'] = $this->db->get_where('campaign',['id_campaign'=>$id])->row_array();
		$id_pengajuan = $data['campaign']['id_pengajuan'];
		$data['pengajuan']=$this->db->get_where('pengajuan',['id_pengajuan'=> $id_pengajuan])->row_array();
		$data['donatur']=$this->db->get_where('donatur',['id_campaign'=>$id],5)->result_array();

		$this->load->view('templates/header');
		$this->load->view('donation/index',$data);
		$this->load->view('templates/footer');
	}

	public function payment($id){
		if ($this->session->userdata('email')==NULL) {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Login terlebih dahulu!</div>');
			redirect('auth');
		}elseif($this->session->userdata('role_id')==2){
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Silahkan buat akun donatur!</div>');
			redirect('donation/detail/'.$id);
		}
		$data['user'] = $this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['campaign'] = $this->db->get_where('campaign',['id_campaign'=>$id])->row_array();
		$id_pengajuan = $data['campaign']['id_pengajuan'];
		$id_campaign = $data['campaign']['id_campaign'];
		$data['pengajuan']=$this->db->get_where('pengajuan',['id_pengajuan'=> $id_pengajuan])->row_array();
		$data['donatur']=$this->Model->totalDonatur($id);

		$this->form_validation->set_rules('donasi', 'Donasi', 'required|trim|numeric',[
			'required' => 'Tolong masukkan jumlah donasi anda!',
			'numeric' => 'Tolong masukkan jumlah donasi dengan benar!'
		]);
		$this->form_validation->set_rules('telephone', 'Telepon', 'required|trim|numeric',[
			'required' => 'Tolong masukkan nomor telepon anda!',
			'numeric' => 'Tolong masukkan nomor telepon dengan benar!'
		]);
		$this->form_validation->set_rules('pembayaran', 'Pembayaran', 'required',[
			'required' => 'Tolong masukkan metode pembayaran!'
		]);

		if ($this->form_validation->run()==FALSE) {
	 		$this->load->view('templates/header');
			$this->load->view('donation/payment',$data);
			$this->load->view('templates/footer');
		}else{
			if ($this->input->post('nama') == NULL || $this->input->post('nama') == "") {
				$nama = 'Anonim';
			}else{
				$nama = $this->input->post('nama');
			}
			$data=[
				'id_user' => $data['user']['id_user'],
				'id_campaign' => $id_campaign,
				'nama' => $nama,
				'nominal' => $this->input->post('donasi'),
				'telepon' => $this->input->post('telephone'),
				'pesan' => $this->input->post('pesan'),
				'pembayaran' => $this->input->post('pembayaran'),
				'status' => "Menunggu Verifikasi Admin",
				'tanggal' => date('Y-m-d')
			];
			$this->db->insert('donatur', $data);
			$data['user'] = $this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
			$id_user = $data['user']['id_user'];
			$query="SELECT * FROM donatur WHERE id_user = $id_user ORDER BY id_donatur DESC";
			$user=$this->db->query($query)->row_array();
			$id_donasi = $user['id_donatur'];
			redirect('user/detailDonasi/'.$id_donasi);
		}
	}
}
