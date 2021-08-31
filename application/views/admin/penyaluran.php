<section class="home-section">
<div class="text">Penyaluran</div>
<div class="container-fluid">
	<?= $this->session->flashdata('message');?>
    <div class="table-responsive-md mt-3">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Waktu</th>
          <th scope="col">Judul</th>
          <th scope="col">Detail</th>

        </tr>
      </thead>
      <tbody>
      	<?php $i=1;?>
		<?php foreach ($penyaluran as $py) :?>
        <tr>
          <th scope="row"><?=$i?></th>
          <td><?=$py['waktu'];?></td>
          <td><?=$py['judul'];?></td>
          <td><a href="<?=base_url('penyaluran/detail/').$py['id_penyaluran'];?>" class="btn btn-info">Lihat</a> <a href="<?=base_url('admin/editPenyaluran/').$py['id_penyaluran'];?>" class="btn btn-warning text-white">Edit</a></td>
        </tr>
        <?php $i++;?>
				<?php endforeach?>
      </tbody>
    </table>
    </div>
      <?= $this->pagination->create_links();?>
  </div>
</section>

