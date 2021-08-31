<section class="home-section">
    <div class="text">Ubah Tentang Kami</div>
	<div class="container-fluid">
		<div class="col-10 offset-1 col-md-3 offset-md-0">
			<?= $this->session->flashdata('message');?>
		</div>
		<div class="col-10 col-md-5">
			<form class="my-3" method="post" action="" enctype="multipart/form-data">
			    <div class="form-group">
		  				<label for="image1" class="col-form-label text-dark">Gambar</label>
		  				<div class="row">
					    <div class="col-sm-12">
					    	<div class="row">
					    		<div class="col-sm-3">
					    		<img src="<?= base_url('assets/image/tentang/').$tentang['gambar'];?>" class="img-thumbnail"> 
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
		            <div class="control-group after-add-more">
			            <textarea class="form-control" id="teks[]" name="teks[]" rows="3" placeholder="Teks paragraf disini.."><?=$tentang['teks'];?></textarea>
		            </div>
			        <button class="add-more btn btn-primary mt-3 text-white" type="button">Paragraf baru</button>
			        <br><?=form_error('teks[0]','<small class="text-danger pl-1">','</small>');?>
		        </div>
		        <div class="row justify-content-center">
		            <button type="submit" class="btn btn-outline-warning col-10 col-md-4 my-2 my-md-4 mx-md-2">Input</button>
		        </div>
		    </form>
		</div>
	</div>
	</div>
	<div class="copy invisible">
		<div class="control-group my-3">
			<textarea class="form-control" id="teks[]" name="teks[]" rows="3" placeholder="Teks paragraf disini.."><?=set_value('teks')?></textarea>
			<a class="remove btn btn-danger mt-2 text-white">Hapus</a>
		</div>
	</div>
	</section>