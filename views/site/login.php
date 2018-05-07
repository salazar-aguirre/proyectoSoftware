<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar sesión';
$this->params['breadcrumbs'][] = $this->title;
?>

 
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Por favor complete los siguientes campos para iniciar sesión:</p>
     <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label("Usuario") ?>

        <?= $form->field($model, 'password')->passwordInput()->label("Contraseña") ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ->label("Recordarme")?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Iniciar sesiòn', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>   
   <div class="col-md-9">
        <p><img src="..\obedece.jpg" class="img-rounded" alt="Cinque Terre" alt="imagen ASW" width="400" height="200" ></p>
    </div>
    

    <div class="col-lg-offset-1" style="color:#999;">
        
    </div>
</div>
