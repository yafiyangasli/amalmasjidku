<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct(){
		parent ::__construct();
		$this->load->library('form_validation');
	}

	public function index(){
		$this->form_validation->set_rules('email',' Email','required|trim',[
			'required' => 'Tolong masukkan email!'
		]);
		$this->form_validation->set_rules('password','Password','required|trim',[
			'required' => 'Tolong masukkan password!'
		]);

		if($this->form_validation->run()==false){
		$this->load->view('templates/header');
		$this->load->view('auth/index');
		$this->load->view('templates/footer');
		}else{
			
			$this->login();
		}
	}

	public function login(){
		$id=$this->input->post('email');
		$password=$this->input->post('password');

		$email=$this->db->get_where('user',['email'=>$id])->row_array();
		if($email){
			if(password_verify($password, $email['password'])){
				$data=[
					'email'=>$email['email'],
					'nama'=>$email['nama'],
					'role_id'=>$email['role_id']
				];
				$this->session->set_userdata($data);
				redirect('home');
					// else{
					// 	redirect('admin');
					// }
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password salah!</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
			redirect('auth');
		}
	}

	public function register($user_id){
		if ($user_id == 1) {
			$data['user_id']="Donatur";
			$this->form_validation->set_rules('name', 'Nama', 'required|trim',[
				'required' => 'Tolong masukkan nama!']);
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
				'is_unique' => 'Email sudah terdaftar!',
				'required' => 'Tolong masukkan email!']
			);
			$this->form_validation->set_rules('telephone', 'Telepon', 'required|trim|numeric|min_length[6]',[
				'required' => 'Tolong masukkan nomor telepon!',
				'numeric' => 'Tolong masukkan nomor telepon dengan benar!',
				'min_length'=>'Tolong masukkan nomor telepon dengan benar!']);
			$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]',[
				'required' => 'Tolong masukkan password!',
				'min_length'=>'Password terlalu pendek!'
			]);

			$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]',[
				'required' => 'Tolong masukkan konfirmasi password!',
				'matches'=>'Password tidak sama!']);


			if($this->form_validation->run()==false){
			$this->load->view('templates/header');
			$this->load->view('auth/register', $data);
			$this->load->view('templates/footer');
			}else{
				$data=[
					'email'=>htmlspecialchars($this->input->post('email',true)),
					'nama'=>htmlspecialchars($this->input->post('name',true)),
					'password'=>password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
					'telephone'=>$this->input->post('telephone'),
					'alamat'=>"",
					'role_id'=>1
				];
				$this->db->insert('user',$data);
				$userdata=[
					'email'=>$data['email'],
					'nama'=>$data['nama'],
					'role_id'=>$data['role_id']
				];
				$this->session->set_userdata($userdata);
				redirect('home');
			}
		}else{
			$data['user_id']="Pembuat Campaign";
			$this->form_validation->set_rules('name', 'Nama Masjid', 'required|trim',[
				'required' => 'Tolong masukkan nama masjid!']);
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
				'is_unique' => 'Email sudah terdaftar!',
				'required' => 'Tolong masukkan email masjid!']
			);
			$this->form_validation->set_rules('telephone', 'Telepon', 'required|trim|numeric|min_length[6]',[
				'required' => 'Tolong masukkan nomor telepon!',
				'numeric' => 'Tolong masukkan nomor telepon dengan benar!',
				'min_length'=>'Tolong masukkan nomor telepon dengan benar!']);
			$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]',[
				'required' => 'Tolong masukkan password!',
				'min_length'=>'Password terlalu pendek!'
			]);
			$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]',[
				'required' => 'Tolong masukkan konfirmasi password!',
				'matches'=>'Password tidak sama!']);
			$this->form_validation->set_rules('address', 'Alamat', 'required|trim',[
				'required' => 'Tolong masukkan alamat masjid!']);

			if($this->form_validation->run()==false){
			$this->load->view('templates/header');
			$this->load->view('auth/register', $data);
			$this->load->view('templates/footer');
			}else{
				$data=[
					'email'=>htmlspecialchars($this->input->post('email',true)),
					'nama'=>htmlspecialchars($this->input->post('name',true)),
					'password'=>password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
					'telephone'=>$this->input->post('telephone'),
					'alamat'=>$this->input->post('address'),
					'role_id'=>2
				];
				$this->db->insert('user',$data);
				$userdata=[
					'email'=>$data['email'],
					'nama'=>$data['nama'],
					'role_id'=>$data['role_id']
				];
				$this->session->set_userdata($userdata);
				redirect('home');
			}
		}
	}

	public function logout(){
		$this->session->unset_userdata('email');

		redirect('home');
	}
}
