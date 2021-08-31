<div class="jumbotron jumbotron-fluid" style="background-image: url('<?=base_url('assets/image/kategori.jpg');?>'); background-size: cover; min-height: calc(100vh - 40px);" >
  <div class="container" style="color: #e7f6e8">
    <h1 class="display-4" >Mari Berbagi</h1>
    <p class="lead">Kamu bisa memilih berbagai campaign untuk berdonasi dan membantu program-program kemanusiaan yang ada disini.</p>
  </div>
</div>

<div class="container my-5">
	<h4 class="col-10 col-md-3">Campaign</h4>
	<hr class="mb-4">
		<div class="mb-4" >
			<div style=" background-color: white; border-radius: 5px; padding: 10px;">
			<h5>Filter</h5>
			<form method="post" action="<?=base_url('category/filter');?>">
				<div class="row no-gutters">
					<div class="col-4 col-md-5">
					  <div class="form-group">
					    <label for="kategori">Kategori</label>
					    <select class="form-control col-12 col-md-10" id="kategori" name="kategori">
					      <option value="">Semua</option>
					      <option value="pembangunan">Pembangunan</option>
					      <option value="renovasi">Renovasi</option>
					    </select>
					  </div>
					</div>
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
			  			<button type="submit" class="btn btn-outline-info mt-md-1">Submit</button>
					</div>
				</div>
			</form>
			</div>
		</div>
		<label style="font-size: 1.5vw"><?=$tampilkan;?></label>
		<div class="" style=" background-color: #dfe4e3; border-radius: 5px; padding: 10px;">
			<div class="row no-gutters my-4 justify-content-left">
				<?php foreach($campaign as $cp):?>
					<?php foreach($pengajuan as $pj):
						if ($cp['id_pengajuan'] == $pj['id_pengajuan']):?>
			        <a href="<?=base_url('donation/detail/').$cp['id_campaign'];?>" class="text-decoration-none" style="color:#5d6056;">
			        <div class="card m-3" style="width: 15rem;">
			          <img src="<?=base_url('assets/image/pengajuan/').$pj['foto_masjid1'];?>" class="card-img-top" alt="...">
			          <div class="card-body">
			            <h5 class="card-title"><?=$cp['masjid'];?></h5>
			            <h6 class="card-subtitle mb-4 text-muted"><?=$pj['kategori'];?></h6>
			            <p class="card-text">
			            <div class="row no-gutters">
			            	<div class="col-6">
			            		<label style="font-size: 70%">Donasi<br><?=rupiah($cp['donasi_terkumpul']);?></label>
			            	</div>
			            	<div class="col-4 offset-2">
			            		<label style="font-size: 70%; text-align: right;" >Tenggat<br><?=$cp['deadline'];?></label>
			            	</div>
			            </div>
			            <div class="progress">
							<div class="progress-bar bg-success" aria-valuenow="<?=progressbar($cp['donasi_terkumpul'],$cp['donasi_total']);?>" style="width: <?=progressbar($cp['donasi_terkumpul'],$cp['donasi_total']);?>%;" role="progressbar" aria-valuemin="0" aria-valuemax="100"><?=progressbar($cp['donasi_terkumpul'],$cp['donasi_total']);?>%</div>
						</div>
						<label style="font-size: 70%; text-align: right;">Total <?=rupiah($cp['donasi_total']);?></label>
			            </p>
			          </div>
			      	</div>
			        </a>
		  		<?php 
		  	endif;
		  endforeach;
		  	endforeach;?>
		    </div>
			<?= $this->pagination->create_links();?>
		</div>
</div>
