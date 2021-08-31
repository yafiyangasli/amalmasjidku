	<section class="home-section">
    <div class="text">Buat Penyaluran</div>
	<div class="container-fluid">
		<div class="col-10 offset-1 col-md-3 offset-md-0">
			<?= $this->session->flashdata('message');?>
		</div>
		<div class="col-10 col-md-5">
			<form class="my-3" method="post" action="" enctype="multipart/form-data">
		        <div class="form-group">
		            <label for="name">Judul</label>
		            <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul..." value="<?=$penyaluran['judul'];?>">
			        <?=form_error('judul','<small class="text-danger pl-1">','</small>');?>
			    </div>
			    <div class="form-group">
		  				<label for="image1" class="col-form-label text-dark">Gambar</label>
		  				<div class="row">
					    <div class="col-sm-12">
					    	<div class="row">
					    		<div class="col-sm-3">
					    		<img src="<?= base_url('assets/image/penyaluran/').$penyaluran['gambar'];?>" class="img-thumbnail"> 
					    		</div>
					    		<div class="col-sm-9">
					    			<div class="custom-file">
									  <input type="file" class="custom-file-input" id="gambar" name="gambar">
									  <label class="custom-file-label" for="gambar">Choose File</label>
									</div>
					    		</div>
					    	</div>
					    </div>
					    </div>
					    </div>
		       	<div class="form-group">
		            <label for="teks">Teks</label>
			            <textarea class="form-control" id="teks" name="teks" rows="3" placeholder="Teks paragraf disini.."><?=$penyaluran['isi'];?></textarea>
						<?=form_error('teks','<small class="text-danger pl-1">','</small>');?>
		        </div>
		        <div class="row justify-content-center">
		            <button type="submit" class="btn btn-outline-warning col-10 col-md-4 my-2 my-md-4 mx-md-2">Input</button>
		        </div>
		    </form>
		</div>
	</div>
	</div>
	</section>