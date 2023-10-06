<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SaphirAngel
 * Date: 13/09/12
 * Time: 11:00
 * To change this template use File | Settings | File Templates.
 */
class ArrayFilter
{
    public static function arr($key, $value, $options = array())
    {
        if (!is_array($value)) return false;

        return true;
    }

    public static function in($key, $value, $options = array(), $param = array()) {
        if (!is_array($param)) return false;
        if (!in_array($value, $param)) return false;

        return true;
    }

    public static function get_check_functions() {
        $functions[] = ['id' => 'arr', 'name' => 'array', 'class' => 'ArrayFilter',  'function' => 'arr', 'options' => []];

        return $functions;
    }

    public static function get_advance_check_functions() {
        $functions[] = ['id' => 'in', 'name' => 'in array', 'class' => 'ArrayFilter',  'function' => 'in', 'options' => []];

        return $functions;
    }
}
