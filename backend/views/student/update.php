<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Student */

$this->title = 'Ubah Data ' . $model->nama;
// $this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->nisn, 'url' => ['view', 'id' => $model->nisn]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="mt-4">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
