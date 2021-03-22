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

                            <?php if(Yii::$app->user->identity->level == 2): ?>
                            <a class="nav-link <?= $currentUrl == "student/index" || $currentUrl == "student/create" || $currentUrl == "student/view" || $currentUrl == "student/update" || $currentUrl == "student/delete" ? "active" : "" ?>" href="<?= Url::toRoute(['student/index']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-friends"></i></div>
                                Data Siswa
                            </a>
                            <a class="nav-link <?= $currentUrl == "petugas/index" || $currentUrl == "petugas/create" || $currentUrl == "petugas/view" || $currentUrl == "petugas/update" || $currentUrl == "petugas/delete" ? "active" : "" ?>" href="<?= Url::toRoute(['petugas/index']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                                Data Petugas
                            </a>

                            <a class="nav-link <?= $currentUrl == "classes/index" || $currentUrl == "classes/create" || $currentUrl == "classes/view" || $currentUrl == "classes/update" || $currentUrl == "classes/delete" ? "active" : "" ?>" href="<?= Url::toRoute(['classes/index']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-door-open"></i></div>
                                Data Kelas
                            </a>

                            <a class="nav-link <?= $currentUrl == "spp/index" || $currentUrl == "spp/create" || $currentUrl == "spp/view" || $currentUrl == "spp/update" || $currentUrl == "spp/delete" ? "active" : "" ?>" href="<?= Url::toRoute(['spp/index']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-check-alt"></i></div>
                                Data Pembayaran
                            </a>
                            
                            <a class="nav-link <?= $currentUrl == "site/billing" ? "active" : "" ?>" href="<?= Url::toRoute(['site/billing']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                                Pembayaran
                            </a>

                            <a class="nav-link <?= $currentUrl == "site/report" ? "active" : "" ?>" href="<?= Url::toRoute(['site/report']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-signal"></i></div>
                                Laporan & Riwayat
                            </a>
                            <?php else: ?>
                                <a class="nav-link <?= $currentUrl == "site/billing" ? "active" : "" ?>" href="<?= Url::toRoute(['site/billing']); ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                                    Pembayaran
                                </a>

                                <a class="nav-link <?= $currentUrl == "site/report" ? "active" : "" ?>" href="<?= Url::toRoute(['site/report']); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-signal"></i></div>
                                Laporan & Riwayat
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>