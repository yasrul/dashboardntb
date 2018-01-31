<?php

use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\date\DatePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */

$this->title = 'Presensi Harian OPD';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-index">
   
    <div class="body-content">
        <h3>Presensi Harian OPD</h3>
            <div class="form">
                <?php $form = ActiveForm::begin([
                    'action' => ['kominfotik/sisensi'],
                    'method' => 'get',
                ]); ?>
                <?= $form->field($model, 'tgl')->label('Tanggal')->widget(DatePicker::className(), [
                    'options' => ['placeholder' => 'Tanggal Hadir', 'style'=>'width : 400px'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                        'todayHighlight' => true,
                        
                    ]
                ]); ?>
                <?= $form->field($model, 'deptid')->label('Perangkat Daerah')->widget(Select2::className(),[
                    'data' => $listOPD,
                    'options' => ['placeholder' => '[ Pilih Perangkat Daerah ]'],
                    'pluginOptions' => ['allowClear' => TRUE, 'width'=>'500px']
                ]); ?>
                    
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
                    ['attribute'=>'name', 'contentOptions'=>['style'=>'width: 30%']],
                    ['attribute'=>'Datang', 'contentOptions'=>['style'=>'width: 10%']],
                    ['attribute'=>'Pulang', 'contentOptions'=>['style'=>'width: 10%']]
                ]
                ])
            ?> 
    </div>
</div>

