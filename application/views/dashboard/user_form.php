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
                <h1><?= $this->router->fetch_method()=='ubah' ? 'Ubah' : 'Tambah';?> User</h1>
                <form method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username"<?= $this->router->fetch_method()=='ubah' ? "value='$user[username]'" : '';?> class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md">
                            <label>Password <small class="text-danger">(Diisi jika ingin merubah)</small></label>
                            <input type="password" name="password" id="field_password" class="form-control" required>
                        </div>
                        <div class="col-md">
                            <label>Ulangi Password</label>
                            <input type="password" id="field_repassword" class="form-control" autocomplete="new-password" required>
                        </div>
                        <script>
                            var ismatching_repassword=false;
                            $('#field_password').change(function(){
                                if($('#field_repassword').val()!=null){
                                    $('#field_repassword').val(null);
                                }
                            })
                            $('#field_repassword').change(function(){
                                if($('#field_password').val()!=$('#field_repassword').val()){
                                    if(!$('#field_repassword').hasClass('is-invalid')){
                                        $('#field_repassword').addClass('is-invalid');
                                    }
                                    ismatching_repassword=false;
                                }
                                else{
                                    $('#field_repassword').removeClass('is-invalid');
                                    ismatching_repassword=true;
                                }
                            })
                        </script>
                    </div>
                    <div class="form-group">
                        <label>Admin</label>
                        <select name="is_admin" class="form-control" required>
                            <option value="">- Silahkan Pilih -</option>
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Profile</label>
                        <select name="id_master_person" id="id_master_person" class="form-control" required>
                            <option value="">- Silahkan Pilih -</option>
                            <?php if($master_person->num_rows()):?>
                                <?php foreach($master_person->result() as $mp):?>
                                    <option value="<?= $mp->id;?>"<?= $this->router->fetch_method()=='ubah' ? ($mp->id==$user['id_master_person'] ? ' selected' : '') : '';?>><?= $mp->nama;?> (<?= $mp->role=='mhs' ? 'Mahasiswa' : ucfirst($mp->role);?> | <?= $mp->identity;?>)</option>
                                <?php endforeach;?>
                            <?php endif;?>
                        </select>
                        <small>Untuk menambahkan/mengubah data master person <a onclick="return confirm('Anda akan meninggalkan halaman ini, semua data yang belum di simpan akan hilang. Apakah anda yakin?');" href="<?= base_url('dashboard/master_person');?>">Klik disini</a></small>
                    </div>
                    <script>
                        $("#id_master_person").select2({
                            theme: 'bootstrap4',
                            allowClear:true,
                            placeholder: 'Position'
                        });
                    </script>
                    <hr>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>