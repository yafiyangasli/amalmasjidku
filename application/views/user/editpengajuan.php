	<section class="home-section">
    <div class="text">Edit Pengajuan</div>
	<div class="container-fluid">
		<div class="col-10 offset-1 col-md-3 offset-md-0">
			<?= $this->session->flashdata('message');?>
		</div>
		<div class="col-10 col-md-10">
			<form class="my-3" method="post" action="" enctype="multipart/form-data">
				<div class="row no-gutters">
					<div class="col-10 col-md-5">
				        <div class="form-group">
				            <label for="name">Nama Penganggung Jawab</label>
				            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama..." value="<?=$pengajuan['nama_pj'];?>">
					        <?=form_error('judul','<small class="text-danger pl-1">','</small>');?>
					    </div>
					    <div class="form-group">
				            <label for="name">NIP Penganggung Jawab</label>
				            <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP..." value="<?=$pengajuan['nip_pj'];?>">
					        <?=form_error('judul','<small class="text-danger pl-1">','</small>');?>
					    </div>
				       	<div class="form-group">
				            <label for="teks">Alamat Penanggung Jawab</label>
					            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat.."><?=$pengajuan['alamat_pj'];?></textarea>
								<?=form_error('teks','<small class="text-danger pl-1">','</small>');?>
				        </div>
				        <div class="form-group">
						    <label for="kategori">Kategori</label>
						    <select class="form-control" id="kategori" name="kategori">
						    	<?php if($penyaluran['kategori']=="pembangunan"):?>
							    	<option value="pembangunan">Pembangunan</option>
							    	<option value="renovasi">Renovasi</option>
							    <?php else:?>
							    	<option value="renovasi">Renovasi</option>
							    	<option value="pembangunan">Pembangunan</option>
							    <?php endif;?>
						    </select>
						</div>
						<div class="form-group">
					        <label for="durasi">Durasi</label>
				            <select class="form-control" id="durasi" name="durasi">
				            	<?php if($penyaluran['durasi']==1):?>
							   		<option value="1">1 bulan</option>
							    	<option value="2">2 bulan</option>
							    	<option value="3">3 bulan</option>
							    <?php elseif ($penyaluran['durasi']==2):?>
						      		<option value="2">2 bulan</option>
							    	<option value="1">1 bulan</option>
						    		<option value="3">3 bulan</option>
							    <?php else:?>
						      		<option value="3">3 bulan</option>
							    	<option value="1">1 bulan</option>
						      		<option value="2">2 bulan</option>
							    <?php endif;?>
						    </select>
				            <?=form_error('durasi','<small class="text-danger pl-1">','</small>');?> 
				        </div>
					</div>
					<div class="col-10 col-sm-5 offset-0 offset-md-1">
					    <div class="form-group">
				  				<label for="image1" class="col-form-label text-dark">KTP Penanggung Jawab</label>
				  				<div class="row">
							    <div class="col-sm-12">
							    	<div class="row">
							    		<div class="col-sm-3">
							    		<img src="<?= base_url('assets/image/pengajuan/').$pengajuan['foto_ktp'];?>" class="img-thumbnail"> 
							    		</div>
							    		<div class="col-sm-9">
							    			<div class="custom-file">
											  <input type="file" class="custom-file-input" id="gambar0" name="gambar0">
											  <label class="custom-file-label" for="gambar">Choose File</label>
											</div>
							    		</div>
							    	</div>
							    </div>
							</div>
						</div>
						<div class="form-group">
				  				<label for="image1" class="col-form-label text-dark">Foto Masjid 1</label>
				  				<div class="row">
							    <div class="col-sm-12">
							    	<div class="row">
							    		<div class="col-sm-3">
							    		<img src="<?= base_url('assets/image/pengajuan/').$pengajuan['foto_masjid1'];?>" class="img-thumbnail"> 
							    		</div>
							    		<div class="col-sm-9">
							    			<div class="custom-file">
											  <input type="file" class="custom-file-input" id="gambar1" name="gambar1">
											  <label class="custom-file-label" for="gambar">Choose File</label>
											</div>
							    		</div>
							    	</div>
							    </div>
							</div>
						</div>
						<div class="form-group">
				  				<label for="image1" class="col-form-label text-dark">Foto Masjid 2</label>
				  				<div class="row">
							    <div class="col-sm-12">
							    	<div class="row">
							    		<div class="col-sm-3">
							    		<img src="<?= base_url('assets/image/pengajuan/').$pengajuan['foto_masjid2'];?>" class="img-thumbnail"> 
							    		</div>
							    		<div class="col-sm-9">
							    			<div class="custom-file">
											  <input type="file" class="custom-file-input" id="gambar2" name="gambar2">
											  <label class="custom-file-label" for="gambar">Choose File</label>
											</div>
							    		</div>
							    	</div>
							    </div>
							</div>
						</div>
						<div class="form-group">
				  				<label for="image1" class="col-form-label text-dark">Foto Masjid 3</label>
				  				<div class="row">
							    <div class="col-sm-12">
							    	<div class="row">
							    		<div class="col-sm-3">
							    		<img src="<?= base_url('assets/image/pengajuan/').$pengajuan['foto_masjid3'];?>" class="img-thumbnail"> 
							    		</div>
							    		<div class="col-sm-9">
							    			<div class="custom-file">
											  <input type="file" class="custom-file-input" id="gambar3" name="gambar3">
											  <label class="custom-file-label" for="gambar">Choose File</label>
											</div>
							    		</div>
							    	</div>
							    </div>
							</div>
						</div>
						<div class="form-group">
				  				<label for="image1" class="col-form-label text-dark">Form Proposal</label>
				  				<label><a href="" style="font-size: 12px">download form proposal disini</a></label>
				  				<div class="row">
							    <div class="col-sm-12">
							    	<div class="row">
							    		<div class="col-sm-12">
							    			<div class="custom-file">
											  <input type="file" class="custom-file-input" id="gambar4" name="gambar4">
											  <label class="custom-file-label" for="gambar">Choose File</label>
											</div>
											<label style="font-size: 10px; color: red; padding-top: 0">*upload proposal harus dalam bentuk pdf</label>
							    		</div>
							    	</div>
							    </div>
							</div>
						</div>
						
					</div>
				</div>
		        <button type="submit" class="btn btn-outline-success col-10 col-md-2 my-2 my-md-4 mx-md-2">Ubah</button>
		    </form>
		</div>
	</div>
	</div>
	</section>