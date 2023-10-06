<?php
/**
 * created by jetbrains phpstorm.
 * user: saphirangel
 * date: 18/10/12
 * time: 18:01
 * to change this template use file | settings | file templates.
 */
include 'Request.php';
$post = new request('POST', 'default');

$post->load('primary_types');
$post->load('form_types');

$count = 100000;
while ($count-- > 0) {
    $message = '';
    try {
        if ($post['userUpdate_submit']) {
            $login = $post['user_login'];
            $userKey = $post['user_key'];
            $message = "Données valide";
        }
    } catch (Exception $exception) {
        $message = 'Les données ne sont pas corrects';
    }
}

?>

<div>
    <?php echo $message; ?>
</div>

<form action="test_v2.php" method="POST">
    <label for='user_login'>Identifiant : </label>
    <input id="user_login" name="user_login" type="text" value=""/>
    <br/>
    <input id="user_key" name="user_key" type="hidden" value="20"/>
    <br/>
    <input id="userUpdate_submit" type="submit" name="userUpdate_submit" value="envoyer"/>
</form>