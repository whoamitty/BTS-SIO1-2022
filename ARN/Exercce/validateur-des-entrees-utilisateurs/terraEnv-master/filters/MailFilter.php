<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SaphirAngel
 * Date: 13/09/12
 * Time: 10:46
 * To change this template use File | Settings | File Templates.
 */
class MailFilter
{
    public static function mail_filter($key, $value, $options = array()) {
        if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) return false;

        return true;
    }

    public static function get_check_functions() {
        $functions[] = ['id' => 'm', 'name' => 'mail', 'class' => 'MailFilter',  'function' => 'mail_filter', 'options' => []];

        return $functions;
    }

    public static function get_advance_check_functions() {
        return array();
    }
}
