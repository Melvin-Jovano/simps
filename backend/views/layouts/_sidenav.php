<?php

use yii\helpers\Url;
$url = Yii::$app->request->url;
$currentUrl = $this->context->route;

?>
<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Halaman</div>
                            <a class="nav-link <?= $currentUrl == "site/dashboard" ? "active" : "" ?>" href="<?= Url::toRoute(['site/dashboard']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Aksi</div>
                            <a class="nav-link <?= $currentUrl == "student/index" || $currentUrl == "student/create" || $currentUrl == "student/view" || $currentUrl == "student/update" || $currentUrl == "student/delete" ? "active" : "" ?>" href="<?= Url::toRoute(['site/student']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                                Data Siswa
                            </a>
                            <a class="nav-link <?= $currentUrl == "site/billing" ? "active" : "" ?>" href="<?= Url::toRoute(['site/billing']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                                Pembayaran
                            </a>
                        </div>
                    </div>
                </nav>
            </div>