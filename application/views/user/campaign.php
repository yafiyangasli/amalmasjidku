<section class="home-section">
    <div class="text">Campaign</div>
    <div class="container-fluid">
    <?= $this->session->flashdata('message');?>
    <div class="btn-group mt-3" role="group" aria-label="Basic example">
      <?php if($status=="dilaksanakan"):?>
      <a href="<?=base_url('user/campaign/dilaksanakan');?>" class="btn btn-info active">Dilaksanakan</a>
      <a href="<?=base_url('user/campaign/selesai');?>" class="btn btn-info">Selesai</a>
      <?php else:?>
      <a href="<?=base_url('user/campaign/dilaksanakan');?>" class="btn btn-info">Dilaksanakan</a>
      <a href="<?=base_url('user/campaign/selesai');?>" class="btn btn-info active">Selesai</a>
      <?php endif;?>
    </div>
      <div class="table-responsive-md mt-3">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Masjid</th>
            <th scope="col">Donasi</th>
            <th scope="col">Total</th>
            <th scope="col">Tenggat</th>
            <th scope="col">Detail</th>

          </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
      <?php foreach ($campaign as $cp) :?>
          <tr>
            <th scope="row"><?=$i?></th>
            <td><?=$cp['masjid'];?></td>
            <td><?=$cp['donasi_terkumpul'];?></td>
            <td><?=$cp['donasi_total'];?></td>
            <td><?=$cp['deadline'];?></td>
            <td><a href="<?=base_url('user/detailCampaign/').$cp['id_campaign'];?>" class="btn btn-info">Lihat</a></td>
          </tr>
          <?php $i++;?>
          <?php endforeach?>
        </tbody>
      </table>
      </div>
      <?= $this->pagination->create_links();?>
    </div>
  </section>