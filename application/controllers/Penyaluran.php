<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyaluran extends CI_Controller {
	public function __construct(){
		parent ::__construct();
		$this->load->model('Model');
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index(){
			$config['base_url']= 'http://localhost/fundrise/penyaluran/index';
			$config['total_rows']=$this->Model->hitungPenyaluran();
			$config['per_page']=5;

			$config['full_tag_open']='<nav aria-label="Page navigation example"> <ul class="pagination  justify-content-center">';
			$config['full_tag_close']='</ul></nav>';

			$config['first_link']='First';
			$config['first_tag_open']='<li class="page-item">';
			$config['first_tag_close']='</li>';

			$config['last_link']='Last';
			$config['last_tag_open']='<li class="page-item">';
			$config['last_tag_close']='</li>';

			$config['next_link']='&raquo';
			$config['next_tag_open']='<li class="page-item">';
			$config['next_tag_close']='</li>';

			$config['prev_link']='&laquo';
			$config['prev_tag_open']='<li class="page-item">';
			$config['prev_tag_close']='</li>';

			$config['cur_tag_open']='<li class="page-item active"><a class="page-link text-dark bg-secondary" href="#" style="border-color : #9F9F9F;">';
			$config['cur_tag_close']='</a></li>';

			$config['num_tag_open']='<li class="page-item">';
			$config['num_tag_close']='</li>';

			$config['attributes']=array('class'=>'page-link text-secondary');

			$this->pagination->initialize($config);


			$data['start']=$this->uri->segment(2);
			if ($this->session->userdata('urutkan') == 'terlama') {
				$this->db->order_by('id_penyaluran','ASC');
				$data['tampilkan'] = 'Menampilkan hasil dari semua dengan urutan terlama';
				$this->session->unset_userdata('urutkan');
			}elseif ($this->session->userdata('urutkan') == 'terbaru'){
				$this->db->order_by('id_penyaluran','DESC');
				$data['tampilkan'] = 'Menampilkan hasil dari semua dengan urutan terbaru';
				$this->session->unset_userdata('urutkan');
			}else{
				$this->db->order_by('id_penyaluran','DESC');
				$data['tampilkan'] = 'Menampilkan hasil dari semua';
			}
			$data['penyaluran']=$this->db->get('penyaluran',$config['per_page'],$data['start'])->result_array();

		$this->load->view('templates/header');
		$this->load->view('penyaluran/index',$data);
		$this->load->view('templates/footer');
	}

	public function detail($id){
		$data['campaign']=$this->db->get_where('campaign', ['status'=> 'Dilaksanakan'],3)->result_array();
		$data['penyaluran']=$this->db->get_where('penyaluran',['id_penyaluran'=>$id])->row_array();
		$this->db->order_by('id_penyaluran', 'DESC');
		$data['samping']=$this->db->get('penyaluran',3)->result_array();

		$data['campaign2'] = $this->db->get_where('campaign',['id_campaign'=>$data['penyaluran']['id_campaign']])->row_array();
		$data['pengajuan'] = $this->db->get_where('pengajuan',['id_pengajuan' => $data['campaign2']['id_pengajuan']])->row_array();
		$data['donatur']=$this->db->get_where('donatur',['status'=>'Diterima', 'id_campaign'=>$id])->result_array();

		$this->load->view('templates/header');
		$this->load->view('penyaluran/detail',$data);
		$this->load->view('templates/footer');
	}

	public function filter(){
		$urutkan = $this->input->post('urutkan');
		$this->session->set_userdata('urutkan',$urutkan);
		redirect('penyaluran');
	}
}
