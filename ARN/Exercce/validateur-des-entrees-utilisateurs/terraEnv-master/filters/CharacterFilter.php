<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SaphirAngel
 * Date: 13/09/12
 * Time: 16:47
 * To change this template use File | Settings | File Templates.
 */
class CharacterFilter
{
    function character($key, $value, $options = array())
    {
        $enabledClasses = ['alnum', 'alpha', 'blank',
            'ctrl', 'digit', 'graph',
            'print', 'punct', 'space',
            'upper', 'xdigit'];

        if (!is_string($value) || strlen($value) != 1) return false;
        if (isset($options['classe']) && !in_array($options['classe'], $enabledClasses)) return false;

        if (isset($options['classe']) && preg_match('/[[:' . $options['classe'] . ':]]/', $value) == 0) return false;

        return true;
    }

    function character_type($key, $value, $options = array(), $param = array())
    {
        $enabledClasses = ['alnum', 'alpha', 'blank',
            'ctrl', 'digit', 'graph',
            'print', 'punct', 'space',
            'upper', 'xdigit'];

        if (!character($key, $value, array())) return false;
        if (count($param) != 1) return false;

        $class = $param[0];
        if (!in_array($class, $enabledClasses)) return false;

        if (preg_match('/[[:' . $class . ':]]/', $value) == 0) return false;

        return true;
    }

    public static function get_check_functions()
    {
        $functions[] = ['id' => 'c', 'name' => 'character', 'class' => 'CharacterFilter', 'function' => 'character', 'options' => []];

        return $functions;
    }

    public static function get_advance_check_functions()
    {
        $functions[] = ['id' => 'c_type', 'name' => 'character type', 'class' => 'CharacterFilter', 'function' => 'character_type', 'options' => []];

        return $functions;
    }
}
