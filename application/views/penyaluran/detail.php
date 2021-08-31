<div class="container" style="min-height: calc(100vh - 40px);">
	<div class="row no-gutters my-5">
		<div class="col-10 col-md-8 offset-1 offset-md-0 py-4" style=" background-color: #dfe4e3; border-radius: 5px; padding: 10px; ">
			<h2 class="mb-4" style="max-width: 90%; height: auto; margin-left: auto; margin-right: auto; display: block; font-size: 2.8vw;"><?=$penyaluran['judul'];?></h2>
			<img src="<?=base_url('assets/image/penyaluran/').$penyaluran['gambar'];?>" class="img-fluid" style="max-width: 90%; height: auto; border-radius: 5px; margin-left: auto; margin-right: auto; display: block;">
			<label style="max-width: 90%; height: auto; margin-left: auto; margin-right: auto; display: block; font-size: 12px;">Lampung, <?=$penyaluran['waktu'];?></label>
			<div style="max-width: 90%; height: auto; margin-left: auto; margin-right: auto; margin-top: 5%; display: block; font-size: 12.5px;">
				<?=$penyaluran['isi'];?>
			<a href="<?=base_url('user/downloaddatadonatur/').$campaign2['id_campaign'];?>" class="btn btn-outline-warning">Download data donatur</a>
			</div>
		</div>
		<div class="col-10 col-md-3 offset-1 offset-md-1 py-4" style="border-radius: 5px; padding: 10px;">
			<h5 class="mb-4" style="max-width: 90%; height: auto; margin-left: auto; margin-right: auto; display: block;">Update penyaluran lainnya</h5>
			<div class="justify-content-center" style="max-width: 90%; height: auto; margin-left: auto; margin-right: auto; display: block;">
				<?php foreach($samping as $sp):
					$waktu=explode(" ", $sp['waktu']);?>
			        <a href="<?=base_url('penyaluran/detail/').$sp['id_penyaluran'];?>" class="text-decoration-none" style="color:#5d6056;">
		            <div class="card mb-3" style="width: 15rem; background-color: white">
		              <img src="<?=base_url('assets/image/penyaluran/').$sp['gambar'];?>" class="card-img-top" alt="...">
		              <div class="card-body">
		                <h5 class="card-title" style="font-size: 15px; margin-bottom: 30%"><?= $sp['judul'];?></h5>
		                <p class="card-text"><?= $waktu[1];?></p>
		              </div>
		            </div>
		          </a>
		  		<?php endforeach;?>
			</div>
		</div>
	</div>
</div>