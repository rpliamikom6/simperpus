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
                        <label>Profile</label>
                        <select name="id_master_person" id="id_master_person" class="form-control" required>
                            <option value="0">Buat Baru</option>
                            <?php if($master_person->num_rows()):?>
                                <?php foreach($master_person->result() as $mp):?>
                                    <option value="<?= $mp->id;?>"<?= $this->router->fetch_method()=='ubah' ? ($mp->id==$user['id_master_person'] ? ' selected' : '') : '';?>><?= $mp->nama;?> (<?= $mp->role=='mhs' ? 'Mahasiswa' : ucfirst($mp->role);?> | <?= $mp->identity;?>)</option>
                                <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                    <div id="form_mp" class="d-none">
                        <div class="form-group">
                            <label>Nomor Identitas</label>
                            <input type="text" name="mp[identity]"<?= $this->router->fetch_method()=='ubah' ? "value='$user[identity]'" : '';?> class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="mp[nama]"<?= $this->router->fetch_method()=='ubah' ? "value='$user[nama]'" : '';?> class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="mp[alamat]" cols="30" rows="4" class="form-control" style="resize:none;" required><?= $this->router->fetch_method()=='ubah' ? $user['alamat'] : '';?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="mp[email]"<?= $this->router->fetch_method()=='ubah' ? "value='$user[email]'" : '';?> class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="mp[role]" class="form-control">
                                <option value="">- Pilih Role -</option>
                                <?php $option=array('publik','mhs','karyawan');?>
                                <?php foreach($option as $opt):?>
                                    <option value="<?= $opt;?>"<?= $this->router->fetch_method()=='ubah' ? ($opt==$user['role'] ? ' selected' : '') : '';?>><?= $opt=='mhs' ? 'Mahasiswa' : $opt;?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <script>
                        $("#id_master_person").select2({
                            theme: 'bootstrap4',
                            allowClear:true,
                            placeholder: 'Position'
                        });
                        if($('#form_mp').hasClass('d-none')==false){
                            m
                        $('#form_mp').removeClass('d-none');
                        $('#id_master_person').change(function(){
                            if($('#id_master_person').val()!='0'){
                                if($('#form_mp').hasClass('d-none')==false){
                                    $('#form_mp').addClass('d-none');
                                }
                                $('#form_mp .form-control').prop('required',false);
                            }
                            else{
                                $('#form_mp').removeClass('d-none');
                                $('#form_mp .form-control').prop('required',true);
                            }
                        })
                    </script>
                    <hr>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>