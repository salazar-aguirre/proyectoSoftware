<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php
$f = ActiveForm::begin([
            "method" => "post", 
            "enableClientValidation" => true,
        ]);
?>
<div class="row">
    <div class="well">
        <h2>Listening Test A </h2>
        <h4>Si deja un campo con "Seleccione la respuesta" esta se contara auntomaticamente mala </h4>
    </div>
</div>
<?php $contadorTA1 = '0'; ?>
<?php $contadorTA2 = '5'; ?>
<?php for ($i = 0; $i < 5; $i++): ?>
    <div class="row">
        <div class="form-group">
            <div class="col-md-1">
                <?php $contadorTA1++ ?>
                <h4><label><?php echo $contadorTA1 ?></label></h4>
            </div>
            <div class="col-md-3">
                <?php
                echo $f->field($modeloRespuestaL, "respuesta_usuario")->dropDownList(
                        array("Selecione la respuesta", "A", "B", "C", "D"), ['name' => 'respuestasL[' . $contadorTA1 . "L" . ']'])->label(false);
                ?>
            </div>
            <div class="col-md-2">   
            </div>
            <div class="col-md-1">
                <?php $contadorTA2++ ?>
                <h4><label><?php echo $contadorTA2 ?></label></h4>
            </div>
            <div class="col-md-3">
                <?php
                echo $f->field($modeloRespuestaL, "respuesta_usuario")->dropDownList(
                        array("Selecione la respuesta", "A", "B", "C", "D"), ['name' => 'respuestasL[' . $contadorTA2 . "L" . ']'])->label(false);
                ?>
            </div>
        </div>
    </div>
<?php endfor; ?>    

<div class="row">
    <div class="well">
        <h2>Reading Test A</h2>
    </div>
</div>

<?php $contadorR1 = '0'; ?>
<?php $contadorR2 = '5'; ?>
<?php for ($i = 0; $i < 5; $i++): ?>
    <div class="row">
        <div class="form-group">
            <div class="col-md-1">
                <?php $contadorR1++ ?>
                <h4><label><?php echo $contadorR1 ?></label></h4>
            </div>
            <div class="col-md-3">
                <?php
                echo $f->field($modeloRespuestaL, "respuesta_usuario")->dropDownList(
                        array("Selecione la respuesta", "A", "B", "C", "D"), ['name' => 'respuestasR[' . $contadorR1 . "R" . ']'])->label(false);
                ?>
            </div>
            <div class="col-md-2">   
            </div>
            <div class="col-md-1">
                <?php $contadorR2++ ?>
                <h4><label><?php echo $contadorR2 ?></label></h4>
            </div>
            <div class="col-md-3">
                <?php
                echo $f->field($modeloRespuestaL, "respuesta_usuario")->dropDownList(
                        array("Selecione la respuesta", "A", "B", "C", "D"), ['name' => 'respuestasR[' . $contadorR2 . "R" . ']'])->label(false);
                ?>
            </div>
        </div>
    </div>
<?php endfor; ?>    

<div class="row">
    <div class="well">
        <h2>General Test</h2>
    </div>
</div>
<?php $contadorG1 = '0'; ?>
<?php $contadorG2 = '20'; ?>
<?php $contadorG3 = '40'; ?>
<?php for ($i = 0; $i < 20; $i++): ?>
    <div class="row">
        <div class="form-group">
            <div class="col-md-1">
                <?php $contadorG1++ ?>
                <h4><label><?php echo $contadorG1 ?></label></h4>
            </div>
            <div class="col-md-3">
                <?php
                echo $f->field($modeloRespuestaL, "respuesta_usuario")->dropDownList(
                        array("Selecione la respuesta", "A", "B", "C", "D"), ['name' => 'respuestasG[' . $contadorG1 . "G" . ']'])->label(false);
                ?>
            </div>
            <div class="col-md-1">
                <?php $contadorG2++ ?>
                <h4><label><?php echo $contadorG2 ?></label></h4>
            </div>
            <div class="col-md-3">
                <?php
                echo $f->field($modeloRespuestaL, "respuesta_usuario")->dropDownList(
                        array("Selecione la respuesta", "A", "B", "C", "D"), ['name' => 'respuestasG[' . $contadorG2 . "G" . ']'])->label(false);
                ?>
            </div>
            <div class="col-md-1">
                <?php $contadorG3++ ?>
                <h4><label><?php echo $contadorG3 ?></label></h4>
            </div>
            <div class="col-md-3">
                <?php
                echo $f->field($modeloRespuestaL, "respuesta_usuario")->dropDownList(
                        array("Selecione la respuesta", "A", "B", "C", "D"), ['name' => 'respuestasG[' . $contadorG3 . "G" . ']'])->label(false);
                ?>
            </div>
        </div>
    </div>
<?php endfor; ?>    

<div class="row">
    <div class="well">
        <h2>WRITING TEST</h2>
    </div>
</div>

<div class="col-md-1">
    <h3></h3>
</div>
<div class="col-md-11">
    <h3>Part 1</h3>
</div>
<?php $contadorW1 = '0'; ?>
<?php for ($i = 0; $i < 10; $i++): ?>
    <div class="row">
        <div class="form-group">
            <div class="col-md-1">
                <?php $contadorW1++ ?>
                <h4><label><?php echo $contadorW1 ?></label></h4>
            </div>
            <div class="col-md-11">
                <?=
                $f->field($modeloRespuestaL, 'respuesta_usuario')->textInput(
                        ['name' => 'respuestasW[' . $contadorW1 . "W" . ']'])->label(false)
                ?>
            </div>
        </div>
    </div>
<?php endfor; ?>

<div class="col-md-1">
    <h3></h3>
</div>
<div class="col-md-11">
    <h3>Part 2</h3>
</div>
<?php $contadorW2 = '0'; ?>
<?php $contadorAuxW = '10'; ?>
<?php for ($i = 0; $i < 5; $i++): ?>
    <div class="row">
        <div class="form-group">
            <div class="col-md-1">
                <?php $contadorW2++ ?>
                <?php $contadorAuxW ++; ?>
                <h4><label><?php echo $contadorW2 ?></label></h4>
            </div>
            <div class="col-md-11">
                <?=
                $f->field($modeloRespuestaL, 'respuesta_usuario')->textInput(
                        ['name' => 'respuestasW2[' . $contadorAuxW . "W" . ']'])->label(false)
                ?>
            </div>
        </div>
    </div>
<?php endfor; ?>

<div class="form-group">
    <div class="col-sm-offset-5 col-sm-12">
        <?=
        Html::submitButton(Yii::t('app', 'Enviar respuestas'), ['class' => 'btn btn-success'])
        ?>            
    </div>        
</div>

<?php ActiveForm::end(); ?>