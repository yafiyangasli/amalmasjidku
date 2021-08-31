<script>
       $(document).ready(function() {
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:4,
                slideMargin: 1,
                speed:1000,
                auto:true,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
    });
    </script>

<div class="container" style="min-height: calc(100vh - 40px);">
	<div class="row no-gutters my-5">
		<div class="col-10 col-md-6 offset-1 offset-md-0" style="background-color: white; border-radius: 5px; padding: 15px; border: solid; border-width: 1px; border-color: #c1c1c1">
			<img src="<?=base_url('assets/image/pengajuan/').$pengajuan['foto_masjid1'];?>" class="img-fluid rounded" style="max-height: 600px">
			<label class="mt-3">Bagikan ke temanmu!</label>
			<ul class="list-group list-group-horizontal" style="list-style-type: none;">
              <li class="pr-2"><a href="" target="" id="facebook" class="text-decoration-none"><i class='bx bxl-facebook-square' style="font-size: 36px; color: #4267B2"></i></a></li>
              <li class="pr-2"><a href="" target="" class="text-decoration-none"><i class='bx bxl-twitter' style="font-size: 36px; color: #1DA1F2"></i></a></li>
              <li class="pr-2 "><a href="" class="text-decoration-none" target=""><i class='bx bxl-whatsapp' style="color: #25D366 ;font-size: 36px"></i></a></li>
              <li class="pr-3"><button href="#" id="link" class="btn btn-default btn-copy js-tooltip js-copy p-0" data-toggle="tooltip" data-placement="bottom" data-copy="<?=base_url('donation/detail/').$campaign['id_campaign'];?>" title="Copy link halaman ini"><i class='bx bx-link-alt' style="font-size: 36px; color: grey"></i></li>
            </ul>
		</div>
		<div class="col-10 col-md-5 offset-1 offset-md-1 mt-3 mt-md-0">
			<h1><?=$campaign['masjid'];?></h1>
			<h5 class="text-secondary"><?=$pengajuan['kategori'];?></h5>
			<div class="row">
				<h6 class="col-4 col-md-5 col-lg-3 text-secondary"><?=$campaign['tanggal'];?></h6>
				<h6 class="col-4 col-md-5 col-lg-4 text-secondary"><i class="fas fa-fw fa-map-marker-alt"></i>Lampung</h6>
			</div>
			<label>Sudah terkumpul <?=rupiah($campaign['donasi_terkumpul']);?> dari <?=rupiah($campaign['donasi_total']);?></label>
			<div class="progress">
				<div class="progress-bar bg-success" aria-valuenow="<?=progressbar($campaign['donasi_terkumpul'],$campaign['donasi_total']);?>" style="width: <?=progressbar($campaign['donasi_terkumpul'],$campaign['donasi_total']);?>%;" role="progressbar" aria-valuemin="0" aria-valuemax="100"><?=progressbar($campaign['donasi_terkumpul'],$campaign['donasi_total']);?>%</div>
			</div>
			<p id="timer"></p>
		<?= $this->session->flashdata('message');?>
			<a href="<?=base_url('donation/payment/').$campaign['id_campaign'];?>" class="btn btn-outline-warning col-6 offset-3">Donasi Sekarang</a>
		</div>
	</div>
	<div class="row no-gutters mb-4">
		<div class="col-10 offset-1 col-md-7 offset-md-0" style=" background-color: white; border-radius: 5px; padding: 15px;">
			<h3 class="mb-3">Deskripsi</h3>
      <div class="item mb-3">            
            <div class="clearfix" style="max-width:474px;">
                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                  <?php if($campaign['gambar1']!=""):?>
                    <li data-thumb="<?=base_url('assets/image/deskripsicampaign/').$campaign['gambar1'];?>"> 
                        <img src="<?=base_url('assets/image/deskripsicampaign/').$campaign['gambar1'];?>" class="img-fluid" style="max-width: 90%; height: auto; border-radius: 5px; margin-left: auto; margin-right: auto; display: block;" />
                    </li>
                  <?php endif;?>
                  <?php if($campaign['gambar2']!=""):?>
                    <li data-thumb="<?=base_url('assets/image/deskripsicampaign/').$campaign['gambar2'];?>"> 
                        <img src="<?=base_url('assets/image/deskripsicampaign/').$campaign['gambar2'];?>" class="img-fluid" style="max-width: 90%; height: auto; border-radius: 5px; margin-left: auto; margin-right: auto; display: block;"/>
                    </li>
                  <?php endif;?>
                  <?php if($campaign['gambar3']!=""):?>
                    <li data-thumb="<?=base_url('assets/image/deskripsicampaign/').$campaign['gambar3'];?>"> 
                        <img src="<?=base_url('assets/image/deskripsicampaign/').$campaign['gambar3'];?>" class="img-fluid" style="max-width: 90%; height: auto; border-radius: 5px; margin-left: auto; margin-right: auto; display: block;"/>
                    </li>
                  <?php endif;?>
                  <?php if($campaign['gambar4']!=""):?>
                    <li data-thumb="<?=base_url('assets/image/deskripsicampaign/').$campaign['gambar4'];?>"> 
                        <img src="<?=base_url('assets/image/deskripsicampaign/').$campaign['gambar4'];?>" class="img-fluid" style="max-width: 90%; height: auto; border-radius: 5px; margin-left: auto; margin-right: auto; display: block;"/>
                    </li>
                  <?php endif;?>
                </ul>
            </div>
        </div>
			<?=$campaign['deskripsi'];?>
		</div>
		<div class="col-10 offset-1 col-md-4 offset-md-1 mt-2 mt-md-0" style=" background-color: #dfe4e3; border-radius: 5px; padding: 15px;">
			<h3>Donatur</h3>
			<ul class="list-group">
			<?php foreach($donatur as $dt):?>
			  <li class="list-group-item"><?=$dt['nama'];?>
			  	<div class="mb-2" style="font-size: 10px"><?=$dt['tanggal'];?></div>
			  	<div style="font-size: 15px"><?=rupiah($dt['nominal']);?></div>
			  	<div style="font-size: 15px"><?=$dt['pesan'];?></div>
			  </li>
			<?php endforeach?>
			</ul>
		</div>
	</div>
	<a href="<?=base_url('category');?>" class="btn btn-info col-6 col-md-2 px-0 offset-3 offset-md-5 mb-5">Kembali ke menu donasi</a>
