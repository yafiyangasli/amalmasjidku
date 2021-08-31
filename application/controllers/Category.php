<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct(){
		parent ::__construct();
		$this->load->model('Model');
		$this->load->library('pagination');
		$this->load->library('form_validation');
	}

	public function index(){
		if ($this->session->userdata('search')==NULL) {
			$config['base_url']= 'http://localhost/fundrise/category/index';
			$config['total_rows']=$this->Model->hitungCampaign();
			$config['per_page']=9;

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
				$this->db->order_by('id_campaign','ASC');
				$data['tampilkan'] = 'Menampilkan hasil dari semua dengan urutan terlama';
				$this->session->unset_userdata('urutkan');
			}elseif ($this->session->userdata('urutkan') == 'terbaru'){
				$this->db->order_by('id_campaign','DESC');
				$data['tampilkan'] = 'Menampilkan hasil dari semua dengan urutan terbaru';
				$this->session->unset_userdata('urutkan');
			}else{
				$this->db->order_by('id_campaign','DESC');
				$data['tampilkan'] = 'Menampilkan hasil dari semua';
			}
			$data['campaign']=$this->db->get_where('campaign',['status'=>'Dilaksanakan'],$config['per_page'],$data['start'])->result_array();
			$data['pengajuan']=$this->db->get_where('pengajuan',['status'=> 'Dilaksanakan'])->result_array();

			$this->load->view('templates/header');
			$this->load->view('category/index',$data);
			$this->load->view('templates/footer');
		}else{
			$keyword = $this->session->userdata('search');
			$config['base_url']= 'http://localhost/fundrise/category/index';
			$config['total_rows']=$this->Model->hitungCampaignSearch($keyword);
			$config['per_page']=9;

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

			$data['pengajuan']=$this->db->get_where('pengajuan',['status'=> 'Dilaksanakan'])->result_array();
			$this->db->like('masjid',$this->session->userdata('search'));
			$data['campaign']=$this->db->get_where('campaign',['status'=>'Dilaksanakan'],$config['per_page'],$data['start'])->result_array();
			$data['tampilkan'] = 'Menampilkan hasil dari '. $this->session->userdata('search');
			$this->session->unset_userdata('search');

			$this->load->view('templates/header');
			$this->load->view('category/index',$data);
			$this->load->view('templates/footer');
		}
	}

	public function pembangunan(){
		$config['base_url']= 'http://localhost/fundrise/category/pembangunan';
		$config['total_rows']=$this->Model->hitungCampaignPembangunan();
		$config['per_page']=9;

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
			$this->db->order_by('id_campaign','ASC');
			$data['tampilkan'] = 'Menampilkan hasil dari kategori pembangunan dengan urutan terlama';
			$this->session->unset_userdata('urutkan');
		}elseif ($this->session->userdata('urutkan') == 'terbaru'){
			$this->db->order_by('id_campaign','DESC');
			$data['tampilkan'] = 'Menampilkan hasil dari kategori pembangunan dengan urutan terbaru';
			$this->session->unset_userdata('urutkan');
		}else{
			$this->db->order_by('id_campaign','DESC');
			$data['tampilkan'] = 'Menampilkan hasil dari kategori pembangunan';
		}
		$data['campaign']=$this->db->get_where('campaign',['status'=>'Dilaksanakan'],$config['per_page'],$data['start'])->result_array();
		$data['pengajuan']=$this->db->get_where('pengajuan',['status'=> 'Dilaksanakan','kategori'=>'pembangunan'])->result_array();

		$this->load->view('templates/header');
		$this->load->view('category/index',$data);
		$this->load->view('templates/footer');
	}

	public function renovasi(){
		$config['base_url']= 'http://localhost/fundrise/category/renovasi';
		$config['total_rows']=$this->Model->hitungCampaignRenovasi();
		$config['per_page']=9;

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
			$this->db->order_by('id_campaign','ASC');
			$data['tampilkan'] = 'Menampilkan hasil dari kategori renovasi dengan urutan terlama';
			$this->session->unset_userdata('urutkan');
		}elseif ($this->session->userdata('urutkan') == 'terbaru'){
			$this->db->order_by('id_campaign','DESC');
			$data['tampilkan'] = 'Menampilkan hasil dari kategori renovasi dengan urutan terbaru';
			$this->session->unset_userdata('urutkan');
		}else{
			$this->db->order_by('id_campaign','DESC');
			$data['tampilkan'] = 'Menampilkan hasil dari kategori renovasi';
		}
		$data['campaign']=$this->db->get_where('campaign',['status'=>'Dilaksanakan'],$config['per_page'],$data['start'])->result_array();
		$data['pengajuan']=$this->db->get_where('pengajuan',['status'=> 'Dilaksanakan','kategori'=>'renovasi'])->result_array();

		$this->load->view('templates/header');
		$this->load->view('category/index',$data);
		$this->load->view('templates/footer');
	}

	public function filter(){
		$kategori = $this->input->post('kategori');
		$urutkan = $this->input->post('urutkan');

		if($kategori == ""){
			$this->session->set_userdata('urutkan',$urutkan);
			redirect('category');
		}elseif ($kategori == 'pembangunan') {
			$this->session->set_userdata('urutkan',$urutkan);
			redirect('category/pembangunan');
		}elseif ($kategori == 'renovasi') {
			$this->session->set_userdata('urutkan',$urutkan);
			redirect('category/renovasi');
		}
	}

	public function search(){
		$search = $this->input->post('search');
		$this->session->set_userdata('search',$search);
		redirect('category');
	}
}
