<section class="home-section">
  <div class="text">Detail Donasi</div>
  <div class="container-fluid">
    <div class="row no-gutters" style="color: #5d6056;">
      <div class="col-10 col-md-5">
        <h5>Metode Pembayaran <?= $donatur['pembayaran'];?></h5>
        <?php if ($donatur['pembayaran'] == "QR BCA") {
            $pembayaran='<img src="'.base_url('assets/image/transfer/qrbca.jpeg').'" class="img-fluid" style="max-width:400px;">';
          } elseif ($donatur['pembayaran'] == "QR Dana") {
            $pembayaran='<img src="'.base_url('assets/image/transfer/qrdana.jpeg').'" class="img-fluid" style="max-width:400px;">';
          } elseif ($donatur['pembayaran'] == "QR Gopay") {
            $pembayaran='<img src="'.base_url('assets/image/transfer/qrgopay.jpeg').'" class="img-fluid" style="max-width:400px;">';
          } elseif ($donatur['pembayaran'] == "QR BIDR") {
            $pembayaran='<img src="'.base_url('assets/image/transfer/qrbidr.jpeg').'" class="img-fluid" style="max-width:400px;">';
          } elseif ($donatur['pembayaran'] == "Transfer Bank BRI") {
            $pembayaran='<p>BRI : 009801104271508</p><p>A.n. Miftah Murod</p>';
          } elseif ($donatur['pembayaran'] == "Transfer Bank BCA") {
            $pembayaran='<p>BCA : 0201638894</p><p>A.n. Miftah Murod</p>';
          } elseif ($donatur['pembayaran'] == "Transfer Bank BTPN") {
            $pembayaran='<p>BTPN: 90014236357</p><p>A.n. Miftah Murod</p>';
          } elseif ($donatur['pembayaran'] == "Virtual Akun Permata") {
            $pembayaran='<p>Permata Bank: 8214171043777959</p>';
          } elseif ($donatur['pembayaran'] == "Virtual Akun Mandiri") {
            $pembayaran='<p>Bank Mandiri : 88608171097574709</p>';
          }?>
        <?= $pembayaran;?>
      </div>
      <div class="col-10 col-md-5">
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
    </div>
  </div>
</section>
