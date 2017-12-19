<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Promocodes;
use app\models\PromocodesClients;
use yii\data\SqlDataProvider;

/**
 * PromocodesSearch represents the model behind the search form about `app\models\Promocodes`.
 */
class PromocodesSearch extends Promocodes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'status'], 'integer'],
            [['begin_date', 'end_date', 'promocode'], 'safe'],
            [['compensation'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $statusExpression = new \yii\db\Expression("CASE promocodes.status WHEN  1 then 'Активен' ELSE 'Не активен' END");
        $query = Promocodes::find()
                ->select(['promocodes.*', 
                'st' => $statusExpression,
                'cities.city_name as city_name'])
                ->joinWith('city');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'begin_date' => $this->begin_date,
            'end_date' => $this->end_date,
            'city_id' => $this->city_id,
            'status' => $this->status,
            'compensation' => $this->compensation,
        ]);

        $query->andFilterWhere(['like', 'promocode', $this->promocode]);

        return $dataProvider;
    }


    /**
    * Метод возвращает данные о промокоде (время начала, время окончания действия, компенсация, тарифная зона и статус)
    */
    public function getPromocodeInfo($promocode_name) {
        $provider = new SqlDataProvider([
            'params' => [':promocode' => $promocode_name],
            'sql' => '
                    SELECT promocodes.begin_date, promocodes.end_date, promocodes.compensation,
                    cities.city_name, promocodes.status
                    FROM promocodes
                    LEFT JOIN cities ON promocodes.city_id = cities.id
                    WHERE promocodes.promocode = :promocode'
        ]);
        $models = $provider->getModels()[0];
        return $models;
    }

    public function activateDiscount() {

        $promocode_name = Yii::$app->request->get('promocode_name');
        $city_id = Yii::$app->request->get('city_id');

        $promocode = Promocodes::find()->where(['promocode' => $promocode_name, 'city_id' => $city_id])->one();
        $promocode_clients = new PromocodesClients();
        $promocode_clients->promocodes_id = $promocode->id;
        $promocode_clients->clients_id    = 1;
        if($promocode_clients->save()) {
            $promocode->status = 1;
            return $promocode->compensation;
        }
                
        return ['error' => 'Произошла ошибка'];
    }
}
