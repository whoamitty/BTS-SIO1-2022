<?php
/**
 * Created by JetBrains PhpStorm.
 * User: SaphirAngel
 * Date: 12/10/12
 * Time: 17:12
 * To change this template use File | Settings | File Templates.
 */

$primaryTypes = new Profil('primary_types');
$primaryTypes->check(['i', 'int'], NOT_EMPTY | NUMERIC, 'i');
$primaryTypes->check(['s', 'string'], NOT_NULL, 's');
$primaryTypes->check(['k', 'key'], NOT_EMPTY | NUMERIC, 'i')
            ->advance(['k', 'key'], ['i_range' => [0, 60]], 0);
$primaryTypes->check(['login', 'username'], NOT_EMPTY, 's')
            ->advance(['login', 'username'], ['regex' => ['^[A-Za-z0-9_-]*$']]);
$primaryTypes->check('phonenumber', 0)
            ->advance('phonenumber', ['regex' => ['^(?:\+[0-9]{1,3}|0)(?:[0-9]{9})$']]);


$formTypes = new Profil('form_types');
$formTypes->check('submit', 0)
          ->advance('submit', [], false);

