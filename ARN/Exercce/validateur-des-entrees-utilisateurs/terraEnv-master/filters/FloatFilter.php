<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SaphirAngel
 * Date: 13/09/12
 * Time: 10:39
 * To change this template use File | Settings | File Templates.
 */
class FloatFilter
{
    public static function float($key, $value, $options = array())
    {
        $filterOptions = array();

        if (isset($options['positive']) && $options['positive'] == true) $filterOptions['min_range'] = 0;
        if (isset($options['negative']) && $options['negative'] == true) $filterOptions['max_range'] = 0;

        echo $value;

        return self::filter($value, $filterOptions);
    }

    public static function range($key, $value, $options = array(), $param = array()) {

        if (isset($options['range']) && $options['range'] == 'true' && count($param) == 2) {
            $min = $param[0];
            $max = $param[1];

            if (is_numeric($min)) $filterOptions['min_range'] = $min;
            if (is_numeric($max)) $filterOptions['max_range'] = $max;
        }

        return self::filter($value, $filterOptions);
    }

    private static function filter($value, $options) {
        if (filter_var($value, FILTER_VALIDATE_FLOAT, array('options' => $options)) === false) return false;
        return true;
    }

    public static function get_check_functions() {
        $functions[] = ['id' => 'f', 'name' => 'float', 'class' => 'FloatFilter',  'function' => 'float', 'options' => []];
        $functions[] = ['id' => 'pf', 'name' => 'positive float', 'class' => 'FloatFilter', 'function' => 'float', 'options' => ['positive' => true]];
        $functions[] = ['id' => 'nf', 'name' => 'negative float', 'class' => 'FloatFilter', 'function' => 'float', 'options' => ['negative' => true]];

        return $functions;
    }

    public static function get_advance_check_functions() {
        $functions[] = ['id' => 'fs_range', 'name' => 'range float', 'class' => 'FloatFilter', 'function' => 'float', 'options' => ['range' => true]];

        return $functions;
    }
}
