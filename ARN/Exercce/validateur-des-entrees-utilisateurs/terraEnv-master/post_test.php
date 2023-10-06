<?php
/**
 * Created by SaphirAngel
 * User: SaphirAngel
 */
include 'Request.php';


/*
********
* FLAG *
********
NOT_EMPTY       ok
NOT_NULL        ok
CHECK           ok
NUMERIC         ok


*****************
* SECURITY FLAG *
*****************
HTML_SECURE     ok

////// CHECK FLAG       ok

**************
* CHECK MODE *
**************
i   integer             ok
ip  positive integer    ok
in  negative integer    ok
f   float               ok
fp  positive float      ok
fn  negative float      ok
s   string              ok
c   character           ok
b   boolean             ok
m   mail                ok
d   date                ok


***********************
* ADVANCED CHECK MODE *
***********************
ir   integer_range => array(min, max)   nok
fr   float_range => array(min, max)     nok
sr   string_regex => '/regex/'          nok

////// get_type | is_type METHOD      nok

*********
* TYPES *
*********
integer     nok
float       nok
string      npk
boolean     nok
character   nok

*/

// For test
$_POST['titre'] = '<script type="text/javascript">alert("ok");</script><br />Salut<p>ok</p>';
$_POST['x'] = 'test';
$_POST['x_empty'] = '';
$_POST['ND'] = "2";
$_POST['age'] = "50";
$_POST['hidden'] = "false";
$_POST['test'] = "ok";
$_POST['contenu'] = "del";
$_POST['password'] = "b";
$_POST['date'] = "2012/06/12$2013/07/12";

$post = new REQUEST('POST', 'default');
$get = new REQUEST('GET');
$request = new REQUEST('ALL');

/***NORMAL FLAG***/

echo 'Securisation HTML';

$post->shield_off();

echo '<br />Valeur inexistante';
$userDataTest_1 = $post(['x', 'y'], NOT_EMPTY | NOT_NULL)->isValid();
if (!$userDataTest_1) var_dump($post->get_errors_list());
else var_dump($userDataTest_1);

echo '<br />Donnée vide';
$userDataTest_2 = $post(['x_empty'], NOT_EMPTY)->isValid();
if (!$userDataTest_2) var_dump($post->get_errors_list());
else var_dump($userDataTest_2);

echo '<br />Valeur existante';
$userDataTest_3 = $post(['x'], NOT_EMPTY)->isValid();
if (!$userDataTest_3) var_dump($post->get_errors_list());
else var_dump($userDataTest_3);

echo '<br />Valeur numérique';
$userDataNumeric = $post(['ND', 'age'], NUMERIC)->isValid();
if (!$userDataNumeric) var_dump($post->get_errors_list());
else var_dump($userDataNumeric);

// Default flag
echo '<br />Valeur avec flag par défaut';
$userDataTest_default = $post(['ND', 'age', 'test'])->isValid();
if (!$userDataTest_default) var_dump($post->get_errors_list());
else var_dump($userDataTest_default);

// CHECK FLAG
echo '<br />Check integer ok';
$userDataTest_4 = $post('ND', CHECK, 'i')->isValid();
if (!$userDataTest_4) var_dump($post->get_errors_list());
else var_dump($userDataTest_4);

echo '<br />check positive integer avec echec';
$userDataTest_5 = $post(['ND', 'age'], CHECK, 'pi')->isValid();
if (!$userDataTest_5) var_dump($post->get_errors_list());
else var_dump($userDataTest_5);

echo '<br />check valeur booléenne';
$hidden = $post('hidden', CHECK, 'b')->isValid();
if (!$hidden) var_dump($post->get_errors_list());
else var_dump($hidden);

echo '<br />check simulation post ajout news basique (echec car contenu vide)';
$dataNews = $post(['ND', 'titre', 'contenu'],
    NOT_EMPTY | CHECK,
    ['pi', 's', 's'])->isValid();
if (!$dataNews) var_dump($post->get_errors_list());
else var_dump($dataNews);

echo '<br />Check avancée';

$post->shield_on(HTML_SECURE, ['titre', 'contenu']);

$post->shield_on(HTML_SECURE | SQL_SECURE);
try {
    $actionAllowed = ['list', 'update', 'add', 'del'];
    if ($post(['ND', 'age', 'titre', 'contenu', 'password'], DEFAULT_FLAG | CHECK, ['pi', 'pi', 's', 's', 's'])->isValid()) {


        $ND_AGE  = $post(['ND', 'age'])->check(['i_range' => [0, 60]], 5);
        $titre   = $post('titre')->validate(['size' => [5, 255]]);
        $contenu = $post['contenu'];

        $action = $post('contenu')->check(['in' => $actionAllowed], 'list');

        echo var_dump($ND_AGE);
        echo ':'.$titre;
        echo '<br />contenu : '.$action;

    } else {
        var_dump($post->get_errors_list());
    }

} catch (PersonalException $e) {
    echo $e->getShortMessage().' : '.$e->getMessage();
}


try {
    $date = $post('date')->validate(['date_interval' => '\$']);
    var_dump($date);

    /*



    $news_id = $post('ND')->validate('sql_exist' => ['conf1', 'table', 'keyField', 'more']]);

    $login = $post('login')->validate(sql_exist' => ['conf1', 'users', 'login', 'activ = 1']);

    $paiement = $post('paiement')->validate('json_decode');

    json_decode

    //NEXT
    $date = $post('date')->validate(['date_interval' => ['-']], ['date_format' => 'Y/m/d 00:00:00',
                                                                 'date_format' => 'Y/m/d 23:59:59']);

    //$date = $post('date')->format(['date_format' => ['yyyy-mm-dd']]);
    //$date = $post('date')->format(['date_format' => 'yyyy-mm-dd']);

    //$prix = $post('prix')->format(['f_format' => 4]);
    //$prix = $post('prix')->check(['f_range' => [0, 60]], 4, ['f_format' => 4]);
    */
} catch(PersonalException $exp) {
    echo 'problem';
}


?>
