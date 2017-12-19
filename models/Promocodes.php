<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "promocodes".
 *
 * @property integer $id
 * @property string $begin_date
 * @property string $end_date
 * @property integer $city_id
 * @property string $promocode
 * @property integer $status
 * @property string $compensation
 *
 * @property Cities $city
 */
class Promocodes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promocodes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['begin_date', 'end_date'], 'safe'],
            [['begin_date', 'end_date'], 'date', 'format' => 'php:d.m.Y'],
            ['end_date', 'compare', 'compareAttribute' => 'begin_date', 'operator' => '>', 'type' => 'date'],
            [['city_id'], 'required'],
            [['city_id', 'status'], 'integer'],
            [['compensation'], 'number'],
            [['promocode'], 'string', 'max' => 255],
            [['promocode'], 'unique'],
            [['promocode', 'city_id'], 'unique', 'targetAttribute' => ['promocode', 'city_id']],
            [['promocode'], 'match', 'not' => true, 'pattern' => "/[^a-zA-Z_-]/", 'message' => 'Название промокода должно состоять только из латинских символов'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['begin_date', 'end_date', 'city_id', 'compensation', 'promocode'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'begin_date' => 'Начало действия',
            'end_date' => 'Окончание действия',
            'city_id' => 'Зона действия',
            'promocode' => 'Название промокода',
            'status' => 'Активность',
            'compensation' => 'Величина компенсации',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {   
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    public function getStatus() {
        return ['1' => 'Активен', '0' => 'Не активен'];
    }
    /**
    * Форматирование даты перед сохранением
    */
    public function beforeSave($insert) {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->begin_date = Yii::$app->formatter->asDatetime($this->begin_date, 'php:Y-m-d');
        $this->end_date = Yii::$app->formatter->asDatetime($this->end_date, 'php:Y-m-d');
        return true;
    }

}
