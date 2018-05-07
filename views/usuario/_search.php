<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmpresaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cedula') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'correo') ?>

    <?= $form->field($model, 'celular') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Buscar'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
