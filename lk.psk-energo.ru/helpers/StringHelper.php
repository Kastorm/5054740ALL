<?php
/**
 * Created by JetBrains PhpStorm.
 * User: egor
 * Date: 27.06.15
 * Time: 12:19
 * To change this template use File | Settings | File Templates.
 */

namespace app\helpers;

class StringHelper extends \yii\helpers\BaseStringHelper {

    public static function wordwrap($str,$len,$what){

        $total='';
        $from=0;
        $str_length = preg_match_all('/[\x00-\x7F\xC0-\xFD]/', $str, $var_empty);
        $while_what = $str_length / $len;
        $i=0;
        while($i <= round($while_what)){
            $string = preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
                '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
                '$1',$str);
            $total .= $string.$what;
            $from = $from+$len;
            $i++;
        }
        return $total;
    }
}