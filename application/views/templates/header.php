<!DOCTYPE html>
<html>
<head>
	<title></title>
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.css');?>">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/');?>css/lightslider.css">
<script src="<?=base_url('assets/js/JQuery.js')?>"></script>
<script src="<?=base_url('assets/');?>js/lightslider.js"></script> 
    
  <style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  font-family: "Poppins" , sans-serif;
}
    </style>
</head>
<body style="background-color: #FFFFFF; color: #21302f;">
<nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #21302f;">
  <div class="container-fluid">
  <a class="navbar-brand" href="<?=base_url('home');?>"><img src="<?=base_url('assets/image/logo/logo.png');?>" style="width: 4.5rem;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-light" href="<?=base_url('tentang');?>">Tentang Kami</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Kategori
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?=base_url('category/pembangunan');?>">Pembangunan</a>
          <a class="dropdown-item" href="<?=base_url('category/renovasi');?>">Renovasi</a>
          <a class="dropdown-item" href="<?=base_url('category');?>">Semua</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="<?=base_url('penyaluran');?>">Penyaluran</a>
      </li>
    </ul>
    <?php if($this->session->userdata('email')==NULL):?>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link text-light" href="<?=base_url('auth');?>">Masuk 
          <span class="ml-1"><i class="fas fa-fw fa-sign-in-alt text-light"></i></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#" data-toggle="modal" data-target="#exampleModalCenter">Daftar 
          <span class="ml-1"><i class="fas fa-fw fa-user-plus text-light"></i></span></a>
      </li>
      </ul>
      <?php else:?>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="far fa-fw fa-user text-light"></i>
            </a>
            <?php if($this->session->userdata('role_id') != 3):?>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?=base_url('user');?>">Dashboard</a>
              <a class="dropdown-item" href="<?=base_url('auth/logout');?>">Logout</a>
            </div>
            <?php else:?>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?=base_url('admin/pengajuan');?>">Dashboard</a>
              <a class="dropdown-item" href="<?=base_url('auth/logout');?>">Logout</a>
            </div>
            <?php endif;?>
          </li>
        </ul>
      <?php endif;?>
    <form class="form-inline my-2 my-lg-0 ml-md-3" method="post" action="<?=base_url('category/search');?>">
      <input class="form-control mr-sm-2" type="search" name="search" id="search" placeholder="Cari Campaign" aria-label="Search">
      <button class="btn btn-outline-secondary my-0 my-sm-0" type="submit"><i class="fas fa-fw fa-search"></i></button>
    </form>
  </div>
  </div>
</nav>