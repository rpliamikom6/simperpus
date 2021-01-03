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
                <h1>Tambah Buku</h1>
                <form method="post">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul"<?= $this->router->fetch_method()=='ubah' ? "value='$buku[judul]'" : '';?> class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="id_kategori" class="form-control" required>
                            <option value="">- Pilih Kategori -</option>
                            <?php if($kategori->num_rows()):?>
                                <?php foreach($kategori->result() as $row_kategori):?>
                                    <option value="<?= $row_kategori->id;?>"><?= $row_kategori->nama;?></option>
                                <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Penerbit</label>
                        <select name="id_penerbit" class="form-control" required>
                            <option value="">- Pilih Penerbit -</option>
                            <?php if($penerbit->num_rows()):?>
                                <?php foreach($penerbit->result() as $row_penerbit):?>
                                    <option value="<?= $row_penerbit->id_penerbit;?>"><?= $row_penerbit->nama_penerbit;?></option>
                                <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sinopsis</label>
                        <textarea name="sinopsis" style="resize:none;" cols="30" rows="4" class="form-control"><?= $this->router->fetch_method()=='ubah' ? $buku['sinopsis'] : '';?></textarea>
                    </div>
                    <fieldset>
                        <legend>Detail</legend>
                        <div id="detail-wrapper" class="row">
                            <div id="item-blank" class="col-md-12 d-none">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="detail_buku[detail][]" class="form-control" placeholder="Detail">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <input type="text" name="detail_buku[value][]" class="form-control"  placeholder="Value">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <?php $i=1;?>
                            <?php if(isset($detail_buku)):?>
                                <?php if($detail_buku->num_rows()):?>
                                    <?php foreach($detail_buku->result_array() as $row_detail):?>
                                        <div id="item-<?=$i;?>" class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" name="detail_buku[detail][]" class="form-control"<?= $this->router->fetch_method()=='ubah' ? "value='$row_detail[detail]'" : '';?> placeholder="Detail">
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <input type="text" name="detail_buku[value][]" class="form-control"<?= $this->router->fetch_method()=='ubah' ? "value='$row_detail[value]'" : '';?>  placeholder="Value">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" onclick="remove_detail_exist(<?=$i;?>,'<?= $row_detail['detail'];?>')" class="btn btn-block btn-danger"><i class="far fa-trash-alt"></i></button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <?php $i++;?>
                                    <?php endforeach;?>
                                <?php else:?>
                                    <div id="item-<?=$i;?>" class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" name="detail_buku[detail][]" class="form-control" placeholder="Detail">
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <input type="text" name="detail_buku[value][]" class="form-control" placeholder="Value">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" onclick="remove_detail(<?=$i;?>)" class="btn btn-block btn-danger"><i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                <?php endif;?>
                            <?php else:?>
                                <div id="item-<?=$i;?>" class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="detail_buku[detail][]" class="form-control" placeholder="Detail">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <input type="text" name="detail_buku[value][]" class="form-control" placeholder="Value">
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" onclick="remove_detail(<?=$i;?>)" class="btn btn-block btn-danger"><i class="far fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            <?php endif;?>
                        </div>
                        <button type="button" id="button_tambah_item" class="btn btn-block btn-primary">Tambah Detail</button>
                    </fieldset>
                    <hr>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
                <script>
                    var item=<?= $i;?>;
                    var field=$('#item-blank').html();
                    $('#item-blank').remove();
                    $('#button_tambah_item').click(function(){
                        $('#detail-wrapper').append('<div id="item-'+item+'" class="col-md-12">'+field+'</div>');
                        
                        $('#item-'+item+' .row').append('<div class="col-md-1"><button type="button" onclick="remove_detail('+item+')" class="btn btn-block btn-danger"><i class="far fa-trash-alt"></i></button></div>')
                        item=item+1;
                    })

                    function remove_detail(id){
                        $('#item-'+id).remove();
                    }

                    function remove_detail_exist(id,detail){
                        var isConfirm=confirm('Detail akan di hapus dari database dan tidak dapat di kembalikan lagi, apakah anda yakin ingin melakukannya?');
                        if(isConfirm){
                            $.ajax({
                                type: "GET",
                                dataType: "json",
                                url: "<?= base_url('dashboard/buku/hapus_detail/');?>"+"/"+id+"/"+detail,
                                success: function(response) {
                                    if(response.meta_data.code==200){
                                        $('#item-'+id).remove();
                                    }
                                    else{
                                        alert('Error Code '+response.meta_data.code);
                                    }
                                }
                            });
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</div>