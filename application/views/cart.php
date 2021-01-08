<style>
    #cart .items{
        font-size:1.3em;

    }
</style>
<div id="cart" class="d-flex justify-content-around flex-wrap">
    <div class="row">
        <div class="col-md">
            <h3>Buku yang dipinjam</h3>
            <div class="items">
                <div class="item">
                    <div class="table-responsive">
                        <table class="table">
                            <?php if(isset($cart)):?>
                                <?php foreach($cart as $row):?>
                                    <tr>
                                        <td style="width: 15%;">
                                            <?php if(!empty($row['gambar'])):?><img src="<?= $row['gambar'];?>" alt="" class="img-fluid"><?php endif;?>
                                        </td>
                                        <td>
                                            <b><?= $row['judul'];?></b><br>
                                            <small><?= $row['pengarang'];?> | <?= $row['nama_penerbit'];?></small>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('transaksi/delete_item_cart/'.$row['id_buku']);?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php else:?>
                                <tr>
                                    <td colspan="3">
                                        Belum ada item di dalam cart anda. <a href="<?= base_url();?>">Lihat katalog</a>
                                    </td>
                                </tr>
                            <?php endif;?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($cart)):?>
            <div class="col-md-3">
                <form action="<?= base_url('transaksi/checkout');?>" method="post">
                    <select name="id_metode_pengiriman" id="id_metode_pengiriman" class="form-control" required>
                        <option value="">- Pilih Metode Pengiriman</option>
                        <?php if($metode_pengiriman->num_rows()):?>
                            <?php foreach($metode_pengiriman->result() as $row_metode_pengiriman):?>
                                <option value="<?= $row_metode_pengiriman->id;?>"><?= $row_metode_pengiriman->nama;?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                    <div id="detail_pengiriman">
                        <textarea name="alamat_pengiriman" id="alamat_pengiriman" cols="30" rows="3" class="form-control" placeholder="Alamat"></textarea>
                        <input type="text" name="kodepos_pengiriman" id="kodepos_pengiriman" class="form-control" placeholder="Kode Pos">
                    </div>
                    <button type="submit" class="btn btn-block btn-lg btn-success">Checkout</button>
                    <script>
                        var detail_pengiriman=$('#detail_pengiriman').html();
                        $('#detail_pengiriman').html(null);
                        $('#id_metode_pengiriman').change(function(){
                            if($('#id_metode_pengiriman').val()>1){
                                $('#detail_pengiriman').html(detail_pengiriman);
                            }
                            else{
                                $('#detail_pengiriman').html(null);
                            }
                        });
                    </script>
                </form>
            </div>
        <?php endif;?>
    </div>
</div>