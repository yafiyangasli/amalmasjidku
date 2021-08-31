<section class="home-section">
  <div class="text">Detail Campaign</div>
  <div class="container-fluid">
    <div class="row no-gutters" style="color: #5d6056;">
      <div class="col-10 col-md-5">
        <h5 class="mt-4">Foto Masjid</h5>
        <img src="<?=base_url('assets/image/pengajuan/').$pengajuan['foto_masjid1'];?>" class="img-fluid mt-2" style="max-width: 400px">
        <img src="<?=base_url('assets/image/pengajuan/').$pengajuan['foto_masjid2'];?>" class="img-fluid mt-2" style="max-width: 400px">
        <img src="<?=base_url('assets/image/pengajuan/').$pengajuan['foto_masjid3'];?>" class="img-fluid mt-2" style="max-width: 400px">
      </div>
      <div class="col-10 col-md-5">
        <h5>Data Pengajuan</h5>
        <div class="row mt-4"> 
          <div class="col-6">
            <p>Nama Masjid</p>
            <p>Kategori</p>
            <p>Durasi Donasi</p>
            <p>Tenggat Donasi</p>
            <p>Status</p>
            <p>Progress Donasi</p> 
          </div>
          <div class="col-5">
            <p><?=$campaign['masjid'];?></p>
            <p><?=$pengajuan['kategori'];?></p>
            <p><?=$pengajuan['durasi'];?></p>
            <p><?=$campaign['deadline'];?></p>
            <p><?=$campaign['status'];?></p>
            <div class="progress">
              <div class="progress-bar bg-success" aria-valuenow="<?=progressbar($campaign['donasi_terkumpul'],$campaign['donasi_total']);?>" style="width: <?=progressbar($campaign['donasi_terkumpul'],$campaign['donasi_total']);?>%;" role="progressbar" aria-valuemin="0" aria-valuemax="100"><?=progressbar($campaign['donasi_terkumpul'],$campaign['donasi_total']);?>%</div>
            </div>
          <label style="font-size: 10px">Sudah terkumpul <?=rupiah($campaign['donasi_terkumpul']);?> dari <?=rupiah($campaign['donasi_total']);?></label>
          </div>
          <div class="table-responsive-md mt-4">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama</th>
                <th scope="col">Donasi</th>
                <th scope="col">Pesan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($donatur as $dt):?>
              <tr>
                <td><?= $dt['tanggal'];?></td>
                <td><?=$dt['nama'];?></td>
                <td><?=rupiah($dt['nominal']);?></td>
                <td><?=$dt['pesan'];?></td>
              </tr>
            <?php endforeach;?>
            </tbody>
          </table>
          </div>
          <?= $this->pagination->create_links();?>
          <a href="<?=base_url('user/downloaddatadonatur/').$campaign['id_campaign'];?>" class="btn btn-outline-warning">Download data donatur</a>
        </div>
      </div>
    </div>
  </div>
</section>
