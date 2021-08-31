<section class="home-section">
  <div class="text">Detail Donasi</div>
  <div class="container-fluid">
    <div class="row no-gutters" style="color: #5d6056;">
      <div class="col-10 col-md-5">
        <h3>Metode Pembayaran <?= $donatur['pembayaran'];?></h3>
        <h4><?=$donatur['tanggal'];?></h4>
        <p><?=$donatur['nama'];?></p>
        <p><?=rupiah($donatur['nominal']);?></p>
        <p><?=$donatur['telepon'];?></p>
        <p><?=$donatur['pesan'];?></p>
        <p><?=$donatur['status'];?></p>
        <h4 class="mt-3"><bold>Campaign</bold></h4>
        <h5 class="mb-4"><?=$campaign['masjid'];?></h5>
        <img src="<?=base_url('assets/image/pengajuan/').$pengajuan['foto_masjid1'];?>" class="img-fluid" style="max-width: 400px;">
      </div>
      <div class="col-10 col-md-5">
        <?php if($donatur['status'] == 'Menunggu Verifikasi Admin'):?>
        <h3>Verifikasi Pembayaran</h3>
        <form method="post" action="<?=base_url('admin/verifikasiDonasi/').$donatur['id_donatur'];?>">
            <div class="form-group row">
              <label for="pesan" class="col-sm-2 col-form-label">Pesan</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="pesan" name="pesan" rows="3" placeholder="Isi pesan apabila terdapat pesan..."></textarea>
              </div>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="diterima" id="diterima" value="Diterima">
              <label class="form-check-label" for="diterima">Diterima</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="tidakditerima" id="tidakditerima" value="Ditolak">
              <label class="form-check-label" for="tidakditerima">Tidak diterima</label>
            </div>
            <button class="btn btn-info" type="submit">Verifikasi</button>
          </form>
          <?php elseif($donatur['status']=='Ditolak'):?>
            <h3>Verifikasi Pembayaran</h3>
        <form method="post" action="<?=base_url('admin/verifikasiDonasi/').$donatur['id_donatur'];?>">
            <div class="form-group row">
              <label for="pesan" class="col-sm-2 col-form-label">Pesan</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="pesan" name="pesan" rows="3" placeholder="Isi pesan apabila terdapat pesan..."></textarea>
              </div>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="diterima" id="diterima" value="Diterima">
              <label class="form-check-label" for="diterima">Diterima</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="tidakditerima" id="tidakditerima" value="Ditolak">
              <label class="form-check-label" for="tidakditerima">Tidak diterima</label>
            </div>
            <button class="btn btn-info" type="submit">Verifikasi</button>
            <a href="<?=base_url('admin/hapusDonasi/').$donatur['id_donatur'];?>">Hapus</a>
          </form>
          <?php endif;?>
      </div>
    </div>
  </div>
</section>
