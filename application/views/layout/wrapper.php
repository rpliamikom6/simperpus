<?php require_once('head.php');?>

<body>
    <section id="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <ul id="top-header-menu">
                        <li>
                            <i class="fas fa-phone-alt"></i> (0274) 884201 - 207
                        </li>
                        <li>&nbsp;&nbsp;|&nbsp;&nbsp;</li>
                        <li>
                            <i class="fas fa-envelope"></i> amikom@amikom.ac.id
                        </li>
                    </ul>
                </div>
                <div class="col-md-8">
                    <ul id="top-header-menu" style="text-align: right;">
                        <li>
                            <a href="#">English</a>
                        </li>
                        <li>
                            <a href="#">Kontak</a>
                        </li>
                        <li>
                            <a href="#">Mail</a>
                        </li>
                        <li>
                            <a href="#">Up.Date</a>
                        </li>
                        <li>
                            <a href="#"><b>Info Kampus</b></a>
                        </li>
                        <li>
                            <a href="#">Download</a>
                        </li>
                        <li>
                            <a href="#">Versi Lama</a>
                        </li>
                        <li>
                            <a href="#"><b>Sitemap</b></a>
                        </li>
                        <li>
                            <a href="#"><b>HOTLINE</b></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="main-header">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between">
                <div class="col-md-4">
                    <div class="logo-container">
                        <a href="<?=base_url();?>">
                            <img class=" ls-is-cached lazyloaded" src="https://home.amikom.ac.id/media/2020/08/logo-amikom-t.png" alt="Universitas Amikom Yogyakarta" id="logo" data-height-percentage="60" data-actual-width="1051" data-actual-height="375">
                        </a>
                    </div>
                </div>
                <div class="col-md">
                    <ul id="main-header-menu" style="text-align: right;">
                        <li>
                            <a href="#">Profile</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                        <li>
                            <a href="#">About</a>
                        </li>
                        <li>
                            <a href="#">Email</a>
                        </li>
                       
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul id="main-header-menu" style="text-align: right;">
                        <li>
                            <?php if($this->session->userdata('login')):?>
                                <a href="<?= base_url('dashboard');?>">Dashboard</a>
                            <?php else:?>
                                <a href="<?= base_url('login');?>">Login</a>
                            <?php endif;?>
                        </li>
                        <?php if($this->session->userdata('login')):?>
                            <li>
                                <a href="<?= base_url('transaksi/cart');?>"><i class="fas fa-shopping-cart"></i> <span class="badge badge-success"><?= $this->session->userdata('cart') ? sizeof($this->session->userdata('cart')) : 0;?></span></a>
                            </li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="content-wrapper">
        <div class="container">
            <?php require_once('content.php');?>
        </div>
    </section>
    <?php require_once('footer.php');?>
</body>

</html>