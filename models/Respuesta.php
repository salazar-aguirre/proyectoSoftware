<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "respuesta".
 */
class Respuesta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'respuesta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['respuesta_usuario'],'required', 'message' => 'Campo requerido.'],
            ['cedula', 'string','message'=>'Una respuesta sin seleccionar'],
            //[['respuesta_usuario'], 'number', 'message' => 'Escreva só números.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_respuesta' => Yii::t('app', 'id'),
            'fk_historial' => Yii::t('app', 'Historial'),
            'fk_pregunta' => Yii::t('app', 'Pregunta'),
            'respuesta_usuario' => Yii::t('app', 'Respondio'),
        ];
    }

}
