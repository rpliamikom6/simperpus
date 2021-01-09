<style>
    #dashboard {
        font-size: 1.4em;
    }
    .stepper ul{
        list-style-type: none;
        margin-block-start: 0;
        margin-block-end: 0;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        padding-inline-start: 0;
        padding: 0;
        margin: 0;
    }
    .stepper::before{
        content: '';
        border: solid thin;
        position: absolute;
        left: 0;
        right: 0;
        top: 34px;
    }
    .stepper .step{
        position: relative;
        text-align: center;
        vertical-align: middle;
        width: 68px;
        font-size: .6em;
    }
    .stepper .step .step-icon{
        height: 68px;
        border: solid medium;
        border-radius: 50%;
        width: 68px;
        margin: 0 auto;
        font-size: 2em;
        background-color: #fff;
    }
    .stepper .step .step-icon i{
        display: inline-block;
        line-height: 68px;
    }

    .step.success{
        color: #28a745!important;
    }
    .step.danger{
        color: #dc3545!important;
    }
</style>
<div id="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('layout/menu.php');?>
            </div>
            <div class="col-md-9">
                <h1>Detail Peminjaman</h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="stepper d-flex justify-content-between">
                            <div class="step success">
                                <div class="step-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span>Pesanan dibuat</span>
                            </div>
                            <div class="step<?= $peminjaman['status']>0 && $peminjaman['status']<99 ? ' success' : ($peminjaman['status']==99 ? ' danger' : '');?>">
                                <div class="step-icon">
                                    <i class="fas fa-boxes"></i>
                                </div>
                                <span>Sedang diproses</span>
                            </div>
                            <div class="step<?= $peminjaman['status']>1 && $peminjaman['status']<99 ? ' success' : ($peminjaman['status']==99 ? ' danger' : '');?>">
                                <div class="step-icon">
                                    <i class="fas fa-truck-moving"></i>
                                </div>
                                <span>Dalam pengiriman</span>
                            </div>
                            <div class="step<?= $peminjaman['status']>2 && $peminjaman['status']<99 ? ' success' : ($peminjaman['status']==99 ? ' danger' : '');?>">
                                <div class="step-icon">
                                    <i class="fas fa-people-carry"></i>
                                </div>
                                <span>Diterima</span>
                            </div>
                            <div class="step<?= $peminjaman['status']>3 && $peminjaman['status']<99 ? ' success' : ($peminjaman['status']==99 ? ' danger' : '');?>">
                                <div class="step-icon">
                                    <i class="fas fa-undo"></i>
                                </div>
                                <span>Proses pengembalian</span>
                            </div>
                            <div class="step<?= $peminjaman['status']>4 && $peminjaman['status']<99 ? ' success' : ($peminjaman['status']==99 ? ' danger' : '');?>">
                                <div class="step-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span>Telah kembali</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-9">
                                <h3>Buku yang dipinjam</h3>
                                <div class="items">
                                    <div class="item">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <?php if($items->num_rows()):?>
                                                    <?php foreach($items->result() as $item):?>
                                                        <tr>
                                                            <td style="width: 20%;">
                                                                <img src="<?= $item->gambar;?>" alt="" class="img-fluid">
                                                            </td>
                                                            <td>
                                                                <b><?= $item->judul;?></b><br>
                                                                <small><?= $item->pengarang;?> | <?= $item->nama_penerbit;?></small>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <?php
                                    switch($peminjaman['status']){
                                        case 0:
                                            if($this->session->userdata('login')['is_admin']==1){
                                                base_url('dashboard/peminjaman/input_resi_peminjaman/'.$peminjaman['id_transaksi']);
                                                echo '<a id="btn_terima_peminjaman" href="'.base_url('dashboard/peminjaman/konfirmasi_peminjaman/'.$peminjaman['id_transaksi']).'/1'.'" class="btn btn-block btn-success">Terima</a>
                                                <a id="btn_tolak_peminjaman" href="'.base_url('dashboard/peminjaman/konfirmasi_peminjaman/'.$peminjaman['id_transaksi']).'/99'.'" class="btn btn-block btn-danger">Tolak</a>';
                                            }
                                            break;
                                        case 1:
                                            echo '<button id="btn_input_resi_peminjaman" class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal">Masukan Resi</button>';
                                            break;
                                        case 2:
                                            if($this->session->userdata('login')['id_user']==$peminjaman['id_user']){
                                                echo '<a href="'.base_url('dashboard/peminjaman/konfirmasi_pengiriman/'.$peminjaman['id_transaksi']).'" id="btn_konfirmasi_pengiriman" class="btn btn-block btn-success">Konfirmasi Pengiriman</a>';
                                            }
                                            break;
                                        case 3:
                                            if($this->session->userdata('login')['id_user']==$peminjaman['id_user']){
                                                echo '<button id="btn_input_resi_peminjaman" class="btn btn-block btn-success" data-toggle="modal" data-target="#exampleModal2">Kembalikan</button>';
                                            }
                                            break;
                                        case 4:
                                            if($this->session->userdata('login')['is_admin']==1){
                                                echo '<a href="'.base_url('dashboard/peminjaman/konfirmasi_pengembalian/'.$peminjaman['id_transaksi']).'" id="btn_konfirmasi_pengembalian" class="btn btn-block btn-success">Konfirmasi Pengembalian</a>';
                                            }
                                            break;
                                        case 5:
                                            echo '<h2 class="text-center"><span class="badge badge-success">Selesai</span></h2>';
                                            break;
                                    }
                                ?>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Resi Peminjaman</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('dashboard/peminjaman/input_resi_peminjaman/'.$peminjaman['id_transaksi']);?>" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nomor Resi</label>
                                                        <input type="text" name="resi_pengiriman" class="form-control" placeholder="Nomor Resi">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>




                                <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModal2Label">Resi Pengembalian</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="<?= base_url('dashboard/peminjaman/input_resi_pengembalian/'.$peminjaman['id_transaksi']);?>" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nomor Resi</label>
                                                        <select name="id_metode_pengembalian" id="id_metode_pengembalian" class="form-control">
                                                            <option value="">- Pilih Metode Pengembalian -</option>
                                                            <?php if($metode_pengiriman->num_rows()):?>
                                                                <?php foreach($metode_pengiriman->result() as $metode_pengembalian):?>
                                                                    <?php if($metode_pengembalian->id!=1):?>
                                                                        <option value="<?= $metode_pengembalian->id;?>"><?= $metode_pengembalian->nama;?></option>
                                                                    <?php endif;?>
                                                                <?php endforeach;?>
                                                            <?php endif;?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Nomor Resi</label>
                                                        <input type="text" name="resi_pengembalian" class="form-control" placeholder="Nomor Resi">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $('#btn_input_resi_peminjaman').click(function(){

                                    })
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>