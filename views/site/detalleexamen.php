<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = "Detalle examen con id número ".$id_examen_detalle. " presentado por"
        ." el(la) estudiante ".$nombreUsuario." el día ".$fechaHistorial." resultado final ".$resultadoTotal;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Historiales'), 'url' => ['examenespresentados']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$f = ActiveForm::begin([
            "method" => "get",
            "enableClientValidation" => true,
        ]);
?>

<div class="row">
    <div class="well">
        <h4>Listening <?php echo ": ".$resultadoL ?></h4>
    </div>
</div>
<table class="table table-bordered">    
    <?php $contadorL = '0'; ?>
    <tr>
        <?php foreach ($respuestasL1 as $row): ?>
            <?php $contadorL++ ?>            
            <th><h4><b><?php echo $contadorL ?></b></h4></th>
            <td><h6><?= $row->respuesta_usuario ?></h6></td>               
        <?php endforeach ?>
    </tr> 
    <tr>
        <?php foreach ($respuestasL2 as $row): ?>
            <?php $contadorL++ ?>            
            <th><h4><b><?php echo $contadorL ?></b></h4></th>
            <td><h6><?= $row->respuesta_usuario ?></h6></td>             
        <?php endforeach ?>
    </tr>
</table>

<div class="row">
    <div class="well">
        <h4>Reading <?php echo ": ".$resultadoR ?></h4>
    </div>
</div>
<table class="table table-bordered">    
    <?php $contadorR = '0'; ?>
    <tr>
        <?php foreach ($respuestasR1 as $row): ?>
            <?php $contadorR++ ?>            
            <th><h4><b><?php echo $contadorR ?></b></h4></th>
            <td><h6><?= $row->respuesta_usuario ?></h6></td>               
        <?php endforeach ?>
    </tr> 
    <tr>
        <?php foreach ($respuestasR2 as $row): ?>
            <?php $contadorR++ ?>            
            <th><h4><b><?php echo $contadorR ?></b></h4></th>
            <td><h6><?= $row->respuesta_usuario ?></h6></td>             
        <?php endforeach ?>
    </tr>
</table>

<div class="row">
    <div class="well">
        <h4>General <?php echo ": ".$resultadoG ?></h4>
    </div>
</div>
<table class="table table-bordered">    
    <?php $contadorG = '0'; ?>
    <tr>
        <?php foreach ($respuestasG1 as $row): ?>
            <?php $contadorG++ ?>            
            <th><h4><b><?php echo $contadorG ?></b></h4></th>
            <td><h6><?= $row->respuesta_usuario ?></h6></td>               
        <?php endforeach ?>
    </tr> 
    <tr>
        <?php foreach ($respuestasG2 as $row): ?>
            <?php $contadorG++ ?>            
            <th><h4><b><?php echo $contadorG ?></b></h4></th>
            <td><h6><?= $row->respuesta_usuario ?></h6></td>             
        <?php endforeach ?>
    </tr>
    <tr>
        <?php foreach ($respuestasG3 as $row): ?>
            <?php $contadorG++ ?>            
            <th><h4><b><?php echo $contadorG ?></b></h4></th>
            <td><h6><?= $row->respuesta_usuario ?></h6></td>               
        <?php endforeach ?>
    </tr> 
    <tr>
        <?php foreach ($respuestasG4 as $row): ?>
            <?php $contadorG++ ?>            
            <th><h4><b><?php echo $contadorG ?></b></h4></th>
            <td><h6><?= $row->respuesta_usuario ?></h6></td>             
        <?php endforeach ?>
    </tr>
    <tr>
        <?php foreach ($respuestasG5 as $row): ?>
            <?php $contadorG++ ?>            
            <th><h4><b><?php echo $contadorG ?></b></h4></th>
            <td><h6><?= $row->respuesta_usuario ?></h6></td>               
        <?php endforeach ?>
    </tr> 
    <tr>
        <?php foreach ($respuestasG6 as $row): ?>
            <?php $contadorG++ ?>            
            <th><h4><b><?php echo $contadorG ?></b></h4></th>
            <td><h6><?= $row->respuesta_usuario ?></h6></td>             
        <?php endforeach ?>
    </tr>
</table>

<div class="row">
    <div class="well">
        <h4>Writing <?php echo ": ".$resultadoW ?></h4>
    </div>
</div>
<table class="table table-bordered">    
    <?php $contadorW = '0'; ?>
    <?php foreach ($respuestasW as $row): ?>
        <tr>
            <?php $contadorW++ ?>            
            <th><?php echo $contadorW ?></th>
            <td><?= $row->respuesta_usuario ?></td>
        </tr> 

    <?php endforeach ?>
</table>