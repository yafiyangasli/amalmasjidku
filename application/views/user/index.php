<?php if($this->session->userdata('role_id')==1):?>
<section class="home-section">
    <div class="text">Dashboard</div>
    <div class="container-fluid">
    <div class="row no-gutters">
      <div class="col-10 col-md-2 offset-1 offset-md-6 mt-3" style="background-color: white; border-radius: 5px; padding: 8px; border: 1px solid grey;">
        <div class="row no-gutters">
          <div class="col-7 col-md-6" >
            <h3><strong><?=$totaldonasi;?></strong></h3>
            <label>Donasi</label>
          </div>
          <div class="col-5 col-md-6">
            <div style="font-size: 58px; float: right;"><i class='bx bx-gift' ></i></div>
          </div>
        </div>
      </div>
      <div class="col-10 col-md-4 offset-1 offset-md-0 mt-3 pl-md-3" >
        <div class="row no-gutters" style="background-color: white; border-radius: 5px; padding:8px; border: 1px solid grey;">
          <div class="col-7">
            <h3><strong><?=rupiah($nominaltotal);?></strong></h3>
            <label>Total nominal donasi</label>
          </div>
          <div class="col-5">
            <div  style="font-size: 58px; float: right;"><i class='bx bx-money'></i></div>
          </div>
        </div>
      </div>
    </div>
    <h5 class="mt-5 text-center"><bold>Donasimu 30 hari terkahir</bold></h5>
    <div class="row no-gutters mt-5">
      <div class="col-12">
        <canvas id="linechart1" width="80" height="20"></canvas>
      </div>
    </div>
    </div>
  </section>

<script type="text/javascript">
  var ctx = document.getElementById("linechart1").getContext("2d");
  var mychart = new Chart(ctx, {
      type: 'line',
  data: {
    labels: [<?php foreach ($grafik as $gf):?>
      "<?= $gf['tanggal'];?>",
    <?php endforeach;?>],
    datasets: [{
      label : "Donasi",
        backgroundColor : "#f8b34b",
        data : [
        <?php foreach($grafik as $gf):?>
      "<?= $gf['donasi'];?>",
    <?php 
    endforeach;?>
    ]
    }]
  },
  options: {
    scales: {
      xAxes: [{
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
      yAxes: [{
        ticks: {
          min :0,
          max :<?=$terbesar?>
        },
        gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }  
      }]
    }
  }
  });

  </script>

<?php elseif($this->session->userdata('role_id')==2):?>
<section class="home-section">
    <div class="text">Dashboard</div>
    <div class="container-fluid">
    <div class="row no-gutters">
      <div class="col-10 col-md-3 offset-1 mx-auto mt-2" style="background-color: white; border-radius: 5px; padding: 8px; border: 1px solid grey;">
        <div class="row no-gutters">
          <div class="col-10 col-md-6">
            <h2><strong><?=$berjalan;?></strong></h2>
            <label>Campaign berjalan</label>
          </div>
          <div class="col-2 col-md-6">
            <div  style="font-size: 48px; float: right;"><i class='bx bx-user-voice'></i></div>
          </div>
        </div>
      </div>
      <div class="col-10 col-md-3 offset-1 offset-md-0 mx-auto mt-2" style="background-color: white; border-radius: 5px; padding: 8px; border: 1px solid grey;">
        <div class="row no-gutters">
          <div class="col-10 col-md-6" >
            <h2><strong><?=$totalcampaign;?></strong></h2>
            <label>Total Campaign</label>
          </div>
          <div class="col-2 col-md-6">
            <div  style="font-size: 48px; float: right;"><i class='bx bx-user-voice'></i></div>
          </div>
        </div>
      </div>
      <div class="col-10 col-md-4 offset-1 offset-md-0 mx-auto mt-2" style="background-color: white; border-radius: 5px; padding: 8px; border: 1px solid grey;">
        <div class="row no-gutters">
          <div class="col-10">
            <h2><strong><?=rupiah($nominaltotal);?></strong></h2>
            <label>Total nominal donasi</label>
          </div>
          <div class="col-2">
            <div  style="font-size: 48px; float: right"><i class='bx bx-money'></i></div>
          </div>
        </div>
      </div>
    </div>
    <h5 class="mt-5 text-center"><bold>Donaturmu 30 hari terkahir</bold></h5>
    <div class="row no-gutters mt-5">
      <div class="col-12">
        <canvas id="linechart1" width="80" height="20"></canvas>
      </div>
    </div>
    </div>
  </section>

<script type="text/javascript">
  var ctx = document.getElementById("linechart1").getContext("2d");
  var mychart = new Chart(ctx, {
      type: 'line',
  data: {
    labels: [<?php foreach ($grafik as $gf):?>
      "<?= $gf['tanggal'];?>",
    <?php endforeach;?>],
    datasets: [{
      label : "Donasi",
        backgroundColor : "#f8b34b",
        data : [
        <?php foreach($grafik as $gf):?>
      "<?= $gf['donasi'];?>",
    <?php 
    endforeach;?>
    ]
    }]
  },
  options: {
    scales: {
      xAxes: [{
            gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }
        }],
      yAxes: [{
        ticks: {
          min :0,
          max :<?=$terbesar?>
        },
        gridLines: {
                color: "rgba(0, 0, 0, 0)",
            }  
      }]
    }
  }
  });
</script>
<?php endif;?>