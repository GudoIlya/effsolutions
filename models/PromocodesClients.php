<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "promocodes_clients".
 *
 * @property integer $promocodes_id
 * @property integer $clients_id
 *
 * @property Clients $clients
 * @property Promocodes $promocodes
 */
class PromocodesClients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promocodes_clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promocodes_id', 'clients_id'], 'required'],
            [['promocodes_id', 'clients_id'], 'unique', 'targetAttribute' => ['promocodes_id', 'clients_id']],
            [['promocodes_id', 'clients_id'], 'integer'],
            [['clients_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['clients_id' => 'id']],
            [['promocodes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Promocodes::className(), 'targetAttribute' => ['promocodes_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'promocodes_id' => 'Promocodes ID',
            'clients_id' => 'Clients ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasOne(Clients::className(), ['id' => 'clients_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromocodes()
    {
        return $this->hasOne(Promocodes::className(), ['id' => 'promocodes_id']);
    }
}
