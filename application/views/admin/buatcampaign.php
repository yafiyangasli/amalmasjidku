<section class="home-section">
    <div class="text">Buat Campaign</div>
<div class="container-fluid">
	<div class="col-10 col-md-10">
		<form class="my-3" method="post" action="" enctype="multipart/form-data">
			<div class="row no-gutters">
				<div class="col-10 col-md-5 offset-1 offset-md-0">
		            <div class="form-group">
		              <label for="name">Nama Masjid</label>
		              <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama..." value="<?=$user['nama'];?>">
		              <?=form_error('name','<small class="text-danger pl-1">','</small>');?>
		            </div>
		            <div class="form-group">
		              <label for="kategori">Kategori</label>
		              <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan nama..." value="<?=$pengajuan['kategori'];?>" readonly>
		            </div>
		            <div class="form-group">
		              <label for="durasi">Durasi (bulan)</label>
		              <input type="text" class="form-control" id="durasi" name="durasi" placeholder="Masukkan nama..." value="<?=$pengajuan['durasi'];?>" readonly>
		            </div>
		            <div class="form-group">
		              <label for="target">Target</label>
		              <input type="text" class="form-control" id="target" name="target" placeholder="Masukkan target (*100000)" value="">
		              <?=form_error('target','<small class="text-danger pl-1">','</small>');?>
		            </div>
					
				</div>
				<div class="col-10 col-md-5 offset-1">
					<div class="form-group">
				        <label for="gambar">Gambar 1</label>
			            <div class="custom-file">
				            <input type="file" class="custom-file-input" id="gambar0" name="gambar0">
				            <label class="custom-file-label" for="gambar">Gambar penyaluran</label>
				        </div>
			        </div>
			        <div class="form-group">
				        <label for="gambar">Gambar 2</label>
			            <div class="custom-file">
				            <input type="file" class="custom-file-input" id="gambar1" name="gambar1">
				            <label class="custom-file-label" for="gambar">Gambar penyaluran</label>
				        </div>
			        </div>
			        <div class="form-group">
				        <label for="gambar">Gambar 3</label>
			            <div class="custom-file">
				            <input type="file" class="custom-file-input" id="gambar2" name="gambar2">
				            <label class="custom-file-label" for="gambar">Gambar penyaluran</label>
				        </div>
			        </div>
			        <div class="form-group">
				        <label for="gambar">Gambar 4</label>
			            <div class="custom-file">
				            <input type="file" class="custom-file-input" id="gambar3" name="gambar3">
				            <label class="custom-file-label" for="gambar">Gambar penyaluran</label>
				        </div>
			        </div>
					<div class="form-group">
			            <label for="teks">Deskripsi</label>
			            <div class="control-group after-add-more">
				            <textarea class="form-control" id="teks[]" name="teks[]" rows="3" placeholder="Teks paragraf disini.."><?=set_value('teks[0]')?></textarea>
			            </div>
				        <button class="add-more btn btn-primary mt-3 text-white" type="button">Paragraf baru</button>
				        <br><?=form_error('teks[0]','<small class="text-danger pl-1">','</small>');?>
			        </div>
		            <div class="row justify-content-end">
		              <button type="submit" class="btn btn-outline-success col-10 col-md-4 my-2 my-md-4 mx-md-2">Submit</button>
		            </div>
				</div>
			</div>
	          </form>
		
	</div>
</div>
<div class="copy invisible">
	<div class="control-group my-3">
		<textarea class="form-control" id="teks[]" name="teks[]" rows="3" placeholder="Teks paragraf disini.."><?=set_value('teks')?></textarea>
		<a class="remove btn btn-danger mt-2 text-white">Hapus</a>
	</div>
</div>
</section>
