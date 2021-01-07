<style>
    #dashboard{
        font-size: 1.4em;
    }
</style>
<div id="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('layout/menu.php');?>
            </div>
            <div class="col-md-9">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($peminjaman->result() as $row):?>
                                <tr>
                                    <td><?= $row->username;?></td>
                                    <td><?= $row->created_at;?></td>
                                    <td>
                                        <a href="<?= base_url("dashboard/peminjaman/detail/$row->id_transaksi");?>" class="btn btn-info">Detail</a>
                                        <a href="<?= base_url("dashboard/peminjaman/ubah/$row->id_transaksi");?>" class="btn btn-warning">Ubah</a>
                                        <a onclick="return confirm('Apakah anda yakin ingin menghapus?')" href="<?= base_url("dashboard/peminjaman/hapus/$row->id_transaksi");?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <a href="<?=base_url('dashboard/peminjaman/tambah');?>" class="btn btn-primary">Tambah</a>
            </div>
        </div>
    </div>
</div>