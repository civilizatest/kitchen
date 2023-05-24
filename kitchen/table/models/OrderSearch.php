<?php

namespace app\modules\table\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Order;

/**
 * Поисковая модель для заказов
 */
class OrderSearch extends Order
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'created_at', 'updated_at', 'status_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Метод создает data provider, содержащий необходимые записи, соответствующие полученным параметрам
     *
     * @param          $params
     * @return ActiveDataProvider|SqlDataProvider
     */
    public function search($params)
    {
        $this->load($params, 'OrderSearch');
        $query = Order::find();
        $dataProvider = new ActiveDataProvider([
            'query'      => $query,
            'sort'       => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
            'pagination' => ['pageSize' => 20]
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'            => $this->id,
        ]);

        $query->andfilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
