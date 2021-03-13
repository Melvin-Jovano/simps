<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="boxWallpaper">
    <div class="wallpaper">
        <div class="boxes1"></div>
        <div class="boxes2"></div>
        <div class="boxes3"></div>
        <div class="boxes4"></div>
        <div class="boxes5"></div>
        <div class="boxes6"></div>
    </div>
</div>

<?php echo Html::img('@web/assets/img/wallpaper.png', ['class' => 'position-fixed w-100 h-100']); ?>

<?= $this->render("_navbar.php"); ?>

<div class="postion-relative">
    <div class="container py-5 position-relative" style="z-index:100!important">
        <?= Alert::widget() ?>

        <?= $content ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
