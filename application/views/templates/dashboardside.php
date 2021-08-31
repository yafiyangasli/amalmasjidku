<?php if($this->session->userdata('role_id')==1):?>
<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">Amal Masjidku</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li >
        <a href="<?= base_url('user');?>">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li>
       <a href="<?= base_url('user/profile');?>">
         <i class='bx bx-user' ></i>
         <span class="links_name">Akun</span>
       </a>
       <span class="tooltip">Akun</span>
     </li>
     <li>
       <a href="<?= base_url('user/donation');?>">
         <i class='bx bx-money'></i>
         <span class="links_name">Donasi</span>
       </a>
       <span class="tooltip">Donasi</span>
     </li>
     <li>
       <a href="<?= base_url('user/penyaluran');?>">
         <i class='bx bx-paper-plane'></i>
         <span class="links_name">Penyaluran</span>
       </a>
       <span class="tooltip">Penyaluran</span>
     </li>
     <li>
       <a href="<?= base_url('home');?>">
         <i class='bx bx-home' ></i>
         <span class="links_name">Beranda</span>
       </a>
       <span class="tooltip">Beranda</span>
     </li>
     <li class="profile">
         <div class="profile-details">
         <i class='bx bx-user' style="color: #21302f;"></i>
           <div class="name_job">
             <div class="name"><?=$this->session->userdata('nama');?></div>
           </div>
         </div>
         <a href="<?=base_url('auth/logout');?>">
          <i class='bx bx-log-out' id="log_out" style="color: #21302f;"></i> 
         </a>
     </li>
    </ul>
  </div>
<?php elseif($this->session->userdata('role_id')==2):?>
  <div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">Fundrise</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li >
        <a href="<?= base_url('user');?>">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li>
       <a href="<?= base_url('user/profile');?>">
         <i class='bx bx-user' ></i>
         <span class="links_name">Akun</span>
       </a>
       <span class="tooltip">Akun</span>
     </li>
     <li>
       <a href="<?= base_url('user/buatCampaign');?>">
        <i class='bx bx-list-plus'></i>
         <span class="links_name">Buat Campaign</span>
       </a>
       <span class="tooltip">Buat Campaign</span>
     </li>
     <li>
       <a href="<?= base_url('user/campaign/dilaksanakan');?>">
         <i class='bx bx-user-voice'></i>
         <span class="links_name">Campaign</span>
       </a>
       <span class="tooltip">Campaign</span>
     </li>
     <li>
       <a href="<?= base_url('user/penyaluran');?>">
         <i class='bx bx-paper-plane'></i>
         <span class="links_name">Penyaluran</span>
       </a>
       <span class="tooltip">Penyaluran</span>
     </li>
     <li>
       <a href="<?= base_url('home');?>">
         <i class='bx bx-home'></i>
         <span class="links_name">Beranda</span>
       </a>
       <span class="tooltip">Beranda</span>
     </li>
     <li class="profile">
         <div class="profile-details">
         <i class="fas fa-fw fa-mosque" style="color: #21302f"></i>
           <div class="name_job">
             <div class="name"><?=$this->session->userdata('nama');?></div>
           </div>
         </div>
         <a href="<?=base_url('auth/logout');?>">
          <i class='bx bx-log-out' id="log_out" style="color: #21302f"></i> 
         </a>
     </li>
    </ul>
  </div>
<?php endif;?>
  

  