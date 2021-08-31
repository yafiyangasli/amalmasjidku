<section class="home-section">
  <div class="text">Donasi Ditolak</div>
  <div class="container-fluid">
    <?= $this->session->flashdata('message');?>
    <div class="btn-group my-3" role="group" aria-label="Basic example">
      <a href="<?=base_url('admin/donatur');?>" class="btn btn-info">Butuh Konfirmasi</a>
      <a href="<?=base_url('admin/donasiDiterima');?>" class="btn btn-info">Diterima</a>
      <a href="<?=base_url('admin/donasiDitolak');?>" class="btn btn-info active">Ditolak</a>
    </div>
    <div class="table-responsive-md">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Tanggal</th>
          <th scope="col">Nama</th>
          <th scope="col">Donasi</th>
          <th scope="col">Pembayaran</th>
          <th scope="col">Status</th>
          <th scope="col">Detail</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach($donatur as $dt):?>
        <tr>
          <td><?= $dt['tanggal'];?></td>
          <td><?=$dt['nama'];?></td>
          <td><?=rupiah($dt['nominal']);?></td>
          <td><?=$dt['pembayaran'];?></td>
          <td><?=$dt['status'];?></td>
          <td><a href="<?=base_url('admin/detailDonasi/').$dt['id_donatur'];?>" class="btn btn-info">Lihat</a></td>
        </tr>
      <?php endforeach;?>
      </tbody>
    </table>
    </div>
  </div>
</section>