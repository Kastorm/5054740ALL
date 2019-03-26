<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MailingLog;

/**
 * MailingLogSearch represents the model behind the search form about `app\models\MailingLog`.
 */
class MailingLogSearch extends MailingLog
{
    public $text;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'updated_at', 'created_at', 'created_by', 'updated_by'], 'integer'],
            [['text', 'user_from', 'email_from', 'email_to', 'body'], 'safe'],
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
        $query = MailingLog::find();

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
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        if($this->text) {
            $query->andFilterWhere(['like', 'user_from', $this->text])
                ->orFilterWhere(['like', 'email_from', $this->text])
                ->orFilterWhere(['like', 'email_to', $this->text])
                ->orFilterWhere(['like', 'body', $this->text]);
        }

        return $dataProvider;
    }
}
