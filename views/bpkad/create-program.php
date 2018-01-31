<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Create Program';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index">
    <div class="body-content">
        <h3>Create Program</h3>
        <div class="form">
            <?php $form = ActiveForm::begin([
                'action' => ['bpkad/set-program'],
                'method' => 'post'
            ]); ?>
            <?= $form->field($model, 'Tahun')->textInput() ?>
            <?= $form->field($model, 'Kd_Urusan')->textInput() ?>
            <?= $form->field($model, 'Kd_Bidang')->textInput() ?>
            <?= $form->field($model, 'Kd_Unit')->textInput() ?>
            <?= $form->field($model, 'Kd_Sub')->textInput() ?>
            <?= $form->field($model, 'Kd_Prog')->textInput() ?>
            <?= $form->field($model, 'ID_Prog')->textInput() ?>
            <?= $form->field($model, 'Ket_Program')->textInput() ?>
            <?= $form->field($model, 'Tolak_Ukur')->textInput() ?>
            <?= $form->field($model, 'Target_Angka')->textInput() ?>
            <?= $form->field($model, 'Target_Uraian')->textInput() ?>
            <?= $form->field($model, 'Kd_Urusan1')->textInput() ?>
            <?= $form->field($model, 'Kd_Bidang1')->textInput() ?>
            
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
            
        </div>
    </div>
</div>
