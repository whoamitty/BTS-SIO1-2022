<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SaphirAngel
 * Date: 13/09/12
 * Time: 10:45
 * To change this template use File | Settings | File Templates.
 */
class booleanFilter
{
    public static function boolean($key, $value, $options = array())
    {
        if (filter_var($value, FILTER_VALIDATE_BOOLEAN, array('flags' => FILTER_NULL_ON_FAILURE)) === null) return false;

        return true;
    }

    public static function get_check_functions() {
        $functions[] = ['id' => 'b', 'name' => 'boolean', 'class' => 'BooleanFilter',  'function' => 'boolean', 'options' => []];

        return $functions;
    }

    public static function get_advance_check_functions() {
        return array();
    }
}
