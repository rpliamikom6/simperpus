<style>
    #dashboard {
        font-size: 1.4em;
    }
    .stepper ul{
        list-style-type: none;
        margin-block-start: 0;
        margin-block-end: 0;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        padding-inline-start: 0;
        padding: 0;
        margin: 0;
    }
    .stepper::before{
        content: '';
        border: solid thin;
        position: absolute;
        left: 0;
        right: 0;
        top: 34px;
    }
    .stepper .step{
        position: relative;
        text-align: center;
        vertical-align: middle;
        width: 68px;
        font-size: .6em;
    }
    .stepper .step .step-icon{
        height: 68px;
        border: solid medium;
        border-radius: 50%;
        width: 68px;
        margin: 0 auto;
        font-size: 2em;
        background-color: #fff;
    }
    .stepper .step .step-icon i{
        display: inline-block;
        line-height: 68px;
    }

    .step.success{
        color: #28a745!important;
    }
    .step.danger{
        color: #dc3545!important;
    }
</style>
<div id="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('layout/menu.php');?>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="stepper d-flex justify-content-between">
                            <div class="step success">
                                <div class="step-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span>Pesanan dibuat</span>
                            </div>
                            <div class="step">
                                <div class="step-icon">
                                    <i class="fas fa-boxes"></i>
                                </div>
                                <span>Sedang diproses</span>
                            </div>
                            <div class="step">
                                <div class="step-icon">
                                    <i class="fas fa-truck-moving"></i>
                                </div>
                                <span>Dalam pengiriman</span>
                            </div>
                            <div class="step">
                                <div class="step-icon">
                                    <i class="fas fa-people-carry"></i>
                                </div>
                                <span>Diterima</span>
                            </div>
                            <div class="step">
                                <div class="step-icon">
                                    <i class="fas fa-undo"></i>
                                </div>
                                <span>Proses pengembalian</span>
                            </div>
                            <div class="step">
                                <div class="step-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <span>Telah kembali</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-9">
                                <h3>Buku yang dipinjam</h3>
                                <div class="items">
                                    <div class="item">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <td style="width: 20%;" rowspan="2">
                                                        <img src="https://www.duniailkom.com/wp-content/uploads/2019/05/Cover-PHP-Uncover-2.0-Banner-big.jpg" alt="" class="img-fluid">
                                                    </td>
                                                    <td>
                                                        <b>Pemrograman PHP</b><br>
                                                        <small>M. Suyanto | Penerbit ANDI</small>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-block btn-success">Terima</button>
                                <button class="btn btn-block btn-success">Terima</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>