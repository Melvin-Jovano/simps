<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Siswa';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="mt-4">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus mr-2"></i>Buat Data Siswa Baru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php 
        // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nisn',
            'nis',
            'nama:ntext',
            // 'password:ntext',
            // 'id_kelas',
            //'id_skill',
            //'alamat:ntext',
            //'no_telp:ntext',
            //'id_spp',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
