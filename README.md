# Projet : TimeGuessr


- [Projet : TimeGuessr](#projet--timeguessr)
  - [Lancer le projet](#lancer-le-projet)
  - [Analyse](#analyse)
    - [Données](#données)
      - [MCD](#mcd)
      - [Dictionnaire des données](#dictionnaire-des-données)
  - [Références](#références)


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