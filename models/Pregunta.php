<?php

namespace app\models;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "pregunta".
 *
 * @property integer $id_pregunta
 * @property string $respuesta_correcta
 * @property string $tipo
 *
 */
class Pregunta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pregunta';
    }

    /**
     * @inheritdoc
    
    public function rules()
    {
        return [
            [['nombre_sector'], 'required','message' => 'Campo requerido'],
            [['nombre_sector'], 'string', 'max' => 100],
            [['nombre_sector'], 'unique','message' => 'O Sector já existe'],
        ];
    } */

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
                        'id_pregunta' => Yii::t('app', 'id'),
			'respuesta_correcta' => Yii::t('app', 'Respuesta correcta'),
			'tipo' => Yii::t('app', 'Tipo de la pregunta'),
        ];
    }
    

}
