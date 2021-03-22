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
                        <input autocomplete="off" type="text" name="date" id="datepicker" class="form-control" style="width:205px!important;cursor:pointer!important;">
                    </a>
                </legend>
                <button id="findAll" class="btn btn-dark mb-3 float-right"><i class="fas fa-search mr-2"></i>Lihat Semua Pembayaran</button>
                <div id="table">
                    <table class="table table-striped">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Dan Waktu</th>
                            <th>Nominal</th>
                        </tr>
                        <tbody id="tbody">
                            
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
    </div>
</div>

<?php

$this->registerJs('
    $(document).ready(function(){
        $("#table").slideUp();

        $("#datepicker").daterangepicker({
            "timepicker" : true,
            "applyClass": "btn-dark"
        }, function(start, end, label) {
            $("#table").slideUp();
            let formData = new FormData;
            formData.append("date1", start.format("YYYY-MM-DD"));
            formData.append("date2", end.format("YYYY-MM-DD"));
            $.ajax({
                url : "/action/get-specific-data",
                type : "post",
                data: formData,
                processData: false,
                contentType: false,
                success : (data) => {
                    $("#table").slideDown();
                    document.querySelector("#tbody").innerHTML = "";

                    let no = 1;
                    let total = 0;
                    data.data.forEach((spp) => {
                        total += parseInt(spp.nominal);

                        let tr = document.createElement("tr");
                        let tdNo = document.createElement("td");
                        tdNo.innerHTML = no;

                        let tdDate = document.createElement("td");
                        tdDate.innerHTML = spp.created_at;

                        let tdPrice = document.createElement("td");
                        tdPrice.innerHTML = "Rp."+spp.nominal;

                        tr.append(tdNo);
                        tr.append(tdDate);
                        tr.append(tdPrice);
                        no++;
                        document.querySelector("#tbody").append(tr);
                    });
                    let tr = document.createElement("tr");
                    let thTotalText = document.createElement("th");
                    thTotalText.setAttribute("colspan", "2");
                    thTotalText.setAttribute("class", "pl-3");
                    thTotalText.innerHTML = "Jumlah";

                    let thTotal = document.createElement("th");
                    thTotal.innerHTML = "Rp."+total;

                    tr.append(thTotalText);
                    tr.append(thTotal);

                    document.querySelector("#tbody").append(tr);
                }
            });
        });

        $("#datepicker").val("");
        $("#datepicker").attr("placeholder", "Tanggal Pembayaran...");

    $("#popover").popover("show");

    $("#findAll").click(() => {
        $("#table").slideUp();
        let formData = new FormData;
        $.ajax({
            url : "/action/get-all-data",
            type : "post",
            data: formData,
            processData: false,
            contentType: false,
            success : (data) => {
                $("#table").slideDown();
                document.querySelector("#tbody").innerHTML = "";

                let no = 1;
                let total = 0;
                
                data.data.forEach((spp) => {
                    total += parseInt(spp.nominal);

                    let tr = document.createElement("tr");
                    let tdNo = document.createElement("td");
                    tdNo.innerHTML = no;

                    let tdDate = document.createElement("td");
                    tdDate.innerHTML = spp.created_at;

                    let tdPrice = document.createElement("td");
                    tdPrice.innerHTML = "Rp." + number_format(spp.nominal);

                    tr.append(tdNo);
                    tr.append(tdDate);
                    tr.append(tdPrice);
                    no++;
                    document.querySelector("#tbody").append(tr);

                });
                let tr = document.createElement("tr");
                let thTotalText = document.createElement("th");
                thTotalText.setAttribute("colspan", "2");
                thTotalText.setAttribute("class", "pl-3");
                thTotalText.innerHTML = "Jumlah";

                let thTotal = document.createElement("th");
                thTotal.innerHTML = "Rp." + number_format(total);

                tr.append(thTotalText);
                tr.append(thTotal);

                document.querySelector("#tbody").append(tr);

            }
        });
    });

    });', \yii\web\View::POS_READY
);
