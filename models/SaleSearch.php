<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RecordForm;


/**
 * RecordSearch represents the model behind the search form of `app\models\RecordForm`.
 */
class ProductSearch extends Sales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['quantity', 'required'],
            ['quantity', 'integer'],

            [['productID'],'required' ],
            [['customerID'],'required' ],



            ['amount', 'required'],
            ['amount', 'integer'],

            ['comments', 'required'],
        }

    /**
     * {@inheritdoc}
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
        $query = sSalesrm::find();

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
            'product_name' => $this->product_name,
            'description' => $this->description,
            'UnitInStock' => $this->UnitInStock,
            'stock' => $this->stock,
            'wholesale_cost' => $this->wholesale_cost,
            'retail_cost' => $this->retail_cost,
            'alert_level' => $this->alert_level,

            'productID' => $this->productID,


        ]);

        $query->andFilterWhere(['like','product_name',$this->product_name,
        ])
            ->andFilterWhere(['like', 'description',$this->description,
            ])
            ->andFilterWhere(['like','UnitInStock',$this->UnitInStock,
            ])
            ->andFilterWhere(['like','stock',$this->stock,
            ])
            ->andFilterWhere(['like','wholesale_cost',$this->wholesale_cost,
            ])
            ->andFilterWhere(['like','retail_cost', $this->retail_cost,
            ])
            ->andFilterWhere(['like','alert_level', $this->alert_level,
            ])
            ->andFilterWhere(['like','productID' ,$this->productID,

            ]);




        return $dataProvider;
    }
}
