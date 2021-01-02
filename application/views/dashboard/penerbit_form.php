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
                <h1><?= $this->router->fetch_method()=='ubah' ? 'Ubah' : 'Tambah';?> Penerbit</h1>
                <form method="post">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama_penerbit"<?= $this->router->fetch_method()=='ubah' ? "value='$penerbit[nama_penerbit]'" : '';?> class="form-control">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>