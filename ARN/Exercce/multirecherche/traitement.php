<?php
// definition des variables
$recherche = $_POST['recherche']; // recherche
$moteur = $_POST['moteur']; // moteur
// maintenant, on teste la variable pour voir le moteur et on envoi au moteur selectionne
switch ($moteur) // on indique sur quelle variable on travaille, ici sur la variable moteur
{ 
    case 1: // google
        header("Location: http://www.google.fr/#hl=fr&q=$recherche");
    break;
    
    case 2: // bing
        header("Location: http://www.bing.com/search?q=$recherche");
    break;
    
    case 3: // yahoo
        header("Location: http://fr.search.yahoo.com/search?p=$recherche");
    break;

    case 4: // wikipedia
        header("Location: http://fr.wikipedia.org/w/index.php?title=Special:Search&search=$recherche");
    break;

    case 5: // lycos
        header("Location: http://search.lycos.fr/web?q=$recherche");
    break;
    
    default:
        echo "Une erreur a eu lieue.";
}
?>