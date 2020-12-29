<style>
    #grid-menu{
    }
    #grid-menu .item{
        position: relative;
        line-height: 200px;
        height: 200px;
        margin: 20px;
    }
    #grid-menu .item a{
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }
</style>
<div id="grid-menu" class="d-flex justify-content-around flex-wrap">
    <?php if($kategori->num_rows()):?>
        <?php foreach($kategori->result() as $row):?>
            <div class="item col-md-3"><a href="" class="btn btn-block btn-secondary"><?= $row->nama;?></a></div>
        <?php endforeach;?>
    <?php endif;?>
</div>