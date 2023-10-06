<?php
// pour ne pas afficher d'erreur si le cookie n'a pas encore été créé
ini_set("display_errors",0);error_reporting(0);
?>
<html>
<head>
<title>Bloc-note - voir votre note</title>
<style type="text/css">
<!-- aucun style -->
</style>
</head>
<body>
<h1>Votre note</h1>
Voici votre note (enregistrée le
<strong><?php
// affiche la date d'enregistrement
  echo  $_COOKIE['memo_enreg'];
?></strong>)<br />
<?php
// affiche la note (htmlspecialchars permet d'éviter au navigateur d'executer un code html entré)
// note : supprimer deux ligne ci-dessous suivant les conditions de php

  echo $memo_cook; // exemple 1 (si registar_globals est à on dans php.ini)
  echo htmlspecialchars($HTTP_COOKIE_VARS['memo_cook']); // exemple 2
  echo htmlspecialchars($_COOKIE['memo_cook']); // pour version de php 4.1.0 ou plus
?>
</form>
</body>
</html>