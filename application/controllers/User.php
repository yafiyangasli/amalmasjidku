<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent ::__construct();
		$this->load->model('Model');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Jakarta');
		if ($this->session->userdata('role_id')!=1 && $this->session->userdata('role_id')!=2) {
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

	public function index(){
		if ($this->session->userdata('role_id')==1) {
			$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
			$id_user = $data['user']['id_user'];
			$query1 = "SELECT * FROM donatur WHERE id_user = $id_user";
			$data['totaldonasi'] = $this->db->query($query1)->num_rows();

			$query2 = $this->db->query($query1)->result_array();

			$nominal = 0;
			foreach ($query2 as $q2) {
				$nominal = $q2['nominal'] + $nominal;
			}

			$data['nominaltotal'] = $nominal;
			$data['donasi'] = $this->db->query($query1)->result_array();
			$data['grafik']= [];
			$donasi = 0;
			for ($i=0; $i < 30 ; $i++) { 
				$tanggal = date('Y-m-d', strtotime('-'.$i.' day'));
				foreach ($query2 as $q2) {
					if ($q2['tanggal'] == $tanggal) {
						$donasi = 1 + $donasi;
					}
				}
				$data['grafik'][$i] =[
					'tanggal'=> $tanggal,
					'donasi'=>$donasi,
				];
				$donasi = 0;
			}

			$temp = 0;
			$temp3 = $data['grafik'];
			foreach ($temp3 as $df) {
				$temp2 = $df['donasi'];
				if ($temp2 > $temp) {
					$temp = $temp2;
				}
			}

			if ($temp == 0) {
				$temp = 1;
			}

			$data['terbesar'] = $temp;

			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('user/index',$data);
			$this->load->view('templates/dashboardfoot');
		}elseif ($this->session->userdata('role_id')==2) {
			$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
			$id_user = $data['user']['id_user'];
			$query1 = "SELECT * FROM campaign WHERE id_user = $id_user";
			$query3 = "SELECT * FROM campaign WHERE id_user = $id_user AND status = 'Dilaksanakan'";
			$data['totalcampaign'] = $this->db->query($query1)->num_rows();
			$data['berjalan'] = $this->db->query($query3)->num_rows();

			$query2 = $this->db->query($query1)->result_array();

			$nominal = 0;
			foreach ($query2 as $q2) {
				$nominal = $q2['donasi_terkumpul'] + $nominal;
			}

			$data['nominaltotal'] = $nominal;
			$data['campaign'] = $this->db->query($query3)->row_array();
			$donatur = $this->db->get_where('donatur',['id_campaign'=>$data['campaign']['id_campaign']])->result_array();

			$data['grafik']= [];
			$donasi = 0;
			for ($i=0; $i < 30 ; $i++) {
				$tanggal = date('Y-m-d', strtotime('-'.$i.' day'));
				foreach ($donatur as $dt) {
					if ($dt['tanggal'] == $tanggal) {
						$donasi = 1 + $donasi;
					}
				}
				$data['grafik'][$i] =[
					'tanggal'=> $tanggal,
					'donasi'=>$donasi,
				];
				$donasi = 0;
			}

			$temp = 0;
			$temp3 = $data['grafik'];
			foreach ($temp3 as $df) {
				$temp2 = $df['donasi'];
				if ($temp2 > $temp) {
					$temp = $temp2;
				}
			}

			if ($temp == 0) {
				$temp = 1;
			}

			$data['terbesar'] = $temp;

			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('user/index',$data);
			$this->load->view('templates/dashboardfoot');
		}
	}

	public function profile(){
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'Nama', 'required|trim',[
			'required' => 'Tolong masukkan nama!']);
		$this->form_validation->set_rules('telephone', 'Telepon', 'required|trim|numeric|min_length[6]',[
			'required' => 'Tolong masukkan nomor telepon!',
			'numeric' => 'Tolong masukkan nomor telepon dengan benar!',
			'min_length'=>'Tolong masukkan nomor telepon dengan benar!']);
		$this->form_validation->set_rules('address', 'Alamat', 'required|trim',[
			'required' => 'Tolong masukkan alamat masjid!']);

		if($this->form_validation->run()== FALSE){
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('user/profile',$data);
			$this->load->view('templates/dashboardfoot');
		}else{
			$data=[
				'nama'=>htmlspecialchars($this->input->post('name',true)),
				'telephone'=>$this->input->post('telephone'),
				'alamat'=>$this->input->post('address'),
			];
			$this->db->where('email',$this->session->userdata('email'));
			$this->db->update('user',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data akunmu telah diperbarui!</div>');
			$this->session->unset_userdata('nama');
			$this->session->set_userdata('nama',$this->input->post('name'));
			redirect('user/profile');
		}
	}

	public function donation(){
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$id_user=$data['user']['id_user'];
	
		$config['base_url']= 'http://localhost/fundrise/user/donation';
		$config['total_rows']=$this->Model->hitungDonaturUser($id_user);
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
		$data['donatur']=$this->db->get_where('donatur',['id_user'=>$id_user],$config['per_page'],$data['start'])->result_array();

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('user/donation', $data);
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
        
		$html = $this->load->view('user/invoiceconvert',$this->data, true);	    
        
        // run dompdf
        $this->pdf->createPDF($html, 'mypdf', false);
    }

	public function buatCampaign(){
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$id_user = $data['user']['id_user'];
		$query1="SELECT * FROM pengajuan WHERE id_user = $id_user";
		
		$this->form_validation->set_rules('name', 'Nama Penanggung Jawab','required|trim',[
			'required' => 'Tolong isi Nama Penanggung Jawab!'
		]);
		$this->form_validation->set_rules('nip', 'NIP Penanggung Jawab','required|trim',[
			'required' => 'Tolong isi NIP Penanggung Jawab!'
		]);
		$this->form_validation->set_rules('address', 'Alamat Penanggung Jawab','required|trim',[
			'required' => 'Tolong isi Alamat Penanggung Jawab!'
		]);
		$this->form_validation->set_rules('kategori', 'kategori','required|trim',[
			'required' => 'Tolong isi kategori!'
		]);
		$this->form_validation->set_rules('durasi', 'durasi','required|trim',[
			'required' => 'Tolong isi durasi!'
		]);
		
		$config['base_url']= 'http://localhost/fundr4ise/user/buatCampaign';
		$config['total_rows']=$this->Model->hitungBuatCampaign($id_user);
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
		$this->db->order_by('id_pengajuan','DESC');
		$data['pengajuan']=$this->db->get_where('pengajuan',['id_user'=>$id_user],$config['per_page'],$data['start'])->result_array();

		if($this->form_validation->run()==false){
		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside',$data);
		$this->load->view('user/buatcampaign', $data);
		$this->load->view('templates/dashboardfoot');
		}
		else{
			$query = "SELECT * FROM campaign WHERE id_user = $id_user AND status = 'Dilaksanakan'";
			$campaign = $this->db->query($query)->num_rows();
			if ($campaign > 0) {
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Anda memiliki campaign yang sedang dilaksanakan!</div>');
				redirect('user/buatCampaign');
			}
			$nama_image1 = $_FILES['image1']['name'];
			$nama_image2 = $_FILES['image2']['name'];
			$nama_image3 = $_FILES['image3']['name'];
			$nama_image4 = $_FILES['image4']['name'];
			$nama_image5 = $_FILES['image5']['name'];
			$upload_image1 = str_replace(" ", "_", $nama_image1);
			$upload_image2 = str_replace(" ", "_", $nama_image2);
			$upload_image3 = str_replace(" ", "_", $nama_image3);
			$upload_image4 = str_replace(" ", "_", $nama_image4);
			$upload_image5 = str_replace(" ", "_", $nama_image5);

			$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG|PDF|pdf';
			$config['max_size']		='20000000';
			$config['upload_path']	='./assets/image/pengajuan/';

			if($upload_image1==NULL || $upload_image2==NULL || $upload_image3==NULL || $upload_image4==NULL || $upload_image5==NULL){
				$this->session->set_flashdata('message','<div class="alert alert-warning" role="alert">Tolong upload semua berkas foto!</div>');
				redirect('user/buatCampaign');
			}


			$this->load->library('upload',$config);

			if (!$this->upload->do_upload('image1')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}

        	if (!$this->upload->do_upload('image2')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}

        	if (!$this->upload->do_upload('image3')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}

        	if (!$this->upload->do_upload('image4')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}

        	if (!$this->upload->do_upload('image5')) {
            $error = $this->upload->display_errors();
            // menampilkan pesan error
            print_r($error);
        	} else {
            $result = $this->upload->data();
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        	}

        	$data = [
				'id_user' => $id_user,
				'nama_pj' => $this->input->post('name'),
				'nip_pj' => $this->input->post('nip'),
				'foto_ktp' => $upload_image1,
				'foto_masjid1' => $upload_image2,
				'foto_masjid2' => $upload_image3,
				'foto_masjid3' => $upload_image4,
				'alamat_pj' => $this->input->post('address'),
				'kategori' => $this->input->post('kategori'),
				'durasi' => $this->input->post('durasi'),
				'proposal' => $upload_image5,
				'status' => "Menunggu Verifikasi"
			];

			$this->db->insert('pengajuan',$data);

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data pengajuan telah terkirim. Harap tunggu verifikasi dari admin!</div>');
			redirect('user/buatCampaign');
		}
	}

	public function editPengajuan($id){
		$data['pengajuan'] = $this->db->get_where('pengajuan',['id_pengajuan'=>$id])->row_array();

		$this->form_validation->set_rules('nama', 'Nama Penanggung Jawab','required|trim',[
			'required' => 'Tolong isi Nama Penanggung Jawab!'
		]);
		$this->form_validation->set_rules('nip', 'NIP Penanggung Jawab','required|trim',[
			'required' => 'Tolong isi NIP Penanggung Jawab!'
		]);
		$this->form_validation->set_rules('alamat', 'Alamat Penanggung Jawab','required|trim',[
			'required' => 'Tolong isi Alamat Penanggung Jawab!'
		]);
		$this->form_validation->set_rules('kategori', 'kategori','required|trim',[
			'required' => 'Tolong isi kategori!'
		]);
		$this->form_validation->set_rules('durasi', 'durasi','required|trim',[
			'required' => 'Tolong isi durasi!'
		]);

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside',$data);
			$this->load->view('user/editpengajuan', $data);
			$this->load->view('templates/dashboardfoot');
		}else{
			if ($_FILES['gambar0']['name']==NULL) {
				$_FILES['gambar0']['name']=$data['pengajuan']['foto_ktp'];
			}
			for ($i=1; $i < 4; $i++) {
				if ($_FILES['gambar'.$i]['name']==NULL) {
					$_FILES['gambar'.$i]['name']=$data['pengajuan']['foto_masjid'.$i];
				}
			}
			if ($_FILES['gambar4']['name']==NULL) {
				$_FILES['gambar4']['name']=$data['pengajuan']['proposal'];
			}

			$nama_image1 = $_FILES['gambar0']['name'];
			$nama_image2 = $_FILES['gambar1']['name'];
			$nama_image3 = $_FILES['gambar2']['name'];
			$nama_image4 = $_FILES['gambar3']['name'];
			$nama_image5 = $_FILES['gambar4']['name'];
			$upload_image1 = str_replace(" ", "_", $nama_image1);
			$upload_image2 = str_replace(" ", "_", $nama_image2);
			$upload_image3 = str_replace(" ", "_", $nama_image3);
			$upload_image4 = str_replace(" ", "_", $nama_image4);
			$upload_image5 = str_replace(" ", "_", $nama_image5);

			$config['allowed_types']='gif|jpg|png|jpeg|PNG|JPG|GIF|JPEG|PDF|pdf';
			$config['max_size']		='20000000';
			$config['upload_path']	='./assets/image/pengajuan/';

			$this->load->library('upload',$config);

			if($this->upload->do_upload('gambar0')){
				$old_image = $data['pengajuan']['foto_ktp'];
				if($old_image != 'plain.png'){
				unlink(FCPATH . 'assets/image/pengajuan/'.$old_image);
			}
				$new_image = $this->upload->data('file_name');
			}else{
				echo $this->upload->display_errors();
			}
			if($this->upload->do_upload('gambar1')){
				$old_image = $data['pengajuan']['foto_masjid1'];
				if($old_image != 'plain.png'){
				unlink(FCPATH . 'assets/image/pengajuan/'.$old_image);
			}
				$new_image = $this->upload->data('file_name');
			}else{
				echo $this->upload->display_errors();
			}
			if($this->upload->do_upload('gambar2')){
				$old_image = $data['pengajuan']['foto_masjid2'];
				if($old_image != 'plain.png'){
				unlink(FCPATH . 'assets/image/pengajuan/'.$old_image);
			}
				$new_image = $this->upload->data('file_name');
			}else{
				echo $this->upload->display_errors();
			}
			if($this->upload->do_upload('gambar3')){
				$old_image = $data['pengajuan']['foto_masjid3'];
				if($old_image != 'plain.png'){
				unlink(FCPATH . 'assets/image/pengajuan/'.$old_image);
			}
				$new_image = $this->upload->data('file_name');
			}else{
				echo $this->upload->display_errors();
			}
			if($this->upload->do_upload('gambar4')){
				$old_image = $data['pengajuan']['proposal'];
				if($old_image != 'plain.png'){
				unlink(FCPATH . 'assets/image/pengajuan/'.$old_image);
			}
				$new_image = $this->upload->data('file_name');
			}else{
				echo $this->upload->display_errors();
			}

			$data=[
				'nama_pj' => $this->input->post('nama'),
				'nip_pj' => $this->input->post('nip'),
				'foto_ktp' => $upload_image1,
				'foto_masjid1' => $upload_image2,
				'foto_masjid2' => $upload_image3,
				'foto_masjid3' => $upload_image4,
				'alamat_pj' => $this->input->post('alamat'),
				'kategori' => $this->input->post('kategori'),
				'durasi' => $this->input->post('durasi'),
				'proposal' => $upload_image5,
				'status' => "Menunggu Verifikasi"
			];

			$this->db->where('id_pengajuan', $id);
			$this->db->update('pengajuan',$data);
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Pengajuan anda berhasil diubah!</div>');
			redirect('user/buatCampaign');
		}
	}

	public function detailPengajuan($id){
		$data['pengajuan'] = $this->db->get_where('pengajuan',['id_pengajuan'=>$id])->row_array();

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside',$data);
		$this->load->view('user/detailPengajuan',$data);
		$this->load->view('templates/dashboardfoot');
	}

	public function detailDonasi($id){
		$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$data['donatur']=$this->db->get_where('donatur',['id_donatur'=>$id])->row_array();
		$data['campaign']=$this->db->get_where('campaign',['id_campaign'=>$data['donatur']['id_campaign']])->row_array();
		$data['pengajuan']=$this->db->get_where('pengajuan',['id_pengajuan'=>$data['campaign']['id_pengajuan']])->row_array();

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside',$data);
		$this->load->view('user/detaildonasi',$data);
		$this->load->view('templates/dashboardfoot');
	}

	public function campaign($status){
		if ($status=="dilaksanakan") {
			$data['pengajuan']=$this->db->get_where('pengajuan',['status'=>'Dilaksanakan'])->result_array();
			$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
			$id_user=$data['user']['id_user'];
			$dilaksanakan = "SELECT * FROM campaign WHERE status = 'Dilaksanakan' AND id_user = $id_user";
			$data['status']=$status;

			$config['base_url']= 'http://localhost/fundrise/user/campaign/dilaksanakan';
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
			$data['campaign']=$this->db->get_where('campaign',['status'=>'Dilaksanakan', 'id_user'=>$id_user],$config['per_page'],$data['start'])->result_array();

			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside',$data);
			$this->load->view('user/campaign', $data);
			$this->load->view('templates/dashboardfoot');
		}else{
			$data['pengajuan']=$this->db->get_where('pengajuan',['status'=>'Seleai'])->result_array();
			$data['user']=$this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
			$id_user=$data['user']['id_user'];
			$dilaksanakan = "SELECT * FROM campaign WHERE status = 'Selesai' AND id_user = $id_user";
			$data['status']=$status;

			$config['base_url']= 'http://localhost/fundrise/user/campaign/selesai';
			$config['total_rows']=$this->db->query($dilaksanakan)->num_rows();
			$config['per_page']=4;

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


			$data['start']=$this->uri->segment(5);
			$this->db->order_by('id_campaign','DESC');
			$data['campaign']=$this->db->get_where('campaign',['status'=>'Selesai', 'id_user'=>$id_user],$config['per_page'],$data['start'])->result_array();

			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside',$data);
			$this->load->view('user/campaign', $data);
			$this->load->view('templates/dashboardfoot');
		}
	}
	public function detailCampaign($id){
		$data['campaign'] = $this->db->get_where('campaign',['id_campaign'=>$id])->row_array();
		$data['pengajuan'] = $this->db->get_where('pengajuan',['id_pengajuan' => $data['campaign']['id_pengajuan']])->row_array();

		$query = "SELECT * FROM donatur WHERE id_campaign = $id AND status = 'Diterima'";

		$config['base_url']= 'http://localhost/fundrise/user/detailCampaign/'.$id;
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
		$this->load->view('templates/dashboardside',$data);
		$this->load->view('user/detailcampaign',$data);
		$this->load->view('templates/dashboardfoot');
	}

	public function downloadDataDonatur($id){
		$data['campaign'] = $this->db->get_where('campaign',['id_campaign'=>$id])->row_array();
		$data['pengajuan'] = $this->db->get_where('pengajuan',['id_pengajuan' => $data['campaign']['id_pengajuan']])->row_array();
		$data['donatur']=$this->db->get_where('donatur',['status'=>'Diterima', 'id_campaign'=>$id])->result_array();

		$this->load->view('user/downloaddatadonatur',$data);
	}

	public function penyaluran(){
		if ($this->session->userdata('role_id')==1) {
			$data['user'] = $this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
			$data['campaign'] = $this->db->get_where('donatur',['id_user'=>$data['user']['id_user']])->result_array();
			$this->db->order_by('id_penyaluran','DESC');
			$data['penyaluran'] = $this->db->get('penyaluran')->result_array();

			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('user/penyaluran', $data);
			$this->load->view('templates/dashboardfoot');
		}elseif ($this->session->userdata('role_id')==2) {
			$data['user'] = $this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
			$data['campaign'] = $this->db->get_where('campaign',['id_user'=>$data['user']['id_user']])->result_array();
			$this->db->order_by('id_penyaluran','DESC');
			$data['penyaluran'] = $this->db->get('penyaluran')->result_array();

			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('user/penyaluran', $data);
			$this->load->view('templates/dashboardfoot');
		}
	}
}