<?php

/* @var $this yii\web\View */
use frontend\models\Student;
use frontend\models\Classes;
use frontend\models\Skill;

$this->title = 'Dashboard';

?>    
        <h1 class="my-4">Dashboard</h1>
        
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area mr-1"></i>
                        Diagram Pembayaran Bulan Ini
                        <span class="float-right">Total Semua : <?= "Rp." . number_format($totalMonth['nominal']); ?></span>
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Riwayat Pembayaran Hari Ini
                <span class="float-right">Total Semua : <?= "Rp." . number_format($totalToday['nominal']); ?></span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Waktu</th>
                                <th>Nominal</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Waktu</th>
                                <th>Nominal</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach($date as $data => $key): ?>
                            <?php $class = Student::find()->where(['nisn' => $key['nisn']])->one()['id_kelas']; ?>
                            <?php $skill = Student::find()->where(['nisn' => $key['nisn']])->one()['id_skill']; ?>

                            <?= "<tr>"; ?>

                                <?= "<td>"; ?>
                                    <?= $key['nisn']; ?>
                                <?= "</td>"; ?>

                                <?= "<td>"; ?>
                                    <?= Student::find()->where(['nisn' => $key['nisn']])->one()['nama']; ?>
                                <?= "</td>"; ?>

                                <?= "<td>"; ?>
                                    <?= explode(" ", $key['created_at'])[1]; ?>
                                <?= "</td>"; ?>

                                <?= "<td>"; ?>
                                    <?= "Rp." . number_format($key['nominal']); ?>
                                <?= "</td>"; ?>

                                <?= "<td>"; ?>
                                    <?= Classes::find()->where(['id' => $class])->one()['class']; ?>
                                <?= "</td>"; ?>

                                <?= "<td>"; ?>
                                    <?= Skill::find()->where(['id' => $skill])->one()['skill']; ?>
                                <?= "</td>"; ?>

                            <?= "</tr>"; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 

$this->registerJs('
    let formData = new FormData;
    $.ajax({
        url : "/action/get-diagram",
        type : "post",
        data: formData,
        processData: false,
        contentType: false,
        success : (data) => {
            let myDate = [];

            data.dates.forEach((date) => {
                myDate.push(data.month + " " + date);
            });

            let maximum = data.maximum;
            Chart.defaults.global.defaultFontFamily = "-apple-system,system-ui,BlinkMacSystemFont,Roboto";
            Chart.defaults.global.defaultFontColor = "#292b2c";

            var ctx = document.getElementById("myAreaChart");
            var myLineChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: myDate,
                    datasets: [{
                        label: "Total",
                        lineTension: 0.3,
                        backgroundColor: "rgba(2,117,216,0.2)",
                        borderColor: "rgba(2,117,216,1)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        data: data.total,
                    }],
                },
                options: {
                    scales: {
                    xAxes: [{
                        time: {
                            unit: "date"
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 8
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: parseInt(maximum),
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                    },
                    legend: {
                        display: false
                    }
                }
                });
            }
    });
');

?>