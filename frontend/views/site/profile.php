<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Biodata';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pt-5">

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 card p-5 my-2">
        <?php $form = ActiveForm::begin(['id' => 'bio-form']); ?>

            <h2>
                <span class="bio-data"><?= $data['nama'] ?></span>
                <?= $form->field($data, 'nama')->textInput(['class' => 'biodata-form form-control'])->label(false); ?>
            </h2>
            <hr>
            <div class="row">
                <div class="col-6">
                    <div class="mb-1 font-weight-bold">NISN</div>
                    <small class="bio-data">~ <?= $data['nisn'] != "" ? $data['nisn'] : "Belum Diisi" ?></small>
                    <?= $form->field($data, 'nisn')->textInput(['class' => 'biodata-form form-control'])->label(false); ?>

                    <div class="mb-1 font-weight-bold mt-4">NIS</div>
                    <small class="bio-data">~ <?= $data['nis'] != "" ? $data['nis'] : "Belum Diisi" ?></small>
                    <?= $form->field($data, 'nis')->textInput(['class' => 'biodata-form form-control'])->label(false); ?>
                </div>

                <div class="col-6">
                    <div class="mb-1 font-weight-bold">Kelas</div>
                    <small class="bio-data">~ <?= $data['id_kelas'] != "" ? $data['id_kelas'] : "Belum Diisi" ?></small>
                    <?= $form->field($data, 'id_kelas')->textInput(['class' => 'biodata-form form-control'])->label(false); ?>

                    <div class="mb-1 font-weight-bold">Nomor Telepon</div>
                    <small class="bio-data">~ <?= $data['no_telp'] != "" ? $data['no_telp'] : "Belum Diisi" ?></small>
                    <?= $form->field($data, 'no_telp')->textInput(['class' => 'biodata-form form-control'])->label(false); ?>
                </div>

                <div class="col-12">
                    <div class="mb-1 font-weight-bold">Alamat</div>
                    <small class="bio-data">~ <?= $data['alamat'] != "" ? $data['no_telp'] : "Belum Diisi" ?></small>
                    <?= $form->field($data, 'alamat')->textInput(['class' => 'biodata-form form-control'])->label(false); ?>
                    <button id="update" class="btn btn-primary mt-3"><i class="fas fa-wrench mr-2"></i>Ubah</button>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php

$this->registerJs('
    $(document).ready(function(){
        $(".biodata-form").toggle();
        $("#update").click((event) => {
            event.preventDefault();
            $(".biodata-form").toggle();
            $(".bio-data").toggle();
        });
    });', \yii\web\View::POS_READY);

?>
