<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>

<?php
$f = ActiveForm::begin([
            "method" => "get",
            "enableClientValidation" => true,
        ]);
?>

    <h3>Examenes presentados</h3>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Listening</th>
            <th>Reading</th>
            <th>General</th>
            <th>Writing</th>            
            <th>Total</th>
            <th>Fecha</th>
        </tr>
        <?php foreach ($modeloHistorial as $row): ?>
            <?php $cedulaUsuario = Yii::$app->user->identity->cedula;; ?>
            <?php if($row->fk_usuario== $cedulaUsuario): ?>
            <tr>
                <td><?= $row->id_historial ?></td>
                <td><?= $row->resultado_listen ?></td>
                <td><?= $row->resultado_read ?></td>
                <td><?= $row->resultado_general ?></td>
                <td><?= $row->resultado_write ?></td>                
                <td><?= $row->resultado_total ?></td>
                <td><?= $row->fecha_historial ?></td> 
            </tr>
            <?php endif;?>
        <?php endforeach ?>
    </table>
<?=
LinkPager::widget([
    "pagination" => $pages,
]);
