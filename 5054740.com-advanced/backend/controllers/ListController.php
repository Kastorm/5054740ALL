<?php

namespace backend\controllers;
use common\models\Zavod;
use yii\data\ActiveDataProvider;

class ListController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $zavods = Zavod::find()->andWhere(['status'=>1])->all();
        return $this->render('index',['zavods'=>$zavods]);
    }


    public function actionOne()
    {

        $zavods = Zavod::find()->with('gorod','groups')->all();
        return $this->render('one',['zavods'=>$zavods]);
    }

    public function actionTwo()
    {
        $zavods = Zavod::find()->with('gorod','groups')->andWhere(['status'=>1]);
        $dataProvider = new ActiveDataProvider([
            'query' => $zavods,
            'Pagination'=>[
                'PageSize'=>10,
            ],
        ]);
        return $this->render('two',['dataProvider'=>$dataProvider]);
    }

}
