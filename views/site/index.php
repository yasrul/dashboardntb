<?php

use yii\helpers\Html;

/* @var $this yii\web\View */


$this->title = 'Dashboard NTB';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>DASHBOARD INFORMASI TERINTEGRASI</h1>

        <p class="lead">Layanan Informasi Pembangunan Pemerintah Provinsi NTB  </p>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h3>DINAS KOMUNIKASI INFORMATIKA DAN STATISTIK</h3>
                <p><?= Html::a('Sistem Informasi Presensi Terintegrasi', ['kominfotik/sisensi']); ?></p>
                
            </div>
            <div class="col-lg-4">
                <h3>BADAN PENGELOLA KEUANGAN DAN ASET DAERAH</h3>
                <p><?= Html::a('Isi Program Perangkat Daerah', ['bpkad/set-program']) ?></p>
                 
            </div>
            <div class="col-lg-4">
                <h3>BADAN PERENCANAAN PEMBANGUNAN DAN PENELITIAN DAERAH</h3>

                <p>Percobaan Tiga</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4">
                <h3>BADAN PENGELOLAAN PENDAPATAN DAERAH</h3>
            </div>
            <div class="col-lg-4">
                <h3>BADAN PENANAMAN MODAN DAN PERIJINAN TERPADU SATU PINTU</h3>
            </div>
            <div class="col-lg-4">
                <h3>BIRO ORGANISASI</h3>
            </div>
        </div>

    </div>
</div>
