<?php 

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Classes;
use frontend\models\Skill;
use frontend\models\Student;
use yii\helpers\Url;

$this->title = 'Generate Laporan';

?>

<h1 class="my-4">Laporan & Riwayat</h1>

<div class="row">

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-user-friends mr-2"></i>Cari Siswa
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <b class="mb-2 d-block">Kelas</b>
                        <?= Html::activeDropDownList(new Classes, 'id', ArrayHelper::map(Classes::find()->all(), 'id', 'class'), ['class' => "form-control siswa-form", "id" => "id-class", 'prompt' => 'Kelas']) ?>
                    </div>

                    <div class="col-8">
                        <b class="mb-2 d-block">Jurusan</b>
                        <?= Html::activeDropDownList(new Skill, 'id', ArrayHelper::map(Skill::find()->all(), 'id', 'skill'), ['class' => "form-control siswa-form", "id" => "id-skill", 'prompt' => 'Jurusan']) ?>
                    </div>

                    <div class="col-12 mt-3">
                        <b class="mb-2 d-block">Nama</b>
                        <select class="form-control" id="nama-siswa">
                            <option>Pilih Kelas Dan Jurusan Dahulu</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button id="getSiswaData" class="btn btn-sm btn-dark"><i class="far fa-eye mr-2"></i>Lihat</button>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-calendar-alt mr-2"></i>Cari Waktu
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <b class="mb-2 d-block">Jarak Tanggal</b>
                        <input id="datepicker" autocomplete="off" style="cursor:pointer!important;" class="form-control" type="text" />
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button id="getRangeHistory" class="btn btn-sm btn-dark"><i class="far fa-eye mr-2"></i>Lihat</button>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-history mr-2"></i>Cetak Seluruh Waktu
            </div>

            <div class="card-footer">
                <button id="getAllData" class="btn btn-sm btn-dark"><i class="far fa-eye mr-2"></i>Lihat</button>
            </div>
        </div>
    </div>
    
</div>

<hr>
<button id="clearTable" class="btn btn-dark btn-sm ml-3"><i class="fas fa-eraser mr-2"></i>Kosongkan Tabel</button>
<?php if(Yii::$app->user->identity->level == 2):?>
    <button id="printPDF" class="btn btn-dark btn-sm ml-3"><i class="far fa-file-pdf mr-2"></i>Cetak PDF</button>
<?php endif; ?>
<page>
    <div id="pdf-area" class="p-3">
        <h4 class="text-center mb-4 mt-2">Laporan Pembayaran Sekolah <span id="dateReport"></span></h4>
        <table class="table table-striped">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Tanggal & Waktu</th>
                <th>Nominal</th>
            </tr>

            <tbody id="tbody"></tbody>
        </table>
    </div>
</page>

