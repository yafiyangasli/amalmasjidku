<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Daftar sebagai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
          <a href="<?= base_url('auth/register/1');?>" class="text-decoration-none col-4 col-md-4 mx-2 my-4">
            <img src="<?=base_url('assets/image/daftar-donate.png');?>" class="gambar-kategori-home img-fluid rounded" style="max-height: 300px">
            <p class="text-center" style="color:#5d6056; font-weight: bold; font-size: 18px">Donatur</p>
          </a>
          <a href="<?= base_url('auth/register/2');?>" class="text-decoration-none col-4 col-md-4 mx-2 my-4">
            <img src="<?=base_url('assets/image/daftar-campaign.png');?>" class="gambar-kategori-home img-fluid rounded" style="max-height: 300px">
            <p class="text-center" style="color:#5d6056; font-weight: bold; font-size: 18px">Pembuat Campaign</p>
          </a>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->

      <footer class="footer text-white pr-5 pl-5 pt-4 pb-1" style="background-color: #354d4b; color: #cadac9;">
        <div class="container">
          <div class="row mb-3">
            <div class="col-md-4 mb-3">
              <h5 style="font-size: 16px">Amal Masjidku</h5>
              <p class="text-light" style="font-size: 15px;">Sebuah Gerakan dari Aksi Cepat Tanggap untuk Menghadirkan Kedermawanan Melalui Sedekah, Zakat, Wakaf dan Qurban. Mari Raih Keberkahan</p>
              <p class="text-light" style="font-size: 15px;">Alamat disini</p>
            </div>
            <div class="col-6 col-md-2">
             <h5 style="font-size: 16px">Tentang Kami</h5>
              <ul class="text-secondary pl-0" style="font-family: Montserrat-regular; font-size: 15px; list-style-type: none;">
                <li><a href="<?=base_url('tentang')?>" class="text-decoration-none" style="color: #cadac9;">Artikel Tentang Kami</a></li>
                <li><a href="<?=base_url('tentang/syarat')?>" class="text-decoration-none" style="color: #cadac9;">Syarat & Ketentuan</a></li>
              </ul>
            </div>
            <div class="col-6 col-md-2">
              <h5 style="font-size: 16px">Kategori</h5>
              <ul class="text-secondary pl-0" style="font-family: Montserrat-regular; font-size: 15px; list-style-type: none;">
                <li><a href="<?=base_url('category/pembangunan')?>" class="text-decoration-none" style="color: #cadac9;">Pembangunan</a></li>
                <li><a href="<?=base_url('category/renovasi')?>" class="text-decoration-none" style="color: #cadac9;">Renovasi</a></li>
                <li><a href="<?=base_url('category')?>" class="text-decoration-none" style="color: #cadac9;">Semua</a></li>
              </ul>
            </div>
            <div class="col-6 col-md-2">
              <h5 style="font-size: 16px">Pusat Bantuan</h5>
              <ul class="text-secondary pl-0" style="font-family: Montserrat-regular; font-size: 15px; list-style-type: none;">
                <li><a href="<?=base_url('bantuan/faq')?>" class="text-decoration-none" style="color: #cadac9;">FAQ</a></li>
                <li><a href="<?=base_url('bantuan/hubungi')?>" class="text-decoration-none" style="color: #cadac9;">Hubungi Kami</a></li>
              </ul>
            </div>
            <div class="col-6 col-md-2">
              <h5 style="font-size: 16px;">Temui kami di!</h5>
              <ul class="list-group list-group-horizontal" style="list-style-type: none;">
                <li class="pr-3"><a href="#WA" id="WA" class="text-decoration-none" data-toggle="tooltip" data-html="true" title="Whatsapp us at<br><strong>085808580858</strong>"><i class='bx bxl-whatsapp' style="font-size: 25px; color: #dfe4e3"></i></a></li>
                <li class="pr-3"><i class='bx bxl-instagram' style="font-size: 25px; color: #dfe4e3"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row no-gutters">
        <div class="col-12">
          <hr style="border-width: 2px; border-color: black; opacity: 50%;">
          <p style="text-align: center;">Copyright </p>
        </div>
        </div>
      </footer>
      <!-- end of footer -->
<script type="text/javascript">
  $(document).ready(function(){
       $('[data-toggle="tooltip"]').tooltip();   
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8f37dd1c37.js" crossorigin="anonymous"></script>
</body>
</html>