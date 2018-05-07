<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property string $cedula
 * @property string $nombre
 * @property string $correo
 * @property string $contrasena
 * @property string $celular
 * @property String $rol
 */
class Usuario extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['cedula', 'nombre', 'correo', 'celular','contrasena'], 'required',
                'message' => 'Campo requerido'],
            [['cedula','celular'], 'integer', 'message' => 'Solo acepta números'],
            [['cedula'], 'string', 'max' => 10,'message'=>'La cedula debe ser maximo de 10 digitos'],
            [['cedula'], 'string', 'min' => 7,'message'=>'La cedula debe ser minima de 7 digitos'],
            //[['cedula'], 'match', 'pattern' => "/^.(9,10)+$/",'message'=>'La cedula debe ser de 10 digitos'],
            [['cedula'], 'unique', 'message' => 'La cedula ya existe'],
            [['correo'], 'unique', 'message' => 'El correo ya existe'],
            [['celular'], 'integer', 'message' => 'Solo acepta números'],
            [['correo'], 'email', 'message' => 'Formato invalido'],
        ];
    }
   
    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'cedula' => Yii::t('app', 'Cedula'),
            'nombre' => Yii::t('app', 'Nombre Completo'),
            'correo' => Yii::t('app', 'Correo'),
            'contrasena' => Yii::t('app', 'Password'),
            'celular' => Yii::t('app', 'Celular'),
            'rol' => \Yii::t('app', 'rol'),
            'presento_examen' => \Yii::t('app', 'Presento el examen')
        ];
    }
    
    /**Método para obtener todos los sectores de la base de datos;
     * 
     * @return type
     */
    public function getUsuario($id) {
        return Usuario::findOne($id);
    }

}
