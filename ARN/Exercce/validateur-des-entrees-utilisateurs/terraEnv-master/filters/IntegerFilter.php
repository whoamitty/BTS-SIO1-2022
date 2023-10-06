<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SaphirAngel
 * Date: 13/09/12
 * Time: 09:41
 * To change this template use File | Settings | File Templates.
 */
class IntegerFilter
{
    public static function integer($key, $value, $options = array())
    {
        $filterOptions = array();

        if (isset($options['positive']) && $options['positive'] == true) $filterOptions['min_range'] = 0;
        if (isset($options['negative']) && $options['negative'] == true) $filterOptions['max_range'] = 0;

        return self::filter($value, $filterOptions);
    }

    public static function range($key, $value, $options = array(), $param = array()) {

        if (count($param) == 2) {
            $min = $param[0];
            $max = $param[1];

            if (is_numeric($min)) $filterOptions['min_range'] = $min;
            if (is_numeric($max)) $filterOptions['max_range'] = $max;
        }

        return self::filter($value, $filterOptions);
    }

    private static function filter($value, $options) {
        if (filter_var($value, FILTER_VALIDATE_INT, array('options' => $options)) === false) return false;
        return true;
    }

    public static function get_check_functions() {
        $functions[] = ['id' => 'i', 'name' => 'integer', 'class' => 'IntegerFilter',  'function' => 'integer', 'options' => []];
        $functions[] = ['id' => 'pi', 'name' => 'positive integer', 'class' => 'IntegerFilter', 'function' => 'integer', 'options' => ['positive' => true]];
        $functions[] = ['id' => 'ni', 'name' => 'negative integer', 'class' => 'IntegerFilter', 'function' => 'integer', 'options' => ['negative' => true]];

        return $functions;
    }

    public static function get_advance_check_functions() {
        $functions[] = ['id' => 'i_range', 'name' => 'range integer', 'class' => 'IntegerFilter', 'function' => 'range', 'options' => []];

        return $functions;
    }
}
