<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property integer $id
 * @property string $client_name
 *
 * @property PromocodesClients[] $promocodesClients
 * @property Promocodes[] $promocodes
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_name' => 'Client Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromocodesClients()
    {
        return $this->hasMany(PromocodesClients::className(), ['clients_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromocodes()
    {
        return $this->hasMany(Promocodes::className(), ['id' => 'promocodes_id'])->viaTable('promocodes_clients', ['clients_id' => 'id']);
    }
}
