<!-- Main content -->
<section class="content">
    <?php foreach($katalog->result() as $row):?>
        <div class="card card-solid border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review
                        </h3>
                        <style>
                            .product-image-thumb {
                                box-shadow: 0 1px 2px rgba(0,0,0,.075);
                                border-radius: .25rem;
                                background-color: #fff;
                                border: 1px solid #dee2e6;
                                display: -ms-flexbox;
                                display: flex;
                                margin-right: 1rem;
                                max-width: 5rem;
                                padding: .5rem;
                            }
                        </style>
                        <div id="product-feature">
                            <div class="col-12">
                                <img id="product-image" src="<?= base_url('assets');?>/dist/img/prod-1.jpg" class="product-image img-fluid" alt="Product Image">
                            </div>
                            <script>
                                $('.product-image-thumb').click(function(){
                                    $('#product-image').attr('src',$(this).children('img').attr('src'));
                                })
                            </script>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8">
                        <h3 class="my-3"><?= $row->judul;?></h3>
                        <?php if(!empty($row->sinopsis)):?>
                            <p><?= $row->sinopsis;?></p>
                        <?php endif;?>

                        <?php if($detail->num_rows()):?>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr colspan="3">
                                            <th>Detail Buku</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($detail->result() as $row_detail):?>
                                            <tr>
                                                <td><?= $row_detail->detail;?></td>
                                                <td>:</td>
                                                <td><?= $row_detail->value;?></td>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif;?>
    
                        <div class="mt-4">
                            <div class="btn btn-primary btn-lg btn-flat">
                                <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                Add to Cart
                            </div>
    
                            <div class="btn btn-default btn-lg btn-flat">
                                <i class="fas fa-heart fa-lg mr-2"></i>
                                Add to Wishlist
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    <?php endforeach;?>

</section>