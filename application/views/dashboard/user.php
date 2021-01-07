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
                <h1>Daftar User</h1>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($user->result() as $row):?>
                                <tr>
                                    <td><?= $row->nama;?><?php if($row->is_admin==1):?> <span class="badge badge-success">Admin</span><?php endif;?></td>
                                    <td>
                                        <a href="<?= base_url("dashboard/user/ubah/$row->id");?>" class="btn btn-warning">Ubah</a>
                                        <a onclick="return confirm('Apakah anda yakin ingin menghapus?')" href="<?= base_url("dashboard/user/hapus/$row->id");?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <a href="<?=base_url('dashboard/user/tambah');?>" class="btn btn-primary">Tambah</a>
            </div>
        </div>
    </div>
</div>