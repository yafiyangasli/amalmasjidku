<div class="jumbotron jumbotron-fluid" style="background-image: url('<?=base_url('assets/image/kategori.jpg');?>'); background-size: cover;">
  <div class="container" style="color: #e7f6e8">
    <h1 class="display-4" >Mari Berbagi</h1>
    <p class="lead">Kamu bisa memilih berbagai campaign untuk berdonasi dan membantu program-program kemanusiaan yang ada disini.</p>
  </div>
</div>

<div class="container my-5" style="min-height: calc(100vh - 40px);">
	<h4 class="col-10 col-md-3">Penyaluran</h4>
	<hr class="mb-4">
		<div class="mb-4" >
			<div style=" background-color: white; border-radius: 5px; padding: 10px;">
			<h5>Filter</h5>
			<form method="post" action="<?=base_url('penyaluran/filter');?>">
				<div class="row no-gutters">
					<div class="col-4 offset-1 col-md-5 offset-md-0">
					  <div class="form-group">
					    <label for="urutkan">Urutkan</label>
					    <select class="form-control col-12 col-md-10" id="urutkan" name="urutkan">
					      <option>Urutkan...</option>
					      <option value="terbaru">Terbaru</option>
					      <option value="terlama">Terlama</option>
					    </select>
					  </div>
					</div>
					<div class="col-4 col-md-2">
						<br>
			  			<button type="submit" class="btn btn-outline-warning mt-md-1">Submit</button>
					</div>
				</div>
			</form>
			</div>
		</div>
		<label style="font-size: 1.5vw"><?=$tampilkan;?></label>
		<div class="mt-4" style=" background-color: #dfe4e3; border-radius: 5px; padding: 10px;">
			<ul class="list-unstyled">
			<?php foreach($penyaluran as $pl):?>
			  <li class="media mt-4" style=" padding: 5px;">
			    <img src="<?=base_url('assets/image/penyaluran/').$pl['gambar'];?>" class="align-self-center mr-3" style="max-width: 20%">
			    <div class="media-body">
			      <h5 class="mt-0 mb-1"><?=$pl['judul'];?></h5>
			      <?php $desc = str_replace("<p>", "", $pl['isi']);
			      		$desc1 = str_replace("</p>", " ", $desc);
			      		$desc2 = mb_strimwidth($desc1, 0, 300, "...");
			      		$desc = "";
			      ?>
			      <p style="font-size: 12px"><?=$desc2;?> <a href="<?=base_url('penyaluran/detail/').$pl['id_penyaluran'];?>" class="text-decoration-none">Baca selengkapnya</a></p>
			    </div>
			  </li>
			<?php endforeach;?>
			</ul>
			<?= $this->pagination->create_links();?>
		</div>
</div>
