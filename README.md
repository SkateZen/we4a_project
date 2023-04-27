# Projet WE4A : Eventum

Dans le cadre de l'UV WE4A - Technologies et programmation WEB, nous avons dû réaliser un site d'échange de messages que l'on a souhaité étendre à un réseau social pour organiser et planifier des évenments.

## Présentation

Notre réseau social s'appelle Eventum ! Sur celui-ci, on trouvera :

+ Un système d'amis avec lesquels il est possible d'avoir des messages privés et échanger des images.
+ Des évenments proposés par des utilisateurs, qu'ils soient public ou privés, pour la communauté auquel il est possible de s'inscrire facilement.
+ Un système pour inviter ces amis à des évenments, c'est essentiel si l'évenment est privé !
+ Une conversation de groupe où il est possible de discuter et d'échanger des images avec les autres utilisateurs inscrits à l'évenement auquel on s'est inscrit. La conversation est visible seulement pour les membres inscrits à l'évenement.
+ Un formulaire pour ajouter un nouvel évnement.
+ Un "agenda" pour avoir accès aux évenements que l'on a proposé et ceux auquels on est inscrit.
+ Un profil où l'on peut modifier ses informations, accéder à sa liste d'amis, les demandes d'amis en attente et **se déconnecter**.

## Particularités

+ Les échanges de messages, champs de recherche, renvoi du thème se font avec AJAX.
+ La grande majorité des entrées utilisateurs sont protégées des injections SQL.
+ Pour se déconnecter il faut aller sur son profil.

## Versions utilisées

+ PHP : version 7.0.3
+ MySQL : version 5.7.11

## Auteurs

+ Marius Diguat Matteus
+ Eliséo Vardanega

## Crédits

Merci à **Antoine Litzler** de nous avoir autorisé la reprise de certaines fonctions (qui ont été modifiées ou non par la suite) du fichier database.php vues en TD.

---

Projet pour l'uv we4a. L'idée est de faire un site web axé sur la proposition et recherche d'évènements.



Nouvelles étapes :



autres infos sur événement
    ->organisateur
    ->type
    ->image
    ->nombre participants
    ->max participants
    ->prix
    ->adresse

page profil ami
    ->événements ami


CSS 
    
    ->onglet actuel à marqué
        ->javascript
    
    ->événement


Petits bugs à corriger :

bug accept_ami -> plusieurs amis ajoutés en 1 seul click

Messagerie
Selectionner conversation avec Ajax est pas post lors du clique sur l'ami
Voir pour régler battement carte événement


Nettoyage code :

Rajouter beaucoup de commentaires
Faire un script requête qui réunit les requêtes importantes


Améliorations futures :

rajoutés catégories pour utilisateurs
voir pour co-création d'événements ?
voir possibilité covoiturage ?
