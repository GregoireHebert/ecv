# PENDU

## INSTALL

```shell
composer install
```

## CHECK list
OK liste de mots (fichier ou bdd)

si aucune partie en cours
    lancer une partie
sinon afficher la partie + proposer nouvelle partie

===

Lancer une partie
    OK choisir un mot au hasard
    OK stocker le mot session
    OK stocker tentatives (départ à 11)
    OK afficher le nombre de lettres à trouver
    choisir une lettre ->
        OK tester si lettre déjà tenté
        OK    si oui tentative -1
        OK tester si la lettre est dans le mot
        OK    si pas dans le mot alors tentative -1
        OK    si dans le mot alors j'affiche la lettre dans le mot
        OK tester si toutes les lettres sont trouvées
            si oui, alors message victoire + termine la partie
        OK tester tentatives
            si 0 alors message perdant + termine la partie
    OK tester un mot entier
        tester si le mot est bon
            si oui, alors message de victoire
            si non, message perdant et les tentatives à 0
        dans tous les cas, on termine la partie

=== 

maker:bundle
    make:user
    make:auth
    make:register
    
translations


==== controllers

accueil
lancer une partie
la partie
tester une lettre
tester un mot
resultat


==== pendu

répertoire pendu
    logique décrite au dessus
    function initialisation
        choisir un mot au hasard
        stocker tentatives (départ à 11)
    function choisir une lettre
    function tenter un mot
    function verification

=== routes

/ accueil
/init lancer un nouveau jeu
/test_letter/{letter} tester ma lettre
/tester_mot tester mon mot (POST)
/victoire
/perdu
