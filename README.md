# Projet Tom Troc

Vous êtes sur le dépôt du projet Tom Troc, espace d'échange de livres pour les amoureux de la littérature.

## Installation

- Cloner le dépôt depuis Github, dans un dossier de travail local (ou sur un serveur distant).
- Créer une base de données et un utilisateur pour le projet (pour l'exemple, base `tomtroc`, utilisateur `tomtroc`, mot de passe `tomtroc`) / sur un serveur distant il conviendra utiliser [un mot de passe fort](https://passwords-generator.org/).
  - `sudo mysql`
    - `CREATE DATABASE tomtroc;`
    - `CREATE USER 'tomtroc'@'localhost' IDENTIFIED BY 'tomtroc';`
    - `GRANT ALL PRIVILEGES ON 'tomtroc'.* TO 'tomtroc'@'localhost';`
    - `FLUSH PRIVILEGES;`
    - `exit`
  - Lancer l'initialisation de la BDD, depuis le dossier du projet, via la commande `mysql -u tomtroc -p tomtroc < sql/init_db.sql`. Le mot de passe de l'utilisateur `tomtroc` sera demandé.
  - Cela va générer les tables et ajouter des données par défaut dans la base.
- Dupliquer le fichier `app/config/_config.php` vers `app/config/config.php`
  - Renseigner les constantes `DB_*` nécessaires pour l'accès à la base de données.
- Démarrer le serveur de dev PHP via `php -S localhost:8000 -t public` depuis la racine du projet (ou utiliser *Apache* ou tout autre serveur Web).
- Rendez-vous sur http://localhost:8000/, la page d'accueil devrait s'afficher.

## Application VS Framework

Le choix a été fait de séparer le code source de l'application du code du "framework". Le code source réutilisable se trouve dans le dossier `framework/`, le code applicatif de *Tom Troc* dans le dossier `app/`.

Les classes de l'application héritent pour la plupart des classes du framework. Finalement, cela ne change pas grand chose au code, c'est surtout une façon d'organiser son code pour une meilleure réutilisation dans d'autres projets.

## a11y

L'analyse a été faite avec l'extension [WebYes Accessibility Checker](https://chromewebstore.google.com/detail/accessibility-checker-by/nidjdackonjofdcclfbdcapbkgghcdjf), sur les pages publiques et privées du site. Les rapports sont dans le dossier [/docs/WCAG/](./docs/WCAG/).


Notes :

- L'accessibilité a été **mise en oeuvre dès l'intégration HTML**.
- Après analyse, **les formulaires** ne disposant pas de *label* ou de *placeholder* **ont été corrigés**.
- Il reste **des contrastes insuffisants** (présents sur la maquette *Figma*) sur certains verts et certains gris.
  - **_à discuter avec l'équipe et le Web designer_**. Je suggère de revoir tous les contrastes problématiques.
- Pour info, on peut voir sur les captures *Lighthouse*, les audits réussis (test sur 2 pages).
  - Les audits manuels suggérés par *Lighthouse* n'ont pas été réalisés sur cette version du code.

## W3C

L'analyse a été faite [sur le site du W3C](https://validator.w3.org/), sur les pages publiques et privées du site, en copier-coller du code HTML. Les rapports sont dans le dossier [/docs/W3C/](./docs/W3C/).

Après analyse :
- Des balises auto-fermantes ont été corrigées, de `/>` à `>`.
- Des `sections` sans titre ont été remplacées par des `div`.
- Des sous-titres ont été ajoutés à des sections.