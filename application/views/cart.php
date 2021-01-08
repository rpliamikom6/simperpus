<style>
    #cart .items{
        font-size:1.3em;

    }
</style>
<div id="cart" class="d-flex justify-content-around flex-wrap">
    <div class="row">
        <div class="col-md-9">
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
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>