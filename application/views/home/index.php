<script>
  $(document).ready(function() {
    $('#autoWidth').lightSlider({
        autoWidth:true,
        loop:true,
        onSliderLoad: function() {
            $('#autoWidth').removeClass('cS-hidden');
        } 
    });  
    $('#content-slider').lightSlider({
        loop:true,
        keyPress:true,
        autoWidth:true
    });  
  });

       <?php if($this->session->userdata('newsletter')!=NULL):?>
          $("#modalNewsletter").modal("show");
        <?php $this->session->unset_userdata('newsletter');
        endif;?>
    </script>

<style type="text/css">
  input[type="email"]::-webkit-input-placeholder {
    font-size: 12px;
  }
</style>
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?=base_url('assets/image/carousel/carousel1.jpg');?>" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<?=base_url('assets/image/carousel/carousel2.jpg');?>" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<?=base_url('assets/image/carousel/carousel3.jpg');?>" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="container my-3" style=" background-color: #dbf8f6; border-radius: 5px;
  padding: 10px; min-height: calc(100vh - 40px);">
  <div class="session1 my-3">
    <h2 class="text-center" style="font-size: 3vw">Kamu mau donasi yang mana?</h2>
    <div class="row no-gutters mt-5 mb-3">
      <div class="col-3 col-md-2 offset-2 offset-md-3">
        <a href="<?=base_url('category/pembangunan');?>" class="text-decoration-none">
          <img src="<?=base_url('assets/image/pembangunan.jpeg');?>" class="gambar-kategori-home img-fluid rounded" style="max-height: 400px">
          <p class="text-center" style="color:#5d6056; font-weight: bold; font-size: 16px;">Pembangunan</p>
        </a>
      </div>
      <div class="col-3 col-md-2 offset-2 offset-md-2">
        <a href="<?=base_url('category/renovasi');?>" class="text-decoration-none">
          <img src="<?=base_url('assets/image/renovasi.jpeg');?>" class="gambar-kategori-home img-fluid rounded" style="max-height: 400px;">
          <p class="text-center" style="color:#5d6056; font-weight: bold; font-size: 16px">Renovasi</p>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="container my-3 bg-warning" style=" border-radius: 5px; padding: 10px;">
<div class="session2 my-3">
    <h2 class="text-center" style=" font-size: 25px">Campaign terbaru buat mu</h2>
    <div class="row justify-content-center no-gutters">
      <ul id="autoWidth" class="cS-hidden">
        <?php foreach($campaign as $cp):?>
          <?php foreach($pengajuan as $pj){
            if ($cp['id_pengajuan'] == $pj['id_pengajuan']) {
              $foto = $pj['foto_masjid1'];
              $kategori = $pj['kategori'];
            }
          }?>
        <li class="item">
          <a href="<?=base_url('donation/detail/').$cp['id_campaign'];?>" class="text-decoration-none" style="color:#5d6056;">
              <div class="card m-3" style="width: 15rem;">
                <img src="<?=base_url('assets/image/pengajuan/').$foto;?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?=$cp['masjid']?></h5>
                  <h6 class="card-subtitle mb-4 text-muted"><?=$kategori?></h6>
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
        </li>
        <?php endforeach;?>
      </ul>
    </div>
  </div>
</div>

<div class="container my-3" style=" background-color: #dfe4e3; border-radius: 5px; padding: 10px;">
<div class="session2 my-3">
    <h2 class="text-center" style="font-size: 25px">Update Penyaluran Terbaru</h2>
      <div class="row justify-content-center no-gutters">
    <ul id="content-slider">
        
      <?php foreach($penyaluran as $py):
        $waktu=explode(" ", $py['waktu']);
        ?>
        <li class="item">
          <a href="<?=base_url('penyaluran/detail/').$py['id_penyaluran'];?>" class="text-decoration-none" style="color:#5d6056;">
            <div class="card m-3" style="width: 15rem; background-color: white">
              <img src="<?=base_url('assets/image/penyaluran/').$py['gambar'];?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title" style="font-size: 15px; margin-bottom: 30%"><?= $py['judul'];?></h5>
                <p class="card-text"><?= $waktu[1];?></p>
              </div>
            </div>
          </a>
        </li>
      <?php endforeach;?>
    </ul>
      </div>
  </div>
</div>

<div class="container my-3" style=" background-color: white; border-radius: 5px; padding: 10px;">
<div class="session2 my-3">
    <h2 class="text-center" style="font-size: 25px">Update Kegiatan Donasi</h2>
      <div class="row no-gutters text-center">
        <div class="col-3 col-md-2 offset-2 offset-md-3 mt-4">
          <h5>Donasi</h5>
          <p style="font-size: 25px"><?=$total['totaldonatur'];?></p>
        </div>
        <div class="col-3 col-md-2 offset-2 offset-md-2 mt-4">
          <h5>Campaign</h5>
          <p style="font-size: 25px"><?=$total['totalcampaign']?></p>
        </div>
      </div>
  </div>
  <div class="session2 my-3" style="background-color: #689163;">
      <div class="row no-gutters">
        <div class="col-10 col-md-4 offset-1 offset-md-1 mt-4">
          <h5>Selalu terhubung dengan kami</h5>
          <p style="font-size: 15px">Update Kegiatan Terbaru Kami Dengan Berlangganan Newsletter Kami!</p>
        </div>
        <div class="col-10 col-md-4 offset-1 offset-md-2 mt-0 mt-md-4">
          <form class="form-inline mt-0 mt-md-4" method="post" action="<?=base_url('home/inputNewsletter');?>">
            <div class="form-group mx-sm-2 mb-2">
              <label for="newsletter" class="sr-only">Password</label>
              <input type="email" class="form-control" id="newsletter" name="newsletter" placeholder="Masukkan emailmu disini">
            </div>
            <button type="submit" class="btn btn-outline-info mb-2">Subscribe</button>
          </form>
        </div>
      </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalNewsletter" role="dialog" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNewsletterTitle">Terima Kasih!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Terima kasih telah berlangganan dengan kami, update selalu berita donasi kami melalui email kamu!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
