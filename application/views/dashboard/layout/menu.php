<ul class="nav flex-column">
    <?php if($this->session->userdata('login')['is_admin']==1):?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/buku');?>">Buku</a>
        </li>
    <?php endif;?>
    <?php if($this->session->userdata('login')['is_admin']==1):?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/penerbit');?>">Penerbit</a>
        </li>
    <?php endif;?>
    <?php if($this->session->userdata('login')['is_admin']==1):?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/kategori');?>">Kategori</a>
        </li>
    <?php endif;?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard/peminjaman');?>">Peminjaman</a>
    </li>
    <div class="dropdown-divider"></div>
    <?php if($this->session->userdata('login')['is_admin']==1):?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/user');?>">User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/master_person');?>">Master Person</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dashboard/master_metode_pengiriman');?>">Master Metode Pengiriman</a>
        </li>
    <?php endif;?>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('logout');?>">Logout</a>
    </li>
</ul>