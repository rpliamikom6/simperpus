<style>
    #dashboard{
        font-size: 1.4em;
    }
</style>
<div id="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('dashboard/buku');?>">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($buku->result() as $row):?>
                                <tr>
                                    <td><?= $row->judul;?></td>
                                    <td>
                                        <a href="<?= base_url("dashboard/buku/ubah/$row->id_buku");?>" class="btn btn-warning">Ubah</a>
                                        <a href="<?= base_url("dashboard/buku/hapus/$row->id_buku");?>" class="btn btn-danger">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <a href="<?=base_url('dashboard/buku/tambah');?>" class="btn btn-primary">Tambah</a>
            </div>
        </div>
    </div>
</div>