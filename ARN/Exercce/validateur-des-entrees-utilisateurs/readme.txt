Validateur des entrées utilisateurs-----------------------------------
Url     : http://codes-sources.commentcamarche.net/source/54629-validateur-des-entrees-utilisateursAuteur  : SaphirAngelDate    : 05/08/2013
Licence :
=========

Ce document intitulé « Validateur des entrées utilisateurs » issu de CommentCaMarche
(codes-sources.commentcamarche.net) est mis à disposition sous les termes de
la licence Creative Commons. Vous pouvez copier, modifier des copies de cette
source, dans les conditions fixées par la licence, tant que cette note
apparaît clairement.

Description :
=============

Je vous propose ici un syst&egrave;me qui permet la v&eacute;rification et le fo
rmatage des donn&eacute;es utilisateurs (peut facilement &ecirc;tre &eacute;tend
ue aux sessions). Il a &eacute;t&eacute; d&eacute;velopp&eacute; afin de limiter
 le temps pass&eacute; &agrave; v&eacute;rifier et s&eacute;curiser les diff&eac
ute;rentes valeurs exterieur &agrave; l'application et, ainsi, pass&eacute; plus
 de temps dans le d&eacute;veloppement de l'application et des algorithmes &agra
ve; proprement parl&eacute;.
<br />
<br />Modification:
<br />Ajout d'un syst
&egrave;me de profil qui permet d'&eacute;viter de r&eacute;&eacute;crire les te
sts et de faire des validations automatiquement &agrave; l'appel de la valeur.

<br />
<br />Le code est amen&eacute; &agrave; &ecirc;tre modifi&eacute; r&eacu
te;guli&egrave;rement.
<br />
<br />Je me sers de ce code comme entr&eacute;e 
obligatoire pour mon impl&eacute;mentation du mod&egrave;le mvc.
<br />
<br />
Je vous invite &agrave; me donner votre avis sur ce code et peut &ecirc;tre des 
am&eacute;riation ou des id&eacute;es si l'id&eacute;e vous int&eacute;resse (ou
i je suis tr&egrave;s positif). Evidemment, si le code ne vous plait pas vous po
uvez aussi m'en donner la raison. Merci d'avance.
<br />
<br />Ci dessous un j
eu de test.
<br /><a name='source-exemple'></a><h2> Source / Exemple : </h2>

<br /><pre class='code' data-mode='basic'>
/***** Fichier de déclaration des fi
ltres
&lt;?php

$primaryTypes = new Profil('primary_types');
$primaryTypes-&
gt;check(['i', 'int'], NOT_EMPTY | NUMERIC, 'i');
$primaryTypes-&gt;check(['s',
 'string'], NOT_NULL, 's');
$primaryTypes-&gt;check(['k', 'key'], NOT_EMPTY | N
UMERIC, 'i')
            -&gt;advance(['k', 'key'], ['i_range' =&gt; [0, 60]], 
0);
$primaryTypes-&gt;check(['login', 'username'], NOT_EMPTY, 's')
           
 -&gt;advance(['login', 'username'], ['regex' =&gt; ['^[A-Za-z0-9_-]*$']]);
$pr
imaryTypes-&gt;check('phonenumber', 0)
            -&gt;advance('phonenumber', 
['regex' =&gt; ['^(?:\+[0-9]{1,3}|0)(?:[0-9]{9})$']]);

$formTypes = new Profi
l('form_types');
$formTypes-&gt;check('submit', 0)
          -&gt;advance('sub
mit', [], false);

/***** Fichier de code
&lt;?php
include 'Request.php';
$
post = new request('POST', 'default');

//Chargement des profils à utiliser
$
post-&gt;load('primary_types');
$post-&gt;load('form_types');
    

$message
 = '';
try {
    if ($post['userUpdate_submit']) {
        $login = $post['us
er_login'];
        $userKey = $post['user_key'];
        $message = &quot;Don
nées valide&quot;;
    }
} catch (Exception $exception) {
    $message = 'Les
 données ne sont pas corrects';
}

?&gt;

&lt;div&gt;
    &lt;?php echo $m
essage; ?&gt;
&lt;/div&gt;

&lt;form action=&quot;test_v2.php&quot; method=&q
uot;POST&quot;&gt;
    &lt;label for='user_login'&gt;Identifiant : &lt;/label&g
t;
    &lt;input id=&quot;user_login&quot; name=&quot;user_login&quot; type=&qu
ot;text&quot; value=&quot;&quot;/&gt;
    &lt;br/&gt;
    &lt;input id=&quot;u
ser_key&quot; name=&quot;user_key&quot; type=&quot;hidden&quot; value=&quot;20&q
uot;/&gt;
    &lt;br/&gt;
    &lt;input id=&quot;userUpdate_submit&quot; type=
&quot;submit&quot; name=&quot;userUpdate_submit&quot; value=&quot;envoyer&quot;/
&gt;
&lt;/form&gt;
</pre>
<br /><a name='conclusion'></a><h2> Conclusion : </
h2>
<br />Cette exemple ne concerne que la partie de la gestion des profils. P
our un exemple concernant la base m&ecirc;me du module, et donc sans passer par 
les profils, je vous invite &agrave; t&eacute;l&eacute;charger les sources.
<br
 />
<br />Une petite explication :
<br />Les profils sont d&eacute;clar&eacute
;s avant dans des fichiers php contenu dans le dossier &quot;profils&quot;. Ils 
seront par la suite automatiquement ajout&eacute; &agrave; l'application et vous
 pourrez donc charger n'importe lequel des profils cr&eacute;&eacute;s.
<br />

<br />Une fois un profil charg&eacute;, d&egrave;s que vous ferez appel &agrave
; la classe request, via &quot;$post&quot; dans cette exemple, le script v&eacut
e;rifie si la cl&eacute; est valide selon les profils charg&eacute;s et surtout 
si le contenu est aussi valide selon la d&eacute;claration du profil.
<br />
<
br />En cas de non validit&eacute;, le script renverra, soit, une valeur par d&e
acute;faut, soit, une exception avec comme message l'explication du refus.
<br 
/>
<br />Tout cela ce fait automatique pour peu que le profil existe.
<br />

<br />De plus un profil se cr&eacute;&eacute; sur une cl&eacute; &quot;login&quo
t;, &quot;key&quot;, &quot;submit&quot;. Mais comme vu dans l'exemple les cl&eac
ute;s peuvent &ecirc;tre utilis&eacute; comme morceau de cl&eacute; dans une req
uete http (post, get). L'&eacute;criture de cette cl&eacute; est alors macl&eacu
te;_lacleprofil.
<br />Ceci permet de cr&eacute;er des classes que plusieurs cl
&eacute;s r&eacute;el pourront utiliser.
<br />
<br />Je vous invite &agrave; 
me donner votre avis sur ce code et peut &ecirc;tre des am&eacute;riation ou des
 id&eacute;es si l'id&eacute;e vous int&eacute;resse (oui je suis tr&egrave;s po
sitif). Evidemment, si le code ne vous plait pas vous pouvez aussi m'en donner l
a raison. Merci d'avance.
