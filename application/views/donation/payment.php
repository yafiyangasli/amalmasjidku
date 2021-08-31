<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/payment.css');?>">
<div class="container my-5" style="min-height: calc(100vh - 40px);">
	<h1 class="text-center">Input Donasimu</h1>
	<div class="col-12 offset-0 col-sm-10 col-md-8 offset-md-2 my-5">
		<form method="POST" action="">
			<div class="row no-gutters">
				<div class="col-12 col-md-6 order-2 order-md-1 offset-0 offset-md-0">
				  <div class="form-group">
				    <label for="donasi">Nominal donasi</label>
				    <div class="input-group mb-2">
				    	<div class="input-group-prepend">
				          <div class="input-group-text">Rp</div>
				        </div>
				      	<input type="text" class="form-control" id="donasi" name="donasi" placeholder="Masukkan nominal donasimu...">
				    </div>
              		<?=form_error('donasi','<small class="text-danger pl-1">','</small>');?>
				  </div>
				  <div class="form-group">
				    <label for="nama">Nama</label>
				    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan namamu..." value="<?=$this->session->userdata('nama');?>">
				  </div>
				  <div class="form-group">
				    <div class="form-check">
				      <input class="form-check-input" type="checkbox" id="namacheck" name="namacheck" onclick="anonim()">
				      <label class="form-check-label" for="namacheck">
				        Input sebagai anonim
				      </label>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputAddress2">No. Telepon</label>
				    <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Masukkan nomor telepon disini..." value="<?=$user['telephone']?>">
              		<?=form_error('telephone','<small class="text-danger pl-1">','</small>');?>
				    <label style="font-size: 12px" class="text-secondary">*sesuaikan nomor telepon dengan nomor yang digunakan untuk berdonasi</label>
				  </div>
				  <div class="form-group">
			      	<label for="address">Pesan</label>
			        <textarea class="form-control" id="pesan" name="pesan" rows="3"></textarea>
			      </div>
				</div>
				<div class="col-12 col-md-5 order-1 order-md-2 offset-0 offset-md-1 mb-5">
					<h4 class="text-center mb-2">Kamu berdonasi untuk</h4>
					<h5 class="text-center"><?=$campaign['masjid'];?></h5>
					<img src="<?=base_url('assets/image/pengajuan/').$pengajuan['foto_masjid1'];?>" class="img-fluid" style="max-width: 300px; height: auto;">
					<label class="pb-0 mb-0 mt-4">Sudah terkumpul</label>
					<label style="font-size: 15px;"><?=rupiah($campaign['donasi_terkumpul']);?> <span style="font-size: 12px; color: #7a7e71">dari <?=rupiah($campaign['donasi_total']);?></span></label>
					<div class="progress">
						<div class="progress-bar bg-success" aria-valuenow="<?=progressbar($campaign['donasi_terkumpul'],$campaign['donasi_total']);?>" style="width: <?=progressbar($campaign['donasi_terkumpul'],$campaign['donasi_total']);?>%;" role="progressbar" aria-valuemin="0" aria-valuemax="100"><?=progressbar($campaign['donasi_terkumpul'],$campaign['donasi_total']);?>%</div>
					</div>
					<label style="font-size: 15px;">Total <?=$donatur;?> donatur</label>
				</div>
			</div>
	      <label>Pilih Pembayaranmu</label>
	      <div class="accordion mb-3" id="accordionExample">
			  <div class="card">
			    <div class="card-header" id="headingOne">
			      <h2 class="mb-0">
			        <button class="btn btn-link text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color:#5d6056;">
			          Pembayaran Cepat (Via QR Code)
			        </button>
			      </h2>
			    </div>
			    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
			      <div class="card-body">
			        <label>
					  <input type="radio" value="QR BCA" name="pembayaran" id="pembayaran" onclick="getPembayaran(this.value)">
					  <img src="<?=base_url('assets/image/logo/bca.png');?>" class="mx-auto" style="max-width: 200px; height: auto;">
					</label>
					<label>
					  <input type="radio" name="pembayaran" id="pembayaran" value="QR Dana" onclick="getPembayaran(this.value)">
					  <img src="<?=base_url('assets/image/logo/dana.png');?>" class="mx-auto" style="max-width: 200px; height: auto;">
					</label>
					<label>
					  <input type="radio" name="pembayaran" id="pembayaran" value="QR Gopay" onclick="getPembayaran(this.value)">
					  <img src="<?=base_url('assets/image/logo/gopay.png');?>" class="mx-auto" style="max-width: 200px; height: auto;">
					</label>
					<label>
					  <input type="radio" name="pembayaran" id="pembayaran" value="QR BIDR" onclick="getPembayaran(this.value)">
					  <img src="<?=base_url('assets/image/logo/BIDR.png');?>" class="mx-auto" style="max-width: 200px; height: auto;">
					</label>
			      </div>
			    </div>
			  </div>
			  <div class="card">
			    <div class="card-header" id="headingTwo">
			      <h2 class="mb-0">
			        <button class="btn btn-link collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color:#5d6056;">
			          Transfer Bank
			        </button>
			      </h2>
			    </div>
			    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
			      <div class="card-body">
			        <label>
					  <input type="radio" value="Transfer Bank BRI" name="pembayaran" id="pembayaran" onclick="getPembayaran(this.value)">
					  <img src="<?=base_url('assets/image/logo/bri.png');?>" class="mx-auto" style="max-width: 200px; height: auto;">
					</label>
					<label>
					  <input type="radio" name="pembayaran" id="pembayaran" value="Transfer Bank BCA" onclick="getPembayaran(this.value)">
					  <img src="<?=base_url('assets/image/logo/bca.png');?>" class="mx-auto" style="max-width: 200px; height: auto;">
					</label>
					<label>
					  <input type="radio" name="pembayaran" id="pembayaran" value="Transfer Bank BTPN" onclick="getPembayaran(this.value)">
					  <img src="<?=base_url('assets/image/logo/btpn.png');?>" class="mx-auto" style="max-width: 200px; height: auto;">
					</label>
			      </div>
			    </div>
			  </div>
			  <div class="card">
			    <div class="card-header" id="headingThree">
			      <h2 class="mb-0">
			        <button class="btn btn-link collapsed text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="color:#5d6056;">
			          Virtual Akun
			        </button>
			      </h2>
			    </div>
			    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
			      <div class="card-body">
			        <label>
					  <input type="radio" value="Virtual Akun Permata" name="pembayaran" id="pembayaran" onclick="getPembayaran(this.value)">
					  <img src="<?=base_url('assets/image/logo/permata.png');?>" class="mx-auto" style="max-width: 200px; height: auto;">
					</label>
					<label>
					  <input type="radio" name="pembayaran" id="pembayaran" value="Virtual Akun Mandiri" onclick="getPembayaran(this.value)">
					  <img src="<?=base_url('assets/image/logo/mandiri.png');?>" class="mx-auto" style="max-width: 200px; height: auto;">
					</label>
			      </div>
			    </div>
			  </div>
			<?=form_error('pembayaran','<small class="text-danger pl-1">','</small>');?>
			</div>
			<p id="pembayarancek"></p>
		  <button type="submit" class="btn btn-success">Donasi</button>
		</form>
	</div>
</div>

<script>
function anonim() {
  var checkBox = document.getElementById("namacheck");
  var text = document.getElementById("nama");
  if (checkBox.checked == true){
    text.disabled = true;
  } else {
     text.disabled = false;
  }
}

function getPembayaran(val){
	var text2 = document.getElementById("pembayarancek");
    text2.innerHTML ="Pembayaran menggunakan " + val;
}
</script>