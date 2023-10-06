<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SaphirAngel
 * Date: 13/09/12
 * Time: 10:46
 * To change this template use File | Settings | File Templates.
 */

define ('DEFAULT_DATE_FORMAT', 'Y-m-d');
define ('DEFAULT_TIME_FORMAT', 'H:i:s');

class DateFilter
{

    public static function date_time($key, $value, $options = array(), $evalStatus = true)
    {
        $date = date_create($value);
        if (!$date) return false;

        if (!$evalStatus) return true;
        return ['result' => $date];
    }

    public static function date_interval($key, $value, $options = array(), $param = array(), $evalStatus = true)
    {
        $separator = '-';
        if (is_array($param) && count($param) == 1) $separator = $param[0];
        else if (is_string($param) && !empty($param)) $separator = $param;

        $dateSplit = preg_split('/'.$separator.'/', $value);
        if (count($dateSplit) == 2) {
            if (self::date_time('', $dateSplit[0]) !== false && self::date_time('', $dateSplit[1]) !== false) {
                if (!$evalStatus) return true;

                $result[0] = date_create($dateSplit[0]);
                $result[1] = date_create($dateSplit[1]);

                return ['result' => $result];
            }
        }
        return false;
    }

    public static function get_check_functions()
    {
        $functions[] = ['id' => 'd', 'name' => 'date', 'class' => 'DateFilter', 'function' => 'date_time', 'options' => []];

        return $functions;
    }

    public static function get_advance_check_functions()
    {
        $functions[] = ['id' => 'date_interval', 'name' => 'date interval', 'class' => 'DateFilter', 'function' => 'date_interval', 'options' => []];

        return $functions;
    }
}
