<style>
    #katalog .item .card-img-top{
        max-width: 50%;
        margin: 0 auto;

    }
</style>

<br><br>
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?=base_url('assets/img/kategori/bg.jpg');?>" class="d-block w-100" alt="...">
    </div>
  </div>
<br><br>
<div id="katalog" class="d-flex justify-content-around flex-wrap">
    <?php if($books->num_rows()):?>
        <?php foreach($books->result() as $row):?>
            <div class="item col-md-3">
                <div class="card" style="width: 18rem;">
                    <?php if(!empty($row->gambar)):?><img class="card-img-top" src="<?= $row->gambar;?>" alt="Card image cap"><?php endif;?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $row->judul;?></h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                            content.</p>
                        <a href="<?= base_url('transaksi/add_cart/'.$row->id_buku);?>" class="btn btn-primary">Pinjam</a>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    <?php endif;?>
</div>