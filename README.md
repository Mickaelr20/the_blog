[![Codacy Badge][codacy-shield]][codacy-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/Mickaelr20/the_blog">
    <img src="img/tb-icon-yellow.png" alt="Logo" height="80">
  </a>

  <h3 align="center">The Blog</h3>

  <p align="center">
    Site web réalisé en PHP par Rivière Mickaël
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Sommaire</summary>
  <ol>
    <li><a href="#a-propos">À propos</a></li>
    <li><a href="#installation">Installation</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>

<!-- A PROPOS -->

## A propos

[![Product Name Screen Shot][product-screenshot]](https://example.com)

Mon blog et portfolio sous forme de site web, réaliser en PHP, html5 et css3.

<!-- GETTING STARTED -->

## Installation

Pour installer le projet, vous aurez besoin d'un serveur web php et d'une base de données MySQL.

Copiez le projet à la racine de votre serveur web.

### Installez composer et ses dépendances:

Installez composer sur votre machine.

Pour installer les dépendances composer, exécutez la commande suivante dans le répertoire du projet:
```sh
  composer install
```

### Paramétrez la base de données:
Accédez au fichier SqlConnection.php dans le répertoire: "chemin_du_projet/src/Model/".

Dans ce fichier, changez les attributs "username" et "password" par le username et le password de votre utilisateur MySQL.

Accédez aussi fichier Table.php dans le répertoire: "chemin_du_projet/src/Model/Table/" et modifiez les attributs "host" et "dbName" pour y mettre l'url vers votre serveur MySQL et le nom de la base à utiliser.

Vous trouverez un fichier.sql à éxecuté sur la base souhaitée pour créer l'architecture nécéssaire au fonctionnement du projet.

### Démarrage:

Lancez votre serveur web ou, dans le cadre ou vous installez le projet sur votre machine, exécutez la commande suivante pour lancer le projet avec le serveur web interne de PHP:
```sh
  php -S localhost:8000
```

Le projet est maintenant installé et lancé, vous pouvez accéder à l'url de votre page web ou "http://localhost:8000" si vous avez lancé le projet avec le serveur web interne de php.

## Dependences

Composer:
<ul>
    <li>SwiftMailer (https://swiftmailer.symfony.com/docs/introduction.html)</li>
</ul>

Javascript:
<ul>
    <li>Trumbowygg (https://alex-d.github.io/Trumbowyg/)</li>
    <li>Jquery (https://jquery.com/)</li>
</ul>

Css:
<ul>
    <li>Bootstrap 5 (https://getbootstrap.com/docs/5.0/getting-started/introduction/)</li>
    <li>Line Awesome (https://icons8.com/line-awesome)</li>

</ul>
Thèmes utilisés:
<ul>
    <li>SB Admin: (https://startbootstrap.com/template/sb-admin)</li>
    <li>Agency: (https://startbootstrap.com/theme/agency)</li>
</ul>

<!-- LICENSE -->

## License

Distribué sous GNU GENERAL PUBLIC LICENSE V2. Voir https://github.com/Mickaelr20/the_blog/blob/main/LICENSE pour plus d'informations.

<!-- CONTACT -->

## Contact

Rivière Mickael - mickaelr20@gmail.com - [Mon LinkedIn][linkedin-url]

Lien du projet: [https://github.com/Mickaelr20/the_blog](https://github.com/Mickaelr20/the_blog/)

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[codacy-shield]: https://app.codacy.com/project/badge/Grade/2f75d23b061841fabdf2a2a8fa8d29f5
[codacy-url]: https://www.codacy.com/gh/Mickaelr20/the_blog/dashboard?utm_source=github.com&utm_medium=referral&utm_content=Mickaelr20/the_blog&utm_campaign=Badge_Grade
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?logo=linkedin&colorB=555
[linkedin-url]: https://www.linkedin.com/in/mickael-riviere-s/
[product-screenshot]: img/web_home_screenshot.png
