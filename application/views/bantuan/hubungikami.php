<div class="container my-5" style="min-height: calc(100vh - 40px);">
	<h1 class="text-center">Hubungi Kami</h1>
	<div class="col-10 offset-1 col-md-8 offset-md-2 mt-5">
		<div style="max-width: 90%; height: auto; margin-left: auto; margin-right: auto; margin-top: 5%; display: block; font-size: 15px;">
			<div class="row no-gutters mt-3 mb-5">
		      <div class="col-12 col-md-10 offset-0 offset-md-1">
		        <div class="container-fluid" style="border-style: solid; border-width: 1.5px; background-color: white; border-radius: 5px;">
		          <h3 class="text-center my-4">Kirim email secara langsung</h3>
		          <form class="mb-3 px-4" method="post" action="">
		          <?= $this->session->flashdata('message');?>
		            <div class="form-group">
		              <label for="email">Email</label>
		              <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email..." value="<?=set_value('email');?>">
		              <?=form_error('email','<small class="text-danger pl-1">','</small>');?>
		            </div>
		            <div class="form-group">
		              <label for="nama">Nama</label>
		              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama..." value="<?=set_value('nama');?>">
		              <?=form_error('nama','<small class="text-danger pl-1">','</small>');?>
		            </div>
		            <div class="form-group">
		              <label for="subjek">Subjek</label>
		              <input type="text" class="form-control" id="subjek" name="subjek" placeholder="Subjek email..." value="<?=set_value('subjek');?>">
		              <?=form_error('subjek','<small class="text-danger pl-1">','</small>');?>
		            </div>
		            <div class="form-group">
		              <label for="pesan">Pesan</label>
		              <textarea class="form-control" id="pesan" name="pesan" rows="3"><?=set_value('pesan');?></textarea>
		              <?=form_error('pesan','<small class="text-danger pl-1">','</small>');?>
		            </div>
		            
		            <button type="submit" class="btn btn-warning col-6 col-sm-2 offset-3 offset-sm-5 my-4">Kirim</button>
		            
		          </form>
		        </div>
		      </div>
		    </div>
		</div>
	</div>
</div>