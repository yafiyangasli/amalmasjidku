<div class="container" style="min-height: calc(100vh - 40px);">
    
    <div class="row no-gutters mt-5">
      <div class="col-12 col-md-6 offset-md-3 w3-animate-left">
        <h2 class="text-center mb-5" id="header" style="">Register sebagai <?=$user_id;?></h2>
      </div>
    </div>

    <?php if($user_id == "Donatur") :?>
    <div class="row no-gutters mt-1 mb-5">
      <div class="col-10 col-md-6 offset-1 offset-md-3">
        <div class="container-fluid" style="border-width: 1.5px; background-color: white; border-radius: 5px;">
          <form class="my-3 px-5 pt-5" method="post" action="">
          <?= $this->session->flashdata('message');?>
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama..." value="<?=set_value('name');?>">
              <?=form_error('name','<small class="text-danger pl-1">','</small>');?>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email..." value="<?=set_value('email');?>">
              <?=form_error('email','<small class="text-danger pl-1">','</small>');?>
            </div>
            <div class="form-group">
              <label for="telephone">Telepon</label>
              <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Masukkan nomor telepon..." value="<?=set_value('telephone');?>">
              <?=form_error('telephone','<small class="text-danger pl-1">','</small>');?>
            </div>
            <div class="form-group">
              <label for="password1">Password</label>
              <input type="password" class="form-control" id="password1" name="password1" placeholder="Masukkan password...">
              <?=form_error('password1','<small class="text-danger pl-1">','</small>');?>
            </div>
            <div class="form-group">
              <label for="password2">Konfirmasi Password</label>
              <input type="password" class="form-control" id="password2" name="password2" placeholder="Konfirmasi password...">
              <?=form_error('password2','<small class="text-danger pl-1">','</small>');?>
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
              <label class="form-check-label" for="exampleCheck1">Saya setuju dengan kebijakan pengguna</label>
            </div>
            <div class="row justify-content-center">
              <button type="submit" class="btn btn-outline-info col-10 col-md-4 my-2 my-md-4 mx-md-2">Daftar</button>
            </div>
            
          </form>
        </div>
      </div>
    </div>

    <?php else:?>
    <div class="row no-gutters mt-1 mb-5">
      <div class="col-10 col-md-6 offset-1 offset-md-3">
        <div class="container-fluid" style="border-width: 1.5px; background-color: white; border-radius: 5px;">
          <form class="my-3 px-5 pt-5" method="post" action="">
          <?= $this->session->flashdata('message');?>
            <div class="form-group">
              <label for="name">Nama Masjid</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama..." value="<?=set_value('name');?>">
              <?=form_error('name','<small class="text-danger pl-1">','</small>');?>
            </div>
            <div class="form-group">
              <label for="email">Email Khusus Masjid</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email..." value="<?=set_value('email');?>">
              <?=form_error('email','<small class="text-danger pl-1">','</small>');?>
            </div>
            <div class="form-group">
              <label for="telephone">Telepon</label>
              <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Masukkan nomor telepon..." value="<?=set_value('telephone');?>">
              <?=form_error('telephone','<small class="text-danger pl-1">','</small>');?>
            </div>
            <div class="form-group">
              <label for="password1">Password</label>
              <input type="password" class="form-control" id="password1" name="password1" placeholder="Masukkan password...">
              <?=form_error('password1','<small class="text-danger pl-1">','</small>');?>
            </div>
            <div class="form-group">
              <label for="password2">Konfirmasi Password</label>
              <input type="password" class="form-control" id="password2" name="password2" placeholder="Konfirmasi password...">
              <?=form_error('password2','<small class="text-danger pl-1">','</small>');?>
            </div>
             <div class="form-group">
                <label for="address">Alamat Masjid</label>
                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                <?=form_error('address','<small class="text-danger pl-1">','</small>');?>
              </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
              <label class="form-check-label" for="exampleCheck1">Saya setuju dengan kebijakan pengguna</label>
            </div>
            <div class="row justify-content-center">
              <button type="submit" class="btn btn-outline-info col-10 col-md-4 my-2 my-md-4 mx-md-2">Daftar</button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  <?php endif;?>

  </div>