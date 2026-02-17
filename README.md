# Projet : TimeGuessr

- [Projet : TimeGuessr](#projet--timeguessr)
  - [Guide](#guide)
    - [Dépendances](#dépendances)
  - [Lancer le projet](#lancer-le-projet)
    - [Base de données](#base-de-données)
    - [Le site web](#le-site-web)
    - [Jeu de données test](#jeu-de-données-test)
  - [Analyse](#analyse)
    - [Données](#données)
      - [MCD](#mcd)
      - [Dictionnaire des données](#dictionnaire-des-données)
  - [Aller plus loin](#aller-plus-loin)
    - [Améliorer le système](#améliorer-le-système)
    - [Fait](#fait)
  - [Références](#références)

## Guide

1. **Analyse** :
   1. comprendre le jeu, le spécifier, le déroulement (ex. Diagramme de navigation), commencer à identifier les données (dictionnaire de données, MCD)
2. **Conception** :
   1. Navigation sur le système : comment le jeu se déroule sur le site web (quelles URL, quelles données à chaque URL)
3. **Implémentation** :
   1. Implémenter un composant *routeur* (URL associée à du code à executer (*controller*)) ;
   2. Implémenter une **boucle complète de jeu** (*navigation*)

### Dépendances

- PHP 8+ et le module `pdo_mysql`;
- Un serveur MySQL.

## Lancer le projet

### Base de données

1. **Créer** un fichier `.env` à la racine du projet et y renseigner vos *credentials*:

~~~bash
cp .env.dist .env
~~~

2. **Exécuter** le script `database/schema.sql`.
3. Pour *ajouter* des images à la base :
   1. **Créer** un dossier `images` à la racine du projet et y placer des images ;
   2. Pour chaque image, **insérer** un enregistrement en base de données :

~~~SQL
INSERT INTO image (path, latitude, longitude, annee) 
VALUES('chute-berlin.jpg', 52.5, 13.4, 1989);
~~~

### Le site web

Lancer le site web, avec le serveur intégré de PHP :

~~~bash
php -S localhost:8000 -t public
~~~

Se rendre à l'URL http://localhost:8000 avec votre navigateur favori.


### Jeu de données test

> Fournir un jeu de données test (en base + images) à utiliser pour tester facilement le projet.

## Analyse

<!-- 
- Diagramme de navigation [x]
- IHM (Interface Homme Machine : données à afficher, inputs, layout) [x]
 -->

### Données

#### MCD

- Image : **id**, localisation (?), année, description, nom (path)

<!-- Modèle Conceptuel des données

 -->
#### Dictionnaire des données

| Libellé                                                   | code   | Type | Commentaire/Contrainte                                                                                                                                       |
| --------------------------------------------------------- | ------ | ---- | ------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| Nom de l'image dont il faut deviner année et localisation | `path` | AN   | **Unique**. Chaîne de caractères écrite en *kebab-case*. Comprend l'extension du fichier. Par ex `chute-du-mur.png`. Formats acceptés : png, jpeg, jpg, webp |
|                                                           |        |      |                                                                                                                                                              |
|                                                           |        |      |                                                                                                                                                              |
*Légende* :

- AN : AlphaNumérique ;
- N : Numérique ;
- B : Booléen
- D : Datetime

## Aller plus loin

### Améliorer le système

- **Fixer le cas de la navigation vers l'arrière**. Le site *casse* si on utilise le bouton *revenir en arrière* (*Back*) du navigateur. Avec le bouton *Back*, la session *continue* d'aller vers le round suivant ;
- Mettre en place une véritable **gestion d'erreurs** ;
- **Refactoriser/restructurer le code**. Le code est volontairement laissé *en l'état*. Essayer de **trouver des abstractions utiles** (fonctions, namespaces, classes si POO, PHP moderne avec Composer, classe *oriented* et *autoloading* etc.) pour *restructurer* le code.


### Fait

- **Ne pas donner accès à toutes les images**. Pour le moment les images sont dans le répertoire `public`. Elles sont facilement accessibles par les clients avant de commencer une partie. Elles devraient uniquement être accessibles à chaque round. Pour cela, il faut créer un contrôleur en charge de fournir une image liée à un round sur une URL *custom* (par ex. fournir `GET round/image?step=1`) [x]

## Références

- [TimeGuessr](https://timeguessr.com/), le jeu officiel à *cloner*
