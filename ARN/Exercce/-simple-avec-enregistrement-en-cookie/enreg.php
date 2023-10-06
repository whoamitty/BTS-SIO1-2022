<?php
// pour ne pas afficher d'erreur si le cookie n'a pas encore été créé
ini_set("display_errors",0);error_reporting(0);
?>
<!-- enregistre le memo -->
<?php
// recupere le texte de la note entrée
$memo = $_POST['memo'];
// temps d'enregistrement du cookie (en secondes)
$temps = 365*24*3600;
// enregistre la note avec la variable du texte entré
setcookie('memo_cook', $memo, (time() + $temps));
// recupere date actuelle
$date = date("d-m-Y");
// enregistre la date d'enregistrement de la note (avec date actuelle)
setcookie('memo_enreg', $date, (time() + $temps));
?>
<html>
<head>
<title>Bloc-note - note enregistrée</title>
<style type="text/css">
<!-- aucun style -->
</style>
</head>
<body>
<h1>Note enregistrée</h1>
Votre note à bien été enregistrée<br />
<a href="index.php">Retour à l'index</a>
</body>
</html>