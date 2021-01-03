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
                <h1><?= $this->router->fetch_method()=='ubah' ? 'Ubah' : 'Tambah';?> Master Person</h1>
                <form method="post">
                    <div class="form-group">
                        <label>Nomor Identitas</label>
                        <input type="text" name="identity"<?= $this->router->fetch_method()=='ubah' ? "value='$master_person[identity]'" : '';?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama"<?= $this->router->fetch_method()=='ubah' ? "value='$master_person[nama]'" : '';?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" cols="30" rows="4" class="form-control" style="resize:none;" required><?= $this->router->fetch_method()=='ubah' ? $master_person['alamat'] : '';?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email"<?= $this->router->fetch_method()=='ubah' ? "value='$master_person[email]'" : '';?> class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="">- Pilih Role -</option>
                            <?php $option=array('publik','mhs','karyawan');?>
                            <?php foreach($option as $opt):?>
                                <option value="<?= $opt;?>"<?= $this->router->fetch_method()=='ubah' ? ($opt==$master_person['role'] ? ' selected' : '') : '';?>><?= $opt=='mhs' ? 'Mahasiswa' : $opt;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>