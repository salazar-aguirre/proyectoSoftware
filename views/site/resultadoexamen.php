<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
?>

<?php
$f = ActiveForm::begin([
            "method" => "get",
            "enableClientValidation" => true,
        ]);
?>

    <h4>Resultados</h4>
    <table class="table table-bordered">
        <tr>
            <th><h3>Sección</h3></th>
            <th><h3>Respuestas buenas</h3></th>            
            <th><h3>Nivel</h3></th>
        </tr>
        
        <tr>
            <th>Listening</th>
            <th><?php echo $contadorL ?></th>            
            <th><?php echo $cadenaL ?></th>
        </tr>
        
        <tr>
            <th>Reading</th>
            <th><?php echo $contadorR ?></th>            
            <th><?php echo $cadenaR ?></th>
        </tr>
        
        <tr>
            <th>General</th>
            <th><?php echo $contadorG ?></th>            
            <th><?php echo $cadenaG ?></th>
        </tr>
        
        <tr>
            <th>Writing</th>
            <th><?php echo $contadorW ?></th>            
            <th><?php echo $cadenaW ?></th>
        </tr>        
    </table>

     <h4><label>Su nivel en toda la prueba es <?php echo $cadenaTotal ?></label></h4>