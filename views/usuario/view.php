<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->cedula;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id' => $model->cedula], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'id' => $model->cedula], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Esta seguro que quiere eliminar el ususario?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cedula',
            'nombre',
            'correo',
            'celular',
        ],
    ]) ?>

</div>