</div>

<script>

function copyToClipboard(text, el) {
  var copyTest = document.queryCommandSupported('copy');
  var elOriginalText = el.attr('data-original-title');

  if (copyTest === true) {
    var copyTextArea = document.createElement("textarea");
    copyTextArea.value = text;
    document.body.appendChild(copyTextArea);
    copyTextArea.select();
    try {
      var successful = document.execCommand('copy');
      var msg = successful ? 'Copied!' : 'Whoops, not copied!';
      el.attr('data-original-title', msg).tooltip('show');
    } catch (err) {
      console.log('Oops, unable to copy');
    }
    document.body.removeChild(copyTextArea);
    el.attr('data-original-title', elOriginalText);
  } else {
    // Fallback if browser doesn't support .execCommand('copy')
    window.prompt("Copy to clipboard: Ctrl+C or Command+C, Enter", text);
  }
}

$(document).ready(function() {
  // Initialize
  // ---------------------------------------------------------------------

  // Tooltips
  // Requires Bootstrap 3 for functionality
  $('.js-tooltip').tooltip();

  // Copy to clipboard
  // Grab any text in the attribute 'data-copy' and pass it to the 
  // copy function
  $('.js-copy').click(function() {
    var text = $(this).attr('data-copy');
    var el = $(this);
    copyToClipboard(text, el);
  });
});
  
// Set the date we're counting down to
var countDownDate = new Date("<?= $campaign['deadline'];?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));

  // Display the result in the element with id="demo"
  document.getElementById("timer").innerHTML = "Tersisa " + days + " hari";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("timer").innerHTML = "EXPIRED";
  }
}, 1000);

	$('.custom-file-input').on('change', function() {
      let fileName = $(this).val().split('\\').pop();
      $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>