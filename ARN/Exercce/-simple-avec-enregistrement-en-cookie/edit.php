<?php
// pour ne pas afficher d'erreur si le cookie n'a pas encore été créé
ini_set("display_errors",0);error_reporting(0);
?>
<html>
<head>
<title>Bloc-note - editer</title>
<style type="text/css">
<!-- aucun style -->
</style>
</head>
<body>
<h1>Editer votre note</h1>
<form method="post" action="enreg.php">
<textarea cols="42" rows="10" name="memo">
<?php
// affiche la note si deja créé (pour permettre de la modifier)
  echo $_COOKIE['memo_cook'];
?></textarea><div><input type="submit" value="Enregistrer"></div><div id="quit"><a href="index.html"><input type="button" value="Quitter"></a></div></div>
</form>
</body>
</html>