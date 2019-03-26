<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 27.06.15
 * Time: 12:31
 * To change this template use File | Settings | File Templates.
 */

namespace app\components;

use yii\helpers\Html;
use app\helpers\StringHelper;

class DataColumn extends \yii\grid\DataColumn{

    public $length = 10;
    public $width = 0;
    public $format = 'raw';

    public function renderHeaderCell()
    {
        $this->headerOptions['style']='width: '.$this->getColumnWidth().'px';
        return parent::renderHeaderCell();
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        $attribute = $this->attribute;
        if(strlen($model->$attribute)>$this->length){
            $string = [];
            $i=0;
            foreach(explode(' ',$model->$attribute) as $word){
                if(strlen($word)>$this->length){
                    $string[$i] = StringHelper::wordwrap($word, $this->length ,' ');
                    $i++;
                }else{
                    if(!isset($string[$i])){
                        $string[$i] = $word;
                    }else{
                        $string[$i] .= (' '.$word);
                    }
                }
            }
        }else{
            $string[]=$model->$attribute;
        }

        return Html::tag('div',implode('<br>',$string),['style'=>'width: '.($this->getColumnWidth()).'px; overflow: hidden;']);
    }

    public function getColumnWidth()
    {
        if(!$this->width){
            $this->width = $this->length * 9;
        }
        return $this->width;
    }


}