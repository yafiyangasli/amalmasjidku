<div class="container" style="min-height: calc(100vh - 40px);">
    
    <div class="row no-gutters mt-5">
      <div class="col-12 col-md-6 offset-md-3 w3-animate-left">
        <h1 class="text-center mb-5" id="header" style="">Masuk</h1>
      </div>
    </div>

    <div class="row no-gutters mt-1 mb-5">
      <div class="col-10 col-md-6 offset-1 offset-md-3 w3-animate-left">
        <div class="container-fluid" style="border-width: 1.5px; background-color: white; border-radius: 5px;">
          <form class="my-3 px-5 pt-5" method="post" action="">
          <?= $this->session->flashdata('message');?>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email..." value="<?=set_value('email');?>">
              <?=form_error('email','<small class="text-danger pl-1">','</small>');?>
            </div>
            <div class="form-group">
              <label for="nama">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password..." value="<?=set_value('password');?>">
              <?=form_error('password','<small class="text-danger pl-1">','</small>');?>
            </div>
            <div class="row justify-content-center">
              <button type="submit" class="btn btn-outline-info col-10 col-md-4 my-2 my-md-4 mx-md-2">Masuk</button>
              <a href="" class="btn btn-warning col-10 col-md-4 mt-2 mb-4 my-md-4 mx-md-2" data-toggle="modal" data-target="#exampleModalCenter">Daftar</a>
            </div>
            
          </form>
        </div>
      </div>
    </div>

  </div>