<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductSearch represents the model behind the search form about `app\models\Product`.
 */
class ProductSearch extends Product
{

    public $text;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
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
        $query = Product::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 30],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if ($this->text) {
            $query->joinWith([
                    'supplier' => function ($q) {
                        $q->from(Supplier::tableName() . ' supplier');
                    },
                    'group' => function ($q) {
                        $q->from(SupplierGroup::tableName() . ' group');
                    }
                ])
                ->orFilterWhere(['like', 'product.name', $this->text])
                ->orFilterWhere(['like', 'product.size_l', $this->text])
                ->orFilterWhere(['like', 'product.size_b', $this->text])
                ->orFilterWhere(['like', 'product.size_h', $this->text])
                ->orFilterWhere(['like', 'product.mark_b', $this->text])
                ->orFilterWhere(['like', 'product.volume', $this->text])
                ->orFilterWhere(['like', 'product.weight', $this->text])
                ->orFilterWhere(['like', 'product.price_without_vat', $this->text])
                ->orFilterWhere(['like', 'product.price_with_vat', $this->text])
                ->orFilterWhere(['like', 'group.title', $this->text])
                ->orFilterWhere(['like', 'supplier.title', $this->text]);
        }

        return $dataProvider;
    }
}
