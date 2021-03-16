<?php

/* @var $this yii\web\View */

$this->title = 'Riwayat Pembayaran';
?>
<div class="pt-5">

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8 card p-5 my-2">
            <h2 class="text-center">~ Riwayat Pembayaran ~</h2>
            <hr>
            <fieldset class="border px-3">
                <legend class="w-auto">
                    <a tabindex="0" data-html="true" role="button" id="popover" data-trigger="focus" title="" data-content="<b>Klik Untuk Melihat Riwayat Data Dari Waktu Ke Waktu</b>" data-placement="left">
                        <input type="text" name="date" id="datepicker" class="form-control" style="width:205px!important;cursor:pointer!important;">
                    </a>
                </legend>
                <button style="float:right" class="btn btn-dark mb-3 btn-inline"><i class="fas fa-search mr-2"></i>Lihat Semua Pembayaran</button>
                <table class="table table-striped">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                    </tr>

                    <?php for($i=1;$i<11;$i++): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td>01-20-2021</td>
                        <td>Rp.10.000</td>
                    </tr>
                    <?php endfor; ?>

                    <tr>
                        <th colspan="2">Jumlah</th>
                        <th>Rp.100.000</th>
                    </tr>
                </table>
            </fieldset>
        </div>
    </div>
</div>

<?php

$this->registerJs('
    $(document).ready(function(){
        $("#datepicker").daterangepicker({
            "timepicker" : true,
            "applyClass": "btn-dark"
        });

        $("#datepicker").val("");
        $("#datepicker").attr("placeholder", "Tanggal Pembayaran...");

    $("#popover").popover("show");

    });', \yii\web\View::POS_READY);
