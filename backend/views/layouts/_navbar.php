<?php 

use yii\helpers\Url;
use backend\models\Shortcut;
$url = Yii::$app->request->url;

$shortcut = Shortcut::find()->select(['name', 'url'])->where(['level' => Yii::$app->user->identity->level])->all();

?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href=""><b>SIMPS</b></a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form id="search-form" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input id="search-input" autocomplete="off" class="form-control" list="output-search" type="text" placeholder="Pergi Ke (Ctrl + B)" aria-label="Search" aria-describedby="basic-addon2" />
                    <input id="user-level" type="hidden" value="<?= Yii::$app->user->identity->level; ?>" />
                    <datalist id="output-search">
                        <?php foreach($shortcut as $datas => $data): ?>
                            <option value="<?= $data['name'] ?>">
                        <?php endforeach; ?>
                    </datalist>
                    <div class="input-group-append">
                        <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item text-danger" data-method="post" href="<?= Url::toRoute(['site/logout']); ?>">Logout (<?= Yii::$app->user->identity->nama_petugas; ?>)</a>
                    </div>
                </li>
            </ul>
        </nav>
