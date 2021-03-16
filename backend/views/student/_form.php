<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Classes;
use frontend\models\Skill;
use yii\helpers\ArrayHelper;

?>

<div class="mt-4">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-6">
            <?= $form->field($model, 'nisn')->textInput() ?>

            <?= $form->field($model, 'nama')->textInput(['rows' => 6]) ?>

            <?= $form->field($model, 'no_telp')->textInput(['rows' => 6]) ?>
        </div>

        <div class="col-6">
            <?= $form->field($model, 'nis')->textInput() ?>

            <div class="form-group field-student-nis">
                <label for="id-class" class="control-label">Kelas</label>
                <?= Html::activeDropDownList(new Classes, 'id', ArrayHelper::map(Classes::find()->all(), 'id', 'class'), ['class' => "form-control siswa-form", "id" => "id-class", 'name' => 'Student[id_kelas]', 'options' => [$model['id_kelas'] => ['selected' => 'selected']]]) ?>
                <div class="help-block"></div>
            </div>

            <div class="form-group field-student-nis">
                <label for="id-skill" class="control-label">Jurusan</label>
                <?= Html::activeDropDownList(new Skill, 'id', ArrayHelper::map(Skill::find()->all(), 'id', 'skill'), ['class' => "form-control siswa-form", "id" => "id-skill", 'name' => 'Student[id_skill]', 'options' => [$model['id_skill'] => ['selected' => 'selected']]]) ?>
                <div class="help-block"></div>
            </div>
        </div>

        <div class="col-12">
            <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-check mr-2"></i>Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
