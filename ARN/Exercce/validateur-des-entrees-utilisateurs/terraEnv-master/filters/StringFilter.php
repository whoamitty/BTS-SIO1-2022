<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SaphirAngel
 * Date: 13/09/12
 * Time: 10:46
 * To change this template use File | Settings | File Templates.
 */
class StringFilter
{
    public static function string($key, $value, $options = array())
    {
        if (!is_string($value)) return false;

        return true;
    }

    public static function expr($key, $value, $options = array(), $param = array())
    {
        if (!self::string($key, $value, array())) return false;
        if (count($param) == 1) {
            if (preg_match('/' . $param[0] . '/', $value)) return true;
        }
        return false;
    }

    public static function size($key, $value, $options = array(), $param = array())
    {
        if (!self::string($key, $value, array())) return false;
        if (count($param) != 2) return false;
        $min = $param[0];
        $max = $param[1];

        $size = strlen($value);
        if ($min != 'inf' && $size < $min) return false;
        if ($max != 'inf' && $size > $max) return false;

        return true;
    }

    public static function get_check_functions()
    {
        $functions[] = ['id' => 's', 'name' => 'string', 'class' => 'StringFilter', 'function' => 'string', 'options' => []];

        return $functions;
    }

    public static function get_advance_check_functions()
    {
        $functions[] = ['id' => 'regex', 'name' => 'regex', 'class' => 'StringFilter', 'function' => 'expr', 'options' => []];
        $functions[] = ['id' => 'size', 'name' => 'size', 'class' => 'StringFilter', 'function' => 'size', 'options' => []];

        return $functions;
    }
}
