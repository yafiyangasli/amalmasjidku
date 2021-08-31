<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name">Amal Masjidku Admin</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
     <li>
       <a href="<?= base_url('admin/pengajuan');?>">
        <i class='bx bx-list-plus'></i>
         <span class="links_name">Pengajuan</span>
       </a>
       <span class="tooltip">Pengajuan</span>
     </li>
     <li>
       <a href="<?= base_url('admin/campaign/dilaksanakan');?>">
         <i class='bx bx-user-voice'></i>
         <span class="links_name">Campaign</span>
       </a>
       <span class="tooltip">Campaign</span>
     </li>
     <li>
       <a href="<?= base_url('admin/donatur');?>">
         <i class='bx bx-money'></i>
         <span class="links_name">Donatur</span>
       </a>
       <span class="tooltip">Donatur</span>
     </li>
     <li>
       <a href="<?= base_url('admin/penyaluran');?>">
         <i class='bx bx-paper-plane'></i>
         <span class="links_name">Penyaluran</span>
       </a>
       <span class="tooltip">Penyaluran</span>
     </li>
     <li>
       <a href="<?= base_url('admin/newsletter');?>">
         <i class='bx bx-mail-send'></i>
         <span class="links_name">Newsletter</span>
       </a>
       <span class="tooltip">Newsletter</span>
     </li>
     <li>
       <a href="<?= base_url('admin/tentang');?>">
         <i class='bx bx-layer'></i>
         <span class="links_name">Tentang Kami</span>
       </a>
       <span class="tooltip">Tentang Kami</span>
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
         <i class='bx bx-user-plus' style="color: #21302f"></i>
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

  