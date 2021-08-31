<section class="home-section">
<div class="text">Newsletter</div>
<div class="container-fluid">
  <a href="<?=base_url('admin/buatNewsletter');?>" class="btn btn-info text-white">Buat Newsletter</a>
	<?= $this->session->flashdata('message');?>
    <div class="table-responsive-md mt-3">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Email</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
      	<?php $i=1;?>
		<?php foreach ($newsletter as $nl) :?>
        <tr>
          <th scope="row"><?=$i?></th>
          <td><?=$nl['email'];?></td>
          <td><a href="" class="btn btn-danger text-white">Hapus</a></td>
        </tr>
        <?php $i++;?>
				<?php endforeach?>
      </tbody>
    </table>
    </div>
      <?= $this->pagination->create_links();?>
  </div>
</section>

