<?php
/**
 * User: SaphirAngel
 * Date: 17/09/12
 * Time: 19:08
 * Fichier de configuration
 */

//Security flag
define ('HTML_SECURE', 1);
define ('SQL_SECURE', 2);

//Basic check flag
define ('NOT_EMPTY', 6);
define ('NOT_NULL', 4);
define ('CHECK', 8);
define ('NUMERIC', 16);

define ('EXCEPTION_IF_BASIC_CHECK_ERROR', false);
define ('DEFAULT_FLAG', NOT_EMPTY | NOT_NULL );

define ('ACCEPTED', 1);
define ('NOT_ACCEPTED', 2);


