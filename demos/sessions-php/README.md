# Les cookies

- [Les cookies](#les-cookies)
  - [Third-party cookies, comment les cookies servent à vous *tracker*](#third-party-cookies-comment-les-cookies-servent-à-vous-tracker)
    - [Qu'est ce qu'un *third party cookie* ?](#quest-ce-quun-third-party-cookie-)
    - [Exemple concret](#exemple-concret)
  - [Lectures recommandées](#lectures-recommandées)


## Third-party cookies, comment les cookies servent à vous *tracker*

### Qu'est ce qu'un *third party cookie* ?

Un *third-party cookie* est un cookie déposé par un nom de domaine sans que vous visitiez *explicitement* ce nom de domaine.

> On rappelle qu'un cookie est associé à un nom de domaine et à ses sous-domaines (et non à une **origine** comme les autres mesures de sécurité du navigateur, comme la *Same Origin Policy*)

### Exemple concret

Situation de départ : vous vous rendez sur le site `chaussures.com`. Ce site a un contrat avec une régie publicitaire hébergée sur `.

1. Vous vous rendez sur une page produit de chaussures.com. Dans le HTML, il y a des instructions pour aller chercher des données auprès de `pub.net`. Par exemple, une image :

~~~html
<img src="https://pub.net/images/pub">
~~~

> Cela peut être fait via un iframe, un script JS, etc.

Cela crée le contexte du *third-party*.

2. Au traitement de cette balise, le navigateur envoie une requête :

~~~
GET /images/pub HTTP/1.1
Host: pub.net
Referer: https://chaussures.com/produits/nike-air-zoom
~~~

> [L'en-tête HTTP `Referer`](https://developer.mozilla.org/fr/docs/Web/HTTP/Reference/Headers/Referer) est envoyé par le navigateur lors d’une requête. Il contient l'URL de la page *depuis* laquelle la requête est partie. Cela permet au serveur de la régie pub de connaître la page et donc le produit qui semble vous intéresser.

pour récupérer l'image. `pub.net` en profite pour **déposer un cookie** côté client, par ex `id_pub=user_42` :

~~~
Set-Cookie: id_pub=user_42; SameSite=None; Secure
~~~

Ce cookie est bien **associé** au domaine `pub.net`. Grâce à l’URL appelée (et éventuellement à l’en-tête HTTP `Referer`), le serveur `pub.net` enregistre dans sa base de données *user_42 a visité cette page et aime cette paire de chaussures* ;

3. Vous visitez un autre site, `cuisine.com` qui travaille avec la même régie publicataire. Il affiche par exemple une pub de la régie sur son site. Cela génère une requete `GET` et, *si le navigateur autorise les cookies tiers*, la requête envoyée vers `pub.net` envoie le cookie `id_pub` déposé précédemment sur le site de chaussures. **La régie peut alors en profiter pour vous afficher une pub pour cette paire de chaussures en réponse**.

> C’est le principe du *cross-site tracking*.

## Lectures recommandées

- [Using HTTP cookies](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/Cookies), documentation de la MDN ;
- [Third-party cookies](https://developer.mozilla.org/en-US/docs/Web/Privacy/Guides/Third-party_cookies), documentation de la MDN ;
- [Controlling third-party cookies with SameSite](https://developer.mozilla.org/en-US/docs/Web/HTTP/Guides/Cookies#controlling_third-party_cookies_with_samesite)