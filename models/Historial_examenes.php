<?php

namespace app\models;

use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "historialExamen".
 *
 * @property integer $id_historial
 * @property string $resultado_listen
 * @property string $resultado_read
 * @property string $resultado_general
 * @property string $resultado_write 
 * @property Date $fecha_historial
 *
 * @property Usuario $fk_usuario
 */
class Historial_examenes extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'historialExamen';
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
    public function attributeLabels() {
        return [
            'id_historial' => Yii::t('app', 'id'),
            'fk_usuario' => Yii::t('app', 'Usuario'),
            'resultado_listen' => Yii::t('app', 'Resultado Listening'),
            'resultado_read' => Yii::t('app', 'Resultado Reading'),
            'resultado_general' => Yii::t('app', 'Resultado General'),
            'resultado_write' => Yii::t('app', 'Resultado Writing'),
            'resultado_total' => Yii::t('app', 'Resultado Total'),
            'fecha_historial' => Yii::t('app', 'Fue realizado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario() {
        return $this->hasMany(Usuario::className(), ['fk_usuario' => 'username']);
    }

    public function getExamenesList() {
        return ArrayHelper::map(Historial_examenes::find()->orderBy('id_historial')
                ->asArray()->all(), 'id_historial', 'resultado_listen','resultado_read',
                'resultado_general','resultado_write','fecha_historial');
    }
}
