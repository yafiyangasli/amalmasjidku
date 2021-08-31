<section class="home-section">
  <div class="text">Donasi Anda</div>
  <div class="container-fluid">
    <div class="table-responsive-md">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Tanggal</th>
          <th scope="col">Invoice</th>
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
          <?php if($dt['status']=='Menunggu Verifikasi Admin'):?>
            <th></th>
          <?php else:?>
            <th><a href="<?=base_url('user/pdfConvert/').$dt['id_donatur'];?>" target="<?=base_url('user/pdfConvert/').$dt['id_donatur'];?>"><?=invoice_num($dt['id_donatur'], 7, "F-");?></a></th>
          <?php endif;?>
          <td><?=$dt['nama'];?></td>
          <td><?=rupiah($dt['nominal']);?></td>
          <td><?=$dt['pembayaran'];?></td>
          <td><?=$dt['status'];?></td>
          <td><a href="<?=base_url('user/detailDonasi/').$dt['id_donatur'];?>" class="btn btn-info">Lihat</a></td>
        </tr>
      <?php endforeach;?>
      </tbody>
    </table>
    </div>
  </div>
</section>