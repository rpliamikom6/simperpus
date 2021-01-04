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
                <h1>Daftar Admin</h1>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($admin->result() as $row):?>
                                <tr>
                                    <td><?= $row->nama;?></td>
                                    <td>
                                        <a href="<?= base_url("dashboard/admin/ubah/$row->id");?>" class="btn btn-warning">Ubah</a>
                                        <a onclick="return confirm('Apakah anda yakin ingin menghapus?')" href="<?= base_url("dashboard/admin/hapus/$row->id");?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <a href="<?=base_url('dashboard/admin/tambah');?>" class="btn btn-primary">Tambah</a>
            </div>
        </div>
    </div>
</div>