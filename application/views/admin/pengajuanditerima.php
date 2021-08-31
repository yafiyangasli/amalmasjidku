<section class="home-section">
<div class="text">Pengajuan Diterima</div>
<div class="container-fluid">
	<?= $this->session->flashdata('message');?>
	<div class="btn-group mt-3" role="group" aria-label="Basic example">
	  <a href="<?=base_url('admin/pengajuan');?>" class="btn btn-info">Menunggu Verifikasi</a>
	  <a href="<?=base_url('admin/pengajuanDiterima');?>" class="btn btn-info active">Disetujui</a>
	  <a href="<?=base_url('admin/pengajuanDitolak');?>" class="btn btn-info">Ditolak</a>
	</div>
    <div class="table-responsive-md mt-3">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Penanggung Jawab</th>
          <th scope="col">Kategori</th>
          <th scope="col">Durasi</th>
          <th scope="col">Status</th>
          <th scope="col">Detail</th>

        </tr>
      </thead>
      <tbody>
      	<?php $i=1;?>
		<?php foreach ($pengajuan as $pj) :?>
        <tr>
          <th scope="row"><?=$i?></th>
          <td><?=$pj['nama_pj'];?></td>
          <td><?=$pj['kategori'];?></td>
          <td><?=$pj['durasi'];?> Bulan</td>
          <td><?=$pj['status'];?></td>
          <td><a href="<?=base_url('admin/detailPengajuan/').$pj['id_pengajuan'];?>" class="btn btn-info">Lihat</a> <a href="<?=base_url('admin/buatCampaign/').$pj['id_pengajuan'];?>" class="btn btn-warning">Buat Campaign</a></td>
        </tr>
        <?php $i++;?>
				<?php endforeach?>
      </tbody>
    </table>
    </div>
  </div>
</section>

