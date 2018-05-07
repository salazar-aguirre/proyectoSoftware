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
            <th>Usuario</th>
            <th>Cedula</th>
            <th>Listening</th>
            <th>Reading</th>
            <th>General</th>
            <th>Writing</th>            
            <th>Total</th>
            <th>Fecha</th>
            <th></th>
        </tr>
        <?php foreach ($modeloHistorial as $row): ?>
            <tr>
                <?php $usuario = (new app\models\Usuario)->getUsuario($row->fk_usuario); ?>
                <td><?= $row->id_historial ?></td>
                <td><?= $usuario->nombre ?></td>
                <td><?= $row->fk_usuario ?></td>
                <td><?= $row->resultado_listen ?></td>
                <td><?= $row->resultado_read ?></td>
                <td><?= $row->resultado_general ?></td>
                <td><?= $row->resultado_write ?></td>                
                <td><?= $row->resultado_total ?></td>
                <td><?= $row->fecha_historial ?></td>
                <td><a href="<?=
                    Url::toRoute(['detalleexamen', 
                        "id_historial" => $row->id_historial])
                    ?>">Mostrar</a></td> 
            </tr>
        <?php endforeach ?>
    </table>
<?=
LinkPager::widget([
    "pagination" => $pages,
]);
