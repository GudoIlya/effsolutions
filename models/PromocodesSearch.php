<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Promocodes;


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
}
