<?php

use yii\grid\GridView;
use yii\widgets\ActiveForm;
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
                <h2>Informasi Sistem Satu</h2>

                <p>Percobaan Satu</p>
                <?= GridView::widget([
                'dataProvider'=> $dataPresensi,
                'formatter'=>['class'=>'yii\i18n\Formatter' ,'nullDisplay'=>'Nihil'],
                //'options'=>['style'=>'width : 50%'],
                'columns'=> [
                    ['class'=>'yii\grid\SerialColumn','contentOptions'=>['style'=>'width :7%']],
                    ['attribute'=>'id', 'contentOptions'=>['style'=>'width: 10%']],
                    ['attribute'=>'userid', 'contentOptions'=>['style'=>'width: 10%']],
                    ['attribute'=>'checktime', 'contentOptions'=>['style'=>'width: 10%']],
                ]
                ])
                ?> 
                
            </div>
            <div class="col-lg-4">
                <h2>Informasi Sistem Dua</h2>

                <p>Percobaan Dua</p>
                <div class="form">
                    <?php $form2 = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                    ]); ?>
                    <?= $form2->field($model2, 'tgl'); ?>
                    <?= $form2->field($model2, 'deptid'); ?>
                    
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
                
                <?= GridView::widget([
                'dataProvider'=> $dataAbsensi,
                'formatter'=>['class'=>'yii\i18n\Formatter' ,'nullDisplay'=>'Nihil'],
                //'options'=>['style'=>'width : 50%'],
                'columns'=> [
                    ['class'=>'yii\grid\SerialColumn','contentOptions'=>['style'=>'width :7%']],
                    ['attribute'=>'userid', 'contentOptions'=>['style'=>'width: 10%']],
                    ['attribute'=>'name', 'contentOptions'=>['style'=>'width: 10%']],
                    ['attribute'=>'Datang', 'contentOptions'=>['style'=>'width: 10%']],
                    ['attribute'=>'Pulang', 'contentOptions'=>['style'=>'width: 10%']]
                ]
                ])
                ?> 
            </div>
            <div class="col-lg-4">
                <h2>Informasi Sistem Tiga</h2>

                <p>Percobaan Tiga</p>
            </div>
        </div>

    </div>
</div>
