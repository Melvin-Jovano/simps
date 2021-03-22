<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Masuk';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 card p-5 my-2">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Silahkan Isi Data Berikut Untuk Dapat Masuk :</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?php if($password): ?>
                    <?= $form->field($model, 'nisn')->textInput(['readonly' => true])->label("NISN"); ?>
                    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true])->label("Kata Sandi"); ?>
                <?php else: ?>
                    <?= $form->field($model, 'nisn')->textInput(['autofocus' => true])->label("NISN"); ?>
                    <?= $form->field($model, 'password')->passwordInput(['style' => 'display:none;'])->label(false); ?>
                <?php endif; ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label("Ingat Saya"); ?>

                <div class="">
                    <?= Html::submitButton('<i class="fas fa-sign-in-alt mr-2"></i>Masuk', ['class' => 'btn btn-dark', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
<?php
$this->registerJs('
    $(document).ready(function(){
        // $("#password-optional").hide();
    });', \yii\web\View::POS_READY);
?>