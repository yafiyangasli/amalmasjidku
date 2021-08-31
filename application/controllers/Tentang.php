<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tentang extends CI_Controller {
	public function index(){
		$data['tentang'] = $this->db->get_where('tentang',['id_tentang'=>1])->row_array();

		$this->load->view('templates/header');
		$this->load->view('tentang/index',$data);
		$this->load->view('templates/footer');
	}

	public function syarat(){
		$this->load->view('templates/header');
		$this->load->view('tentang/syaratdanketentuan');
		$this->load->view('templates/footer');
	}
}
