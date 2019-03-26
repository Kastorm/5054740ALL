<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tender;

/**
 * TenderSearch represents the model behind the search form about `app\models\Tender`.
 */
class TenderSearch extends Tender
{
    public $text;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'updated_at', 'created_at', 'created_by', 'updated_by'], 'integer'],
            [['login', 'password', 'links', 'description','text'], 'safe'],
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
        $query = Tender::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            exit;
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query
            ->andFilterWhere(['like', 'login', $this->login])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'links', $this->links])
            ->andFilterWhere(['like', 'description', $this->description]);

        if($this->text){
            $query
                ->orFilterWhere(['like', 'login', $this->text])
                ->orFilterWhere(['like', 'links', $this->text])
                ->orFilterWhere(['like', 'title', $this->text])
                ->orFilterWhere(['like', 'description', $this->text]);
        }
        return $dataProvider;
    }
}
