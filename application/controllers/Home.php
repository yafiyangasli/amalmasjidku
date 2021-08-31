<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent ::__construct();
		$this->load->model('Model');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Jakarta');
		require APPPATH.'libraries/phpmailer/src/Exception.php';
        require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH.'libraries/phpmailer/src/SMTP.php';
        $waktuNow = date('Y-m-d');
        $donatur = $this->db->get_where('campaign',['deadline' => $waktuNow])->result_array();

        foreach ($donatur as $dt) {
        	$this->db->set('status', 'Selesai');
        	$this->db->where('id_campaign', $dt['id_campaign']);
        	$this->db->update('campaign');
        }
	}

	public function index(){
		$this->db->order_by('id_campaign','DESC');
		$data['campaign']=$this->db->get_where('campaign',['status'=>'Dilaksanakan'],5)->result_array();
		$data['pengajuan']=$this->db->get_where('pengajuan',['status'=> 'Dilaksanakan'])->result_array();
		$this->db->order_by('id_penyaluran','DESC');	
		$data['penyaluran']=$this->db->get('penyaluran',5)->result_array();

		$query1 = "SELECT * FROM donatur";
		$query2 = "SELECT * FROM campaign";
		$data['total'] =[
			'totaldonatur' => $this->db->query($query1)->num_rows(),
			'totalcampaign' => $this->db->query($query2)->num_rows()
		];

		$this->load->view('templates/header');
		$this->load->view('home/index',$data);
		$this->load->view('templates/footer');
	}

	public function inputNewsletter(){
		$newsletter=$this->input->post('newsletter');

		$data['newsletter']=$this->db->get_where('newsletter',['email'=>$newsletter])->row_array();

		$this->db->where('email',$newsletter);
		$this->db->delete('newsletter');

		$data=['email'=>$newsletter];

		$this->db->insert('newsletter',$data);
		$this->session->set_userdata('newsletter',$data);
		redirect('home');
	}
}
