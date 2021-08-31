<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent ::__construct();
		$this->load->model('Model');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		date_default_timezone_set('Asia/Jakarta');
		require APPPATH.'libraries/phpmailer/src/Exception.php';
        require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH.'libraries/phpmailer/src/SMTP.php';
        if ($this->session->userdata('role_id')!=3) {
        	redirect('home');
        }

        $waktuNow = date('Y-m-d');
        $campaigndeadline = $this->db->get_where('campaign',['deadline' => $waktuNow])->result_array();

        foreach ($campaigndeadline as $cdt) {
        	$this->db->set('status', 'Selesai');
        	$this->db->where('id_campaign', $cdt['id_campaign']);
        	$this->db->update('campaign');
        }
        $campaigndonasi = $this->db->get('campaign')->result_array();

        foreach ($campaigndonasi as $cdo) {
        	if ($cdo['donasi_terkumpul'] >= $cdo['donasi_total']) {
	        	$this->db->set('status', 'Selesai');
	        	$this->db->where('id_campaign', $cdo['id_campaign']);
	        	$this->db->update('campaign');
        	}
        }
	}

	public function pengajuan(){
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['pengajuan']=$this->db->get_where('pengajuan',['status'=>'Menunggu Verifikasi'])->result_array();
		
		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/sidebaradmin',$data);
		$this->load->view('admin/pengajuan', $data);
		$this->load->view('templates/dashboardfoot');
		
	}

	public function pengajuanDiterima(){
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['pengajuan']=$this->db->get_where('pengajuan',['status'=>'Diterima'])->result_array();
		
		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/sidebaradmin',$data);
		$this->load->view('admin/pengajuanditerima', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function pengajuanDitolak(){
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['pengajuan']=$this->db->get_where('pengajuan',['status'=>'Ditolak'])->result_array();
		
		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/sidebaradmin',$data);
		$this->load->view('admin/pengajuanditolak', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function detailPengajuan($id){
		$data['pengajuan'] = $this->db->get_where('pengajuan',['id_pengajuan'=>$id])->row_array();

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/sidebaradmin',$data);
		$this->load->view('admin/detailpengajuan',$data);
		$this->load->view('templates/dashboardfoot');
	}

	public function verifikasiPengajuan($id){
		if ($this->input->post('diterima')==NULL) {
			$verif = $this->input->post('tidakditerima');
		}else{
			$verif = $this->input->post('diterima');
		}

		$data=[
			'status' => $verif,
			'pesan' => $this->input->post('pesan')
		];
		
		$this->db->where('id_pengajuan', $id);
		$this->db->update('pengajuan', $data);
		redirect('admin/pengajuan');
	}

	public function buatCampaign($id){
		$data['pengajuan'] = $this->db->get_where('pengajuan',['id_pengajuan'=>$id])->row_array();
		$data['user'] = $this->db->get_where('user',['id_user'=>$data['pengajuan']['id_user']])->row_array();
		$waktuNow = date('Y-m-d');

		$this->form_validation->set_rules('name', 'Nama', 'required|trim',[
			'required' => 'Tolong masukkan nama masjid!']);
		$this->form_validation->set_rules('target', 'target', 'required|trim|numeric',[
			'required' => 'Tolong masukkan target donasi!',
			'numeric' => 'Tolong masukkan target donasi dengan benar!'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/sidebaradmin',$data);
			$this->load->view('admin/buatcampaign',$data);
			$this->load->view('templates/dashboardfoot');
		}else{

			$nama_image0 = $_FILES['gambar0']['name'];
			$nama_image1 = $_FILES['gambar1']['name'];
			$nama_image2 = $_FILES['gambar2']['name'];
			$nama_image3 = $_FILES['gambar3']['name'];

			$upload_image0 = str_replace(" ", "_", $nama_image0);
			$upload_image1 = str_replace(" ", "_", $nama_image1);
			$upload_image2 = str_replace(" ", "_", $nama_image2);
			$upload_image3 = str_replace(" ", "_", $nama_image3);

			$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG|PDF|pdf';
			$config['max_size']		='20000000';
			$config['upload_path']	='./assets/image/deskripsicampaign/';

			$total = count($this->input->post('teks'));
			$teks = $this->input->post('teks');
			$paragraf ='';
			for ($i=0; $i < $total; $i++) {
				$paragraf .= "<p>".$teks[$i]."</p>";
			}

			$this->load->library('upload',$config);

			for ($i=0; $i < 4; $i++) { 
				if ($this->upload->do_upload('gambar'.$i)) {
	            $result = $this->upload->data();
	            echo "<pre>";
	            print_r($result);
	            echo "</pre>";
	        	}
			}

			$data=[
				'id_pengajuan' => $id,
				'id_user' => $data['user']['id_user'],
				'masjid' => $this->input->post('name'),
				'deadline' => date('Y-m-d', strtotime('+'.$this->input->post('durasi').'months') ),
				'donasi_total' => $this->input->post('target'),
				'tanggal' => $waktuNow,
				'deskripsi' => $paragraf,
				'status' => 'Dilaksanakan',
				'gambar1' => $upload_image0,
				'gambar2' => $upload_image1,
				'gambar3' => $upload_image2,
				'gambar4' => $upload_image3
			];

			$this->db->insert('campaign',$data);
			$this->db->where('id_pengajuan', $id);
			$this->db->set('status', 'Dilaksanakan');
			$this->db->update('pengajuan');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Campaign berhasil dibuat!</div>');
			redirect('admin/pengajuanDiterima');
		}
	}

	public function campaign($status){
		if ($status=="dilaksanakan") {
			$data['pengajuan']=$this->db->get_where('pengajuan',['status'=>'Dilaksanakan'])->result_array();
			$dilaksanakan = "SELECT * FROM campaign WHERE status = 'Dilaksanakan'";
			$data['status']=$status;

			$config['base_url']= 'http://localhost/fundrise/admin/campaign/dilaksanakan';
			$config['total_rows']=$this->db->query($dilaksanakan)->num_rows();
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


			$data['start']=$this->uri->segment(3);
			$this->db->order_by('id_campaign','DESC');
			$data['campaign']=$this->db->get_where('campaign',['status'=>'Dilaksanakan'],$config['per_page'],$data['start'])->result_array();

			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/sidebaradmin',$data);
			$this->load->view('admin/campaign', $data);
			$this->load->view('templates/dashboardfoot');
		}else{
			$data['pengajuan']=$this->db->get_where('pengajuan',['status'=>'Selesai'])->result_array();
			$dilaksanakan = "SELECT * FROM campaign WHERE status = 'Selesai'";
			$data['status']=$status;

			$config['base_url']= 'http://localhost/fundrise/admin/campaign/selesai';
			$config['total_rows']=$this->db->query($dilaksanakan)->num_rows();
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


			$data['start']=$this->uri->segment(4);
			$this->db->order_by('id_campaign','DESC');
			$data['campaign']=$this->db->get_where('campaign',['status'=>'Selesai'],$config['per_page'],$data['start'])->result_array();

			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/sidebaradmin',$data);
			$this->load->view('admin/campaign', $data);
			$this->load->view('templates/dashboardfoot');
		}
	}

	public function detailCampaign($id){
		$data['campaign'] = $this->db->get_where('campaign',['id_campaign'=>$id])->row_array();
		$data['pengajuan'] = $this->db->get_where('pengajuan',['id_pengajuan' => $data['campaign']['id_pengajuan']])->row_array();

		$query = "SELECT * FROM donatur WHERE id_campaign = $id AND status = 'Diterima'";

		$config['base_url']= 'http://localhost/fundrise/admin/detailCampaign/'.$id;
		$config['total_rows']=$this->db->query($query)->num_rows();
		$config['per_page']=10;

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


		$data['start']=$this->uri->segment(4);
		$this->db->order_by('id_donatur','ASC');
		$data['donatur']=$this->db->get_where('donatur',['status'=>'Diterima', 'id_campaign'=>$id],$config['per_page'],$data['start'])->result_array();

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/sidebaradmin',$data);
		$this->load->view('admin/detailcampaign',$data);
		$this->load->view('templates/dashboardfoot');
	}

	public function donatur(){
	
		$config['base_url']= 'http://localhost/fundrise/user/donation';
		$config['total_rows']=$this->Model->hitungDonatur();
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


		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id_donatur','DESC');
		$data['donatur']=$this->db->get_where('donatur',['status'=>'Menunggu Verifikasi Admin'],$config['per_page'],$data['start'])->result_array();

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/sidebaradmin');
		$this->load->view('admin/donatur', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function detailDonasi($id){
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['donatur']=$this->db->get_where('donatur',['id_donatur'=>$id])->row_array();
		$data['campaign']=$this->db->get_where('campaign',['id_campaign'=>$data['donatur']['id_campaign']])->row_array();
		$data['pengajuan']=$this->db->get_where('pengajuan',['id_pengajuan'=>$data['campaign']['id_pengajuan']])->row_array();

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/sidebaradmin',$data);
		$this->load->view('admin/detaildonasi',$data);
		$this->load->view('templates/dashboardfoot');
	}

	public function pdfConvert($id){
		$data['donatur']=$this->db->get_where('donatur',['id_donatur'=>$id])->row_array();
		$data['user']=$this->db->get_where('user',['id_user'=>$data['donatur']['id_user']])->row_array();
		$data['campaign'] = $this->db->get_where('campaign',['id_campaign'=>$data['donatur']['id_campaign']])->row_array();

		$this->load->library('pdf');
        
        // title dari pdf
        $this->data['title_pdf'] = 'Laporan Penjualan Toko Kita';
        $this->data['id'] = invoice_num($id,7,"F-");
        $this->data['tanggal'] = $data['donatur']['tanggal']; 
        $this->data['nama'] = $data['user']['nama'];
        $this->data['email'] = $data['user']['email'];
        $metode = explode(" ", $data['donatur']['pembayaran']);
        $this->data['metode'] = $metode[0]." ".$metode[1];
        $this->data['metodepembayaran'] = $data['donatur']['pembayaran'];
        $this->data['campaign'] = $data['campaign']['masjid'];
        $this->data['donasi'] = rupiah($data['donatur']['nominal']);
        // filename dari pdf ketika didownload
        
		$html = $this->load->view('admin/invoiceconvert',$this->data, true);	    
        
        // run dompdf
        $this->pdf->createPDF($html, 'Invoice Amal Masjidku', false);
    }

	public function verifikasiDonasi($id){
		if ($this->input->post('diterima')==NULL) {
			$verif = $this->input->post('tidakditerima');
		}else{
			$verif = $this->input->post('diterima');
		}

		$data=[
			'status' => $verif,
			'pesan' => $this->input->post('pesan')
		];
		
		$this->db->where('id_donatur', $id);
		$this->db->update('donatur', $data);
		$donatur = $this->db->get_where('donatur',['id_donatur'=>$id])->row_array();
		$id_donatur = $donatur['id_donatur'];
		$campaign = $this->db->get_where('campaign',['id_campaign'=>$donatur['id_campaign']])->row_array();
		$terkumpul = $campaign['donasi_terkumpul'];
		$nominal = $donatur['nominal'];
		$terkumpulAkhir = $terkumpul + $nominal;
		$totaldonasi = [
			'donasi_terkumpul' => $terkumpulAkhir
		];
		$this->db->where('id_campaign', $campaign['id_campaign']);
		$this->db->update('campaign', $totaldonasi);

		$user = $this->db->get_where('user',['id_user'=>$donatur['id_user']])->row_array();

		$response = false;
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        // SMTP configuration
        // SMTP configuration

        $mail->isSMTP(); 
        $mail->Host = "tls://smtp.gmail.com"; //sesuaikan sesuai nama domain hosting/server yang digunakan
        $mail->SMTPAuth = true;
        $mail->Username = 'amalmasjidku@gmail.com'; // user email
        $mail->Password = 'rahasia100'; // password email
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 587;

		$mail->From = "amalmasjidku@gmail.com"; //email pengirim
		$mail->FromName = "No-Reply Amal Masjidku"; //nama pengirim
		$mail->addAddress($user['email']);
		$mail->Subject = "Verifikasi Donasi";
		$mail->isHTML(true);
		$mailContent = 
		'<div style="border-radius: 5px; padding: 10px;">
		<h2>Donasimu diterima!</h2><div style="max-width: 90%; height: auto; margin-left: auto; margin-right: auto; margin-top: 5%; display: block; font-size: 12.5px;">Klik <a href='.base_url('user/pdfConvert/').$id_donatur.'>link ini</a> untuk mendownload invoice pembayaran donasi anda!</div></div>';
		$mail->Body = $mailContent;

		$mail->send();

		redirect('admin/donasiDiterima');
	}

	public function donasiDiterima(){
	
		$config['base_url']= 'http://localhost/fundrise/user/donation';
		$config['total_rows']=$this->Model->hitungDonaturDiterima();
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


		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id_donatur','DESC');
		$data['donatur']=$this->db->get_where('donatur',['status'=>'Diterima'],$config['per_page'],$data['start'])->result_array();

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/sidebaradmin');
		$this->load->view('admin/donasiditerima', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function donasiDitolak(){
	
		$config['base_url']= 'http://localhost/fundrise/admin/donasiDitolak';
		$config['total_rows']=$this->Model->hitungDonaturDitolak();
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


		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id_donatur','DESC');
		$data['donatur']=$this->db->get_where('donatur',['status'=>'Ditolak'],$config['per_page'],$data['start'])->result_array();

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/sidebaradmin');
		$this->load->view('admin/donasiditolak', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function hapusDonasi($id){
		$this->db->where('id_donatur',$id);
		$this->db->delete('donatur');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Donasi berhasil dihapus!</div>');
		redirect('admin/donasiDitolak');
	}

	public function penyaluran(){

		$config['base_url']= 'http://localhost/fundrise/admin/penyaluran';
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


		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id_penyaluran','DESC');
		$data['penyaluran']=$this->db->get('penyaluran',$config['per_page'],$data['start'])->result_array();

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/sidebaradmin');
		$this->load->view('admin/penyaluran', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function buatPenyaluran($id){

		$this->form_validation->set_rules('judul', 'Judul', 'required|trim',[
			'required' => 'Tolong masukkan judul!']);
		$this->form_validation->set_rules('teks[0]', 'Teks', 'required|trim',[
			'required' => 'Tolong masukkan teks paragraf!']);

		if($this->form_validation->run()==FALSE){
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/sidebaradmin');
			$this->load->view('admin/buatpenyaluran');
			$this->load->view('templates/dashboardfoot');
		}else{
			$total = count($this->input->post('teks'));
			$teks = $this->input->post('teks');
			$paragraf ='';
			for ($i=0; $i < $total; $i++) {
				$paragraf .= "<p>".$teks[$i]."</p>";
			}

			$nama_image1 = $_FILES['gambar']['name'];
			$upload_image1 = str_replace(" ", "_", $nama_image1);

			$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG|PDF|pdf';
			$config['max_size']		='20000000';
			$config['upload_path']	='./assets/image/penyaluran/';

			if($upload_image1==NULL){
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Tolong upload gambar!</div>');
				redirect('admin/buatPenyaluran/'.$id);
			}

			$this->load->library('upload',$config);

			if (!$this->upload->do_upload('gambar')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}

			$data=[
				'id_campaign' => $id,
				'gambar' => $upload_image1,
				'judul' => $this->input->post('judul'),
				'isi' => $paragraf,
				'waktu' => date('H:i:s d-m-Y')
			];
			$this->db->insert('penyaluran',$data);
			$this->db->set('implementasi',1);
			$this->db->where('id_campaign', $id);
			$this->db->update('campaign');
			$donatur = $this->db->get_where('donatur', ['id_campaign' => $id, 'status' => 'Diterima'])->result_array();
			$donaturtemp = '';
			$donaturtemp2 = '';
			$data['donatur'] = [];
			$i=0;

			foreach ($donatur as $dt) {
				$user=$this->db->get_where('user',['id_user'=>$dt['id_user']])->row_array();
				$donaturtemp = $user['email'];
				if ($donaturtemp!=$donaturtemp2) {
					$emaildonatur[$i] = [
						'email' => $donaturtemp
					];
					$i++;
				}
					$donaturtemp2 = $donaturtemp;
			}

			foreach ($emaildonatur as $ed) {
				$response = false;
		        $mail = new PHPMailer\PHPMailer\PHPMailer();
		        // SMTP configuration
		        // SMTP configuration

		        $mail->isSMTP(); 
		        $mail->Host = "tls://smtp.gmail.com"; //sesuaikan sesuai nama domain hosting/server yang digunakan
		        $mail->SMTPAuth = true;
		        $mail->Username = 'takiyagenji0721@gmail.com'; // user email
		        $mail->Password = 'genjic00l'; // password email
		        $mail->SMTPSecure = 'ssl';
		        $mail->Port = 587;

				$mail->From = "takiyagenji0721@gmail.com"; //email pengirim
				$mail->FromName = "Amal Masjidku"; //nama pengirim
				$mail->addAddress($ed['email']);
				$mail->Subject = 'Update penyaluran donasi anda';
				$mail->isHTML(true);
				$mailContent = 
				'<div style=" background-color: grey; border-radius: 5px; padding: 10px;">
				<h2>'.$subject.'</h2><img href="https://images.app.goo.gl/q2XFij85R965R6oq8" style="max-width: 90%; height: auto; border-radius: 5px; margin-left: auto; margin-right: auto; display: block;"><div style="max-width: 90%; height: auto; margin-left: auto; margin-right: auto; margin-top: 5%; display: block; font-size: 12.5px;">'.$paragraf.'</div></div>';
				$mail->Body = $mailContent;

				$mail->send();
			}

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Artikel penyaluran berhasil dibuat!</div>');
			redirect('admin/penyaluran');
		}
	}

	public function editPenyaluran($id){
		$data['penyaluran']=$this->db->get_where('penyaluran',['id_penyaluran'=>$id])->row_array();

		$this->form_validation->set_rules('judul', 'Judul', 'required|trim',[
			'required' => 'Tolong masukkan judul!']);
		$this->form_validation->set_rules('teks', 'Teks', 'required|trim',[
			'required' => 'Tolong masukkan teks paragraf!']);

		if($this->form_validation->run()==FALSE){
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/sidebaradmin');
			$this->load->view('admin/editpenyaluran',$data);
			$this->load->view('templates/dashboardfoot');
		}else{
			$teks = $this->input->post('teks');

			$nama_image1 = $_FILES['gambar']['name'];
			$upload_image1 = str_replace(" ", "_", $nama_image1);

			$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG|PDF|pdf';
			$config['max_size']		='20000000';
			$config['upload_path']	='./assets/image/penyaluran/';

			if($upload_image1==NULL){
				$data=[
					'judul' => $this->input->post('judul'),
					'isi' => $teks
				];
				$this->db->where('id_penyaluran', $id);
				$this->db->update('penyaluran',$data);
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Artikel penyaluran berhasil diubah!</div>');
				redirect('admin/penyaluran');
			}else{
				$this->load->library('upload',$config);

				if($this->upload->do_upload('gambar')){
					$old_image = $data['penyaluran']['gambar'];
					if($old_image != 'plain.png'){
					unlink(FCPATH . 'assets/image/penyaluran/'.$old_image);
				}
					$new_image = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'gambar' => $upload_image1,
					'judul' => $this->input->post('judul'),
					'isi' => $teks
				];
				$this->db->where('id_penyaluran', $id);
				$this->db->update('penyaluran',$data);
				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Artikel penyaluran berhasil diubah!</div>');
				redirect('admin/penyaluran');

			}
		}
	}

	public function newsletter(){

		$config['base_url']= 'http://localhost/fundrise/admin/donasiDitolak';
		$config['total_rows']=$this->Model->hitungNewsletter();
		$config['per_page']=10;

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


		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id_newsletter','DESC');
		$data['newsletter']=$this->db->get('newsletter',$config['per_page'],$data['start'])->result_array();

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/sidebaradmin');
		$this->load->view('admin/newsletter', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function buatNewsletter(){
		$data['newsletter']=$this->db->get('newsletter')->result_array();

		$this->form_validation->set_rules('subjek','Subjek','trim|required',[
			'required' => 'Tolong inputkan subject!'
		]);
		$this->form_validation->set_rules('teks[0]','Teks','trim|required',[
			'required' => 'Tolong inputkan teks!'
		]);

		if($this->form_validation->run()==false){
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/sidebaradmin');
			$this->load->view('admin/buatnewsletter', $data);
			$this->load->view('templates/dashboardfoot');
		}else{
			foreach ($data['newsletter'] as $nl) {
				$email = $nl['email'];
				$this->sendNewsletter($email);
			}

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Berhasil mengirimkan newsletter!</div>');
		redirect('admin/newsletter');
		}
	}

	private function sendNewsletter($email){
		$subject=$this->input->post('subjek');
		$nama_image = $_FILES['gambar']['name'];
		$upload_image = str_replace(" ", "_", $nama_image);
		$total = count($this->input->post('teks'));
		$teks = $this->input->post('teks');
		$paragraf ='';
		for ($i=0; $i < $total; $i++) {
			$paragraf .= "<p>".$teks[$i]."</p>";
		}

		$response = false;
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        // SMTP configuration
        // SMTP configuration

        $mail->isSMTP(); 
        $mail->Host = "tls://smtp.gmail.com"; //sesuaikan sesuai nama domain hosting/server yang digunakan
        $mail->SMTPAuth = true;
        $mail->Username = 'amalmasjidku@gmail.com'; // user email
        $mail->Password = 'rahasia100'; // password email
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 587;

		$mail->From = "amalmasjidku@gmail.com"; //email pengirim
		$mail->FromName = "MABAAR"; //nama pengirim
		$mail->addAddress($email);
		$mail->Subject = $subject;
		$mail->isHTML(true);
		$mailContent = 
		'<div style=" background-color: grey; border-radius: 5px; padding: 10px;">
		<h2>'.$subject.'</h2><img href="https://amalmasjidku.site/assets/image/newsletter/1110485.jpg" style="max-width: 90%; height: auto; border-radius: 5px; margin-left: auto; margin-right: auto; display: block;"/><div style="max-width: 90%; height: auto; margin-left: auto; margin-right: auto; margin-top: 5%; display: block; font-size: 12.5px;">'.$paragraf.'</div></div>';
		$mail->Body = $mailContent;

		$mail->send();
	}

	public function tentang(){
		$data['tentang'] = $this->db->get_where('tentang',['id_tentang'=>1])->row_array();

		$this->form_validation->set_rules('teks[0]', 'Teks', 'required|trim',[
			'required' => 'Tolong masukkan teks!']);

		if($this->form_validation->run()==FALSE){
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/sidebaradmin');
			$this->load->view('admin/tentangkami',$data);
			$this->load->view('templates/dashboardfoot');
		}else{
			$total = count($this->input->post('teks'));
			$teks = $this->input->post('teks');
			$paragraf ='';
			for ($i=0; $i < $total; $i++) {
				$paragraf .= "<p>".$teks[$i]."</p>";
			}

			$nama_image1 = $_FILES['gambar']['name'];
			$upload_image1 = str_replace(" ", "_", $nama_image1);

			$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG|PDF|pdf';
			$config['max_size']		='20000000';
			$config['upload_path']	='./assets/image/tentang/';

			if($upload_image1==NULL){
				$data=[
					'teks' => $paragraf
				];
				$this->db->where('id_tentang', 1);
				$this->db->update('tentang',$data);
				redirect('tentang');
			}else{
				$this->load->library('upload',$config);

				if($this->upload->do_upload('gambar')){
					$old_image = $data['tentang']['gambar'];
					if($old_image != 'plain.png'){
					unlink(FCPATH . 'assets/image/tentang/'.$old_image);
				}
					$new_image = $this->upload->data('file_name');
				}else{
					echo $this->upload->display_errors();
				}

				$data=[
					'teks' => $paragraf,
					'gambar' => $upload_image1
				];
				$this->db->where('id_tentang', 1);
				$this->db->update('tentang',$data);
				redirect('tentang');

			}
		}
	}
}