<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Model extends CI_model{

	public function hitungCampaign(){
		$query = "SELECT * FROM `campaign` WHERE status = 'Dilaksanakan'";
		return $this->db->query($query)->num_rows();
	}

	public function hitungCampaignSearch($keyword){
		$query = $query = "SELECT * FROM `campaign` WHERE status = 'Dilaksanakan' AND masjid LIKE '$keyword'";
		return $this->db->query($query)->num_rows();
	}

	public function hitungCampaignPembangunan(){
		$pengajuan = $this->db->get_where('pengajuan',['kategori'=>'pembangunan'])->result_array();
		$campaign = $this->db->get_where('campaign', ['status'=>'Dilaksanakan'])->result_array();
		$i=0;
		foreach ($pengajuan as $pj) {
			foreach ($campaign as $cp) {
				if ($pj['id_pengajuan']==$cp['id_pengajuan']) {
					$i++;
				}
			}
		}
		return $i;
	}

	public function hitungCampaignRenovasi(){
		$pengajuan = $this->db->get_where('pengajuan',['kategori'=>'renovasi'])->result_array();
		$campaign = $this->db->get_where('campaign', ['status'=>'Dilaksanakan'])->result_array();
		$i=0;
		foreach ($pengajuan as $pj) {
			foreach ($campaign as $cp) {
				if ($pj['id_pengajuan']==$cp['id_pengajuan']) {
					$i++;
				}
			}
		}
		return $i;
	}

	public function hitungDonatur(){
		$query = "SELECT * FROM donatur WHERE status = 'Menunggu Verifikasi Admin'";
		return $this->db->query($query)->num_rows();
	}

	public function hitungDonaturDiterima(){
		$query = "SELECT * FROM donatur WHERE status = 'Diterima'";
		return $this->db->query($query)->num_rows();
	}

	public function hitungDonaturDitolak(){
		$query = "SELECT * FROM donatur WHERE status = 'Ditolak'";
		return $this->db->query($query)->num_rows();
	}

	public function hitungDonaturUser($id_user){
		$query = "SELECT * FROM donatur WHERE id_user = $id_user";
		return $this->db->query($query)->num_rows();
	}

	public function hitungBuatCampaign($id){
		$query = "SELECT * FROM `pengajuan` WHERE `id_user` = $id";
		return $this->db->query($query)->num_rows();
	}

public function getBuatCampaign($limit,$start){
		return $this->db->get('pengajuan',$limit,$start)->result_array();
	}
public function getDataBuatCampaignById($id){
		return $this->db->get_where('pengajuan',['id_pengajuan'=>$id])->row_array();
	}

	public function totalDonatur($id){
		$query = "SELECT * FROM donatur WHERE id_campaign = $id";
		return $this->db->query($query)->num_rows();
	}

	public function hitungPenyaluran(){
		$query = "SELECT * FROM penyaluran";
		return $this->db->query($query)->num_rows();
	}

	public function hitungNewsletter(){
		$query = "SELECT * FROM newsletter";
		return $this->db->query($query)->num_rows();
	}
}

// $query = "SELECT * FROM `pengajuan` WHERE `id_pengajuan` = $id LIMIT $limit, $start";
// 		return $this->db->query($query)->result_array();