<?php
$this->registerJs('
    $(document).ready(function(){
        function today() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, "0");
            var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
            var yyyy = today.getFullYear();

            today = mm + "-" + dd + "-" + yyyy;
            return today;
        }

        let dateData = new FormData;
        $("#nama-siswa").prop("disabled", "true");

        $("#clearTable").click(() => {
            $("#tbody").html("");
            $("#dateReport").html("");
        });

        $("#id-class").change(() => {
            getSiswa();
        });

        $("#id-skill").change(() => {
            getSiswa();
        });

        $("#getAllData").click(() => {
            getAllData();
        });

        $("#getSiswaData").click(() => {
            getSiswaData();
        });

        $("#getRangeHistory").click(() => {
            getRangeHistory();
        });

        $("#printPDF").click(() => {
            printPDF("Laporan Pembayaran " + today());
        });

        function printPDF(name) {
            const pdf = document.getElementById("pdf-area");
            var opt = {
                margin: 0,
                filename: name + ".pdf",
                image: { type: "JPEG", quality: 1 },
                html2canvas: { scale: 1 },
                jsPDF: { unit: "in", format: "a4", orientation: "portrait" }
            };
            html2pdf().from(pdf).set(opt).save();
        }

        function getSiswa() {
            let formData = new FormData;
            formData.append("class", $("#id-class").val());
            formData.append("skill", $("#id-skill").val());
            $.ajax({
                url : "/action/get-siswa",
                type : "post",
                data: formData,
                processData: false,
                contentType: false,
                success : (data) => {
                    $("#nama-siswa").html("");
                    $("#btn-pay").prop("disabled", "true");
                    $("#transaksi").slideUp();
                    if($("#id-skill").val() != "" && $("#id-class").val() != "") {
                        if(!data.siswa) {
                            $("#nama-siswa").prop("disabled", "true");
                        } else {
                            data.siswa.forEach((siswa) => {
                                let option = document.createElement("option");
                                option.setAttribute("value", siswa.nisn);
                                option.innerHTML = siswa.nama;

                                document.querySelector("#nama-siswa").append(option);
                            });
                            $("#transaksi").slideDown();
                            $("#nama-siswa").removeAttr("disabled");
                        }
                    } else {
                        $("#transaksi").slideUp();
                        $("#btn-pay").prop("disabled", "true");
                        $("#nama-siswa").prop("disabled", "true");
                    }
                }
            });
        }

    $("#datepicker").daterangepicker({
            "timepicker" : true,
            "applyClass": "btn-dark"
        }, function(start, end, label) {
            dateData.append("date1", start.format("YYYY-MM-DD"));
            dateData.append("date2", end.format("YYYY-MM-DD"));
        });

        $("#datepicker").val("");
        $("#datepicker").attr("placeholder", "Tanggal Pembayaran...");

        function getRangeHistory() {
            if($("#datepicker").val() == "") {
                alert("Silahkan Masukkan Tanggal Terlebih Dahulu");
            } else {
                $.ajax({
                    url : "/action/get-range-history",
                    type : "post",
                    data: dateData,
                    processData: false,
                    contentType: false,
                    success : (data) => {
                        $("#tbody").html("");
                        let num = 1;
                        let total = 0;
                        if(data.data == "") {
                            alert("Data Tidak Ditemukan");
                            $("#dateReport").html("");
                        } else {
                            data.data.forEach((spp) => {
                                total += parseInt(spp.nominal);
                                let tr = document.createElement("tr");

                                let tdNum = document.createElement("td");
                                tdNum.innerHTML = num;

                                let tdNama = document.createElement("td");
                                tdNama.innerHTML = spp.nama;

                                let tdKelas = document.createElement("td");
                                tdKelas.innerHTML = spp.class;

                                let tdSkill = document.createElement("td");
                                tdSkill.innerHTML = spp.skill;

                                let tdDate = document.createElement("td");
                                tdDate.innerHTML = spp.created_at;

                                let tdNom = document.createElement("td");
                                tdNom.innerHTML = "Rp." + number_format(spp.nominal);

                                tr.append(tdNum);
                                tr.append(tdNama);
                                tr.append(tdKelas);
                                tr.append(tdSkill);
                                tr.append(tdDate);
                                tr.append(tdNom);

                                document.querySelector("#tbody").append(tr);
                                num++;
                            });
                            let tr = document.createElement("tr");

                            let tdJumlah = document.createElement("th");
                            tdJumlah.innerHTML = "Jumlah";
                            tdJumlah.setAttribute("colspan", "5");

                            let tdTotal = document.createElement("th");
                            tdTotal.innerHTML = "Rp." + number_format(total);

                            tr.append(tdJumlah);
                            tr.append(tdTotal);

                            document.querySelector("#tbody").append(tr);
                            $("#dateReport").html("Tanggal " + data.date1 + " - " + data.date2);
                        }   
                    }
                });
            }
        }

        function getAllData() {
            let formData = new FormData;
            $.ajax({
                url : "/action/get-all-history",
                type : "post",
                data: formData,
                processData: false,
                contentType: false,
                success : (data) => {
                    $("#tbody").html("");
                    let num = 1;
                    let total = 0;
                    if(!data.data) {
                        alert("Data Tidak Ditemukan");
                        $("#dateReport").html("");
                    } else {
                        data.data.forEach((spp) => {
                            total += parseInt(spp.nominal);
                            let tr = document.createElement("tr");

                            let tdNum = document.createElement("td");
                            tdNum.innerHTML = num;

                            let tdNama = document.createElement("td");
                            tdNama.innerHTML = spp.nama;

                            let tdKelas = document.createElement("td");
                            tdKelas.innerHTML = spp.class;

                            let tdSkill = document.createElement("td");
                            tdSkill.innerHTML = spp.skill;

                            let tdDate = document.createElement("td");
                            tdDate.innerHTML = spp.created_at;

                            let tdNom = document.createElement("td");
                            tdNom.innerHTML = "Rp." + number_format(spp.nominal);

                            tr.append(tdNum);
                            tr.append(tdNama);
                            tr.append(tdKelas);
                            tr.append(tdSkill);
                            tr.append(tdDate);
                            tr.append(tdNom);

                            document.querySelector("#tbody").append(tr);
                            num++;
                        });
                        let tr = document.createElement("tr");

                        let tdJumlah = document.createElement("th");
                        tdJumlah.innerHTML = "Jumlah";
                        tdJumlah.setAttribute("colspan", "5");

                        let tdTotal = document.createElement("th");
                        tdTotal.innerHTML = "Rp." + number_format(total);

                        tr.append(tdJumlah);
                        tr.append(tdTotal);

                        document.querySelector("#tbody").append(tr);
                        $("#dateReport").html("Seluruh Data");
                    }   
                }
            });
        }

        function getSiswaData() {
            let formData = new FormData;
            formData.append("nisn", $("#nama-siswa").val());
            $.ajax({
                url : "/action/get-siswa-history",
                type : "post",
                data: formData,
                processData: false,
                contentType: false,
                success : (data) => {
                    $("#tbody").html("");
                    let num = 1;
                    let total = 0;
                    let nama;
                    let alias;
                    let kelas;
                    if(!data.data) {
                        alert("Data Tidak Ditemukan");
                        $("#dateReport").html("");
                    } else {
                        data.data.forEach((spp) => {
                            nama = spp.nama;
                            alias = spp.alias;
                            kelas = spp.class;
                            total += parseInt(spp.nominal);
                            let tr = document.createElement("tr");

                            let tdNum = document.createElement("td");
                            tdNum.innerHTML = num;

                            let tdNama = document.createElement("td");
                            tdNama.innerHTML = spp.nama;

                            let tdKelas = document.createElement("td");
                            tdKelas.innerHTML = spp.class;

                            let tdSkill = document.createElement("td");
                            tdSkill.innerHTML = spp.skill;

                            let tdDate = document.createElement("td");
                            tdDate.innerHTML = spp.created_at;

                            let tdNom = document.createElement("td");
                            tdNom.innerHTML = "Rp." + number_format(spp.nominal);

                            tr.append(tdNum);
                            tr.append(tdNama);
                            tr.append(tdKelas);
                            tr.append(tdSkill);
                            tr.append(tdDate);
                            tr.append(tdNom);

                            document.querySelector("#tbody").append(tr);
                            num++;
                        });
                        let tr = document.createElement("tr");

                        let tdJumlah = document.createElement("th");
                        tdJumlah.innerHTML = "Jumlah";
                        tdJumlah.setAttribute("colspan", "5");

                        let tdTotal = document.createElement("th");
                        tdTotal.innerHTML = "Rp." + number_format(total);

                        tr.append(tdJumlah);
                        tr.append(tdTotal);

                        document.querySelector("#tbody").append(tr);
                        $("#dateReport").html(nama + " " + kelas + " " + alias);
                    }
                }
            });
        }

    });', \yii\web\View::POS_READY);
?>