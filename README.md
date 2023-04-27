# Projet WE4A : Eventum

Dans le cadre de l'UV WE4A - Technologies et programmation WEB, nous avons dû réaliser un site d'échange de messages que l'on a souhaité étendre à un réseau social pour organiser et planifier des évenments.

## Présentation

Notre réseau social s'appelle Eventum ! Sur celui-ci, on trouvera :

+ Un système d'amis avec lesquels il est possible d'avoir des messages privés et échanger des images.
+ Des évenements proposés par des utilisateurs, qu'ils soient public ou privés, pour la communauté auquel il est possible de s'inscrire facilement.
+ Un système pour inviter ces amis à des évenements, c'est essentiel si l'évenement est privé !
+ Une conversation de groupe où il est possible de discuter et d'échanger des images avec les autres utilisateurs inscrits à l'évenement auquel on s'est inscrit. La conversation est visible seulement pour les membres inscrits à l'évenement.
+ Un formulaire pour ajouter un nouvel évenement.
+ Un "agenda" pour avoir accès aux évenements que l'on a proposé et ceux auquels on est inscrit.
+ Un profil où l'on peut modifier ses informations, accéder à sa liste d'amis, les demandes d'amis en attente et **se déconnecter**.

## Particularités

+ Les échanges de messages, champs de recherche, renvoi du thème se font avec AJAX.
+ La grande majorité des entrées utilisateurs sont protégées des injections SQL.
+ Pour se déconnecter il faut aller sur son profil.
+ En grande partie responsive
+ Chaque utilisateur à pour mail "la première lettre du prénom"@"la première lettre du nom" et pour mot de passe, son prénom en minuscule


## Améliorations futures

+ Rajouter un vrai agenda dans la partie agenda
+ Rajouter plus d'options par rapport aux événements : 
    + prix événements
    + possibilités de covoiturage
    + cocréation d'événements
+ Version mobile responsive
+ Notifications de messages


## Versions utilisées

+ PHP : version 7.0.3
+ MySQL : version 5.7.11

## Auteurs

+ Marius Diguat Mateus
+ Eliséo Vardanega

## Crédits

Merci à **Antoine Litzler** de nous avoir autorisé la reprise de certaines fonctions (qui ont été modifiées ou non par la suite) du fichier database.php vues en TD.


