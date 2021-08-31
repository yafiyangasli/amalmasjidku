<?php if($this->session->userdata('role_id')==1):?>
<section class="home-section">
    <div class="text">Akun</div>
<div class="container-fluid">
	<div class="col-10 col-md-5">
		<form class="my-3" method="post" action="">
	          <?= $this->session->flashdata('message');?>
	            <div class="form-group">
	              <label for="name">Nama</label>
	              <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama..." value="<?=$user['nama'];?>">
	              <?=form_error('name','<small class="text-danger pl-1">','</small>');?>
	            </div>
	            <div class="form-group">
	              <label for="email">Email</label>
	              <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email..." value="<?=$user['email'];?>" disabled>
	            </div>
	            <div class="form-group">
	              <label for="telephone">Telepon</label>
	              <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Masukkan nomor telepon..." value="<?=$user['telephone'];?>">
	              <?=form_error('email','<small class="text-danger pl-1">','</small>');?>
	            </div>
	            <div class="form-group">
	              <label for="address">Alamat</label>
	              <textarea class="form-control" id="address" name="address" rows="3"><?=$user['alamat'];?></textarea>
	              <?=form_error('address','<small class="text-danger pl-1">','</small>');?>
	            </div>
	            <div class="row justify-content-center">
	              <button type="submit" class="btn btn-outline-warning col-10 col-md-4 my-2 my-md-4 mx-md-2">Edit</button>
	            </div>
	          </form>
		
	</div>
</div>
</section>
<?php elseif($this->session->userdata('role_id')==2):?>
	<section class="home-section">
    <div class="text">Akun Masjid</div>
	<div class="container-fluid">
		<div class="col-10 col-md-5">
			<form class="my-3" method="post" action="">
		        <?= $this->session->flashdata('message');?>
		        <div class="form-group">
		            <label for="name">Nama</label>
		            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama..." value="<?=$user['nama'];?>">
			        <?=form_error('name','<small class="text-danger pl-1">','</small>');?>
			    </div>
			    <div class="form-group">
			        <label for="email">Email</label>
		            <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email..." value="<?=$user['email'];?>" disabled>
		        </div>
		        <div class="form-group">
		            <label for="telephone">Telepon</label>
		            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Masukkan nomor telepon..." value="<?=$user['telephone'];?>">
			 		<?=form_error('email','<small class="text-danger pl-1">','</small>');?>
			    </div>
		       	<div class="form-group">
		            <label for="address">Alamat</label>
		            <textarea class="form-control" id="address" name="address" rows="3"><?=$user['alamat'];?></textarea>
		            <?=form_error('address','<small class="text-danger pl-1">','</small>');?>
		        </div>
		        <div class="row justify-content-center">
		            <button type="submit" class="btn btn-outline-warning col-10 col-md-4 my-2 my-md-4 mx-md-2">Edit</button>
		        </div>
		    </form>
		</div>
	</div>
	</div>
	</section>
<?php endif;?>

