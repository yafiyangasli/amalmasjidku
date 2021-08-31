<section class="home-section">
  <div class="text">Detail Pengajuan</div>
  <div class="container-fluid">
    <div class="row no-gutters" style="color: #5d6056;">
      <div class="col-10 col-md-5">
        <h5 class="mb-4">KTP Penanggung Jawab</h5>
        <img src="<?=base_url('assets/image/pengajuan/').$pengajuan['foto_ktp'];?>" class="img-fluid" style="max-width: 400px">
        <h5 class="mt-4">Foto Masjid</h5>
        <img src="<?=base_url('assets/image/pengajuan/').$pengajuan['foto_masjid1'];?>" class="img-fluid mt-2" style="max-width: 400px">
        <img src="<?=base_url('assets/image/pengajuan/').$pengajuan['foto_masjid2'];?>" class="img-fluid mt-2" style="max-width: 400px">
        <img src="<?=base_url('assets/image/pengajuan/').$pengajuan['foto_masjid3'];?>" class="img-fluid mt-2" style="max-width: 400px">
      </div>
      <div class="col-10 col-md-5">
        <h5>Data Pengajuan</h5>
        <div class="row mt-4"> 
          <div class="col-6">
            <p>Nama Penanggung Jawab</p>
            <p>NIP Penanggung Jawab</p>
            <p>Alamat Penanggung Jawab</p>
            <p>Kategori Donasi</p>
            <p>Durasi Donasi</p>
            <p>Proposal</p>
            <p>Status</p>
            <p>Pesan</p>
          </div>
          <div class="col-5">
            <p><?=$pengajuan['nama_pj'];?></p>
            <p><?=$pengajuan['nip_pj'];?></p>
            <p><?=$pengajuan['alamat_pj'];?></p>
            <p><?=$pengajuan['kategori'];?></p>
            <p><?=$pengajuan['durasi'];?></p>
            <p><a href="http://localhost/fundrise/assets/image/pengajuan/<?=$pengajuan['proposal'];?>" target="http://localhost/fundrise/assets/image/pengajuan/<?=$pengajuan['proposal'];?>">Lihat disini</a></p>
            <p><?=$pengajuan['status'];?></p>
            <p><?=$pengajuan['pesan'];?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
