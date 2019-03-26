<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Supplier;

/**
 * SupplierSearch represents the model behind the search form about `app\models\Supplier`.
 */
class SupplierSearch extends Supplier
{
    public $text;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'updated_at', 'created_at', 'created_by', 'updated_by'], 'integer'],
            [['text', 'title', 'inn', 'responsible', 'phone', 'address', 'comment', 'email'], 'safe'],
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
        $query = Supplier::find()->joinWith('group');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'group_id' => $this->group_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'supplier.title', $this->title])
            ->andFilterWhere(['like', 'supplier.inn', $this->inn])
            ->andFilterWhere(['like', 'supplier.responsible', $this->responsible])
            ->andFilterWhere(['like', 'supplier.phone', $this->phone])
            ->andFilterWhere(['like', 'supplier.address', $this->address])
            ->andFilterWhere(['like', 'supplier.comment', $this->comment])
            ->andFilterWhere(['like', 'supplier.email', $this->email]);

        if($this->text) {
            $query->andFilterWhere(['like', 'supplier.title', $this->text])
                ->orFilterWhere(['like', 'supplier.inn', $this->text])
                ->orFilterWhere(['like', 'supplier.responsible', $this->text])
                ->orFilterWhere(['like', 'supplier.phone', $this->text])
                ->orFilterWhere(['like', 'supplier.address', $this->text])
                ->orFilterWhere(['like', 'supplier.comment', $this->text])
                ->orFilterWhere(['like', 'supplier.email', $this->text])
                ->orFilterWhere(['like', 'supplier_group.title', $this->text]);
        }

        return $dataProvider;
    }
}