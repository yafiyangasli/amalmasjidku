<section class="home-section">
<div class="text">Akun Masjid</div>
<div class="container-fluid">
	<button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModalScrollable">Ajukan Campaign</button>
	<div class="col-10 col-md-5 mt-3">
	<?= $this->session->flashdata('message');?>
	</div>
    <div class="table-responsive-md mt-3">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Penanggung Jawab</th>
          <th scope="col">Kategori</th>
          <th scope="col">Durasi</th>
          <th scope="col">Status</th>
          <th scope="col">Detail</th>

        </tr>
      </thead>
      <tbody>
      	<?php $i=1;?>
		<?php foreach ($pengajuan as $pj) :?>
        <tr>
          <th scope="row"><?=$i?></th>
          <td><?=$pj['nama_pj'];?></td>
          <td><?=$pj['kategori'];?></td>
          <td><?=$pj['durasi'];?> Bulan</td>
          <td><?=$pj['status'];?></td>
          <td><a href="<?=base_url('user/detailPengajuan/').$pj['id_pengajuan'];?>" class="btn btn-info">Lihat</a> 
          	<?php if($pj['status'] == "Ditolak"):?>
          		<a href="<?=base_url('user/editPengajuan/').$pj['id_pengajuan'];?>" class="btn btn-warning">Edit</a>
          	<?php endif;?>
          </td>
        </tr>
        <?php $i++;?>
		<?php endforeach?>
      </tbody>
    </table>
    </div>
      <?= $this->pagination->create_links();?>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Pengajuan Campaign</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="my-3" method="post" enctype="multipart/form-data">
		        <div class="form-group">
		            <label for="name">Nama Penanggung Jawab</label>
		            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama..." value="">
				    <?=form_error('name','<small class="text-danger pl-1">','</small>');?>
			    </div>
			    <div class="form-group">
		            <label for="nip">NIP Penanggung Jawab</label>
		            <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP..." value="">
				    <?=form_error('nip','<small class="text-danger pl-1">','</small>');?>
			    </div>
			    <div class="form-group">
			    	<label>KTP Penanggung Jawab</label>
				    <div class="custom-file mb-3">
			            <input type="file" class="custom-file-input" id="image1" name="image1">
			            <label class="custom-file-label" for="image1">Foto KTP</label>
			          </div>
			    </div>
			    <div class="form-group">
			    	<label>Gambar Masjid</label>
				    <div class="custom-file mb-3">
			            <input type="file" class="custom-file-input" id="image2" name="image2">
			            <label class="custom-file-label" for="image2">Gambar Masjid 1</label>
			          </div>
			          <div class="custom-file mb-3">
			            <input type="file" class="custom-file-input" id="image3" name="image3">
			            <label class="custom-file-label" for="image3">Gambar Masjid 2</label>
			          </div>
			          <div class="custom-file mb-3">
			            <input type="file" class="custom-file-input" id="image4" name="image4">
			            <label class="custom-file-label" for="image4">Gambar Masjid 3</label>
			          </div>
			    </div>
		       	<div class="form-group">
		            <label for="address">Alamat Penanggung Jawab</label>
		            <textarea class="form-control" id="address" name="address" rows="3"></textarea>
		            <?=form_error('address','<small class="text-danger pl-1">','</small>');?>
		        </div>
		        <div class="form-group">
				    <label for="kategori">Kategori</label>
				    <select class="form-control" id="kategori" name="kategori">
				      <option>Pilih Kategori</option>
				      <option value="pembangunan">Pembangunan</option>
				      <option value="renovasi">Renovasi</option>
				    </select>
				  </div>
			    <div class="form-group">
			        <label for="durasi">Durasi</label>
		            <select class="form-control" id="durasi" name="durasi">
				      <option>Pilih Durasi</option>
				      <option value="1">1 bulan</option>
				      <option value="2">2 bulan</option>
				      <option value="3">3 bulan</option>
				    </select>
		            <?=form_error('durasi','<small class="text-danger pl-1">','</small>');?> 
		        </div>
		        <div class="form-group">
		            <label for="proposal">Form Proposal</label>
		            <label><a href="" style="font-size: 12px">download form proposal disini</a></label>
		            <div class="custom-file">
			            <input type="file" class="custom-file-input" id="image5" name="image5">
			            <label class="custom-file-label" for="image5">Upload Proposal</label>
			        </div>
			        <label style="font-size: 10px; color: red; padding-top: 0">*upload proposal harus dalam bentuk pdf</label>
			    </div>
		        <div class="row justify-content-center">
		            <button type="submit" class="btn btn-warning col-10 col-md-4 my-2 my-md-4 mx-md-2">Ajukan</button>
		        </div>
		    </form>
      </div>
    </div>
  </div>
</div>