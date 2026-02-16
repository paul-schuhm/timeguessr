# Projet : TimeGuessr


- [Projet : TimeGuessr](#projet--timeguessr)
  - [Guide](#guide)
  - [Lancer le projet](#lancer-le-projet)
  - [Analyse](#analyse)
    - [Données](#données)
      - [MCD](#mcd)
      - [Dictionnaire des données](#dictionnaire-des-données)
  - [Références](#références)

## Guide

1. **Analyse** : 
   1. comprendre le jeu, le spécifier, le déroulement (ex. Diagramme de navigation), commencer à identifier les données (dictionnaire de données, MCD)
2. **Conception** :
   1. Navigation sur le système : comment le jeu se déroule sur le site web (quelles URL, quelles données à chaque URL)
3. **Implémentation** :
   1. Implémenter un composant *routeur* (url associé à du code à executer (controleur)) ;
   2. Implémenter une **boucle complète de jeu** (navigation)


## Lancer le projet


~~~bash
php -S localhost:8000 -t public
~~~


## Analyse

<!-- 
- Diagramme de navigation [x]
- IHM (Interface Homme Machine : données à afficher, inputs, layout) [x]
 -->


### Données

#### MCD


- Image : id, localisation (?), année, description, nom (path)

<!-- Modèle Conceptuel des données

 -->
#### Dictionnaire des données

| Libellé  | code   | Type  | Commentaire/Contrainte  |
|---|---|---|---|
|  Nom de l'image | path  | AN  | Unique. Chaine de caractères écrite en kebab-case. Comprend l'extension du fichier. Par ex 'chute-du-mur.png'   |
|   |   |   |   |
|   |   |   |   |

Légende : 

- AN : AlphaNumérique ;
- N : Numérique ;
- B : Booléen
- D : Datetime

## Références

- [TimeGuessr](https://timeguessr.com/), le jeu officiel à *cloner*