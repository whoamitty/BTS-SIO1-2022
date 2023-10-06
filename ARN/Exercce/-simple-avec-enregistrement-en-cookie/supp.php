<?php
// pour ne pas afficher d'erreur si le cookie n'a pas encore été créé
ini_set("display_errors",0);error_reporting(0);
?>
<?php
// supprime la note
  setcookie ('memo_cook');
?>
<?php
// supprime la date d'enregistrement
setcookie('memo_enreg');
?>
<html>
<head>
<title>Bloc-note - suppression de la note</title>
<style type="text/css">
<!-- aucun style -->
</style>
</head>
<body>
<h1>Suppression de votre note</h1>
Votre note a bien été effacée.<br />
<a href="index.html">Retour à l'index</a>
</form>
</body>
</html>