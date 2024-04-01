# Mediatekformation
## Présentation
Ce site, développé avec Symfony 5.4, permet d'accéder aux vidéos d'auto-formation proposées par une chaîne de médiathèques et qui sont aussi accessibles sur YouTube.<br> 
Cette version ajoute la partie d'administration du site permettant de gérer les formations, les playlists et les catégories.<br>
La version ayant servi de base à la réalisation de ce projet est consultable sur le dépôt GitHub suivant : https://github.com/CNED-SLAM/mediatekformation.git<br><br>
<img width="309" alt="Diagramme de cas d'utilisation back-office" src="https://github.com/marcbernad/mediatekformation/assets/115026928/3b08c0c3-df7e-4fd7-be79-4fa876a5ff2b"><br>

## Les différentes pages
Voici les 5 pages correspondant aux différents cas d’utilisation.
### Page 1 : Gestion des formations
Cette page affiche la gestion des formations.<br>
La partie du haut contient une bannière (logo, nom et phrase présentant le but du site), le menu permettant d'accéder aux 3 pages principales (Formations, Playlists, Catégories) ainsi qu'un bouton permettant d'ajouter une formation.<br>
Le centre contient la liste des formations avec pour chacune la possibilité de l'éditer ou de la supprimer.<br><br>
![liste formations](https://github.com/marcbernad/mediatekformation/assets/115026928/c840e374-cbc1-4ecc-a73d-7c766e9cc911)<br>

### Page 2 : Ajout d'une formation
Cette page affiche le formulaire permettant d'ajouter une formation.<br>
La partie haute contient la bannière et le menu.<br>
La partie centrale contient un formulaire composé de 6 champs :<br>
•	Le premier champ ("date") permet de sélectionner la date de création.<br>
•	Le deuxième champ ("Titre") permet de saisir le titre de la formation.<br>
•	Le troisième champ permet de saisir l'ID de la vidéo.<br>
•	Le quatrième champ permet de sélectionner un playlist où insérer cette formation.<br>
•	Le cinquième champ permet d'attribuer une ou plusieurs catégories à la formation.<br>
•	Le sixième champ permet de saisir une description de la formation.<br>
Un bouton permet d'enregistrer les informations saisies.<br>
![ajout formation](https://github.com/marcbernad/mediatekformation/assets/115026928/c407fc49-5d62-4b0a-8af1-3b3be2c0f93b)<br>

### Page 3 : détail d'une formation
Cette page n'est pas accessible par le menu mais uniquement en cliquant sur une miniature dans la page "Formations" ou une image dans la page "Accueil".<br>
La partie haute est identique à la page d'accueil (bannière et menu).<br>
La partie centrale est séparée en 2 parties :<br>
•	La partie gauche contient la vidéo qui peut être directement visible dans le site ou sur YouTube.<br>
•	La partie droite contient la date de parution, le titre de la formation, le nom de la playlist, la liste des catégories et sa description détaillée.<br>
![img4](https://github.com/CNED-SLAM/mediatekformation/assets/100127886/6c8b31ef-b650-4b69-8cf9-fbca8f340cde)
### Page 4 : les playlists
Cette page présente les playlists.<br>
La partie haute est identique à la page d'accueil (bannière et menu).<br>
La partie centrale contient un tableau composé de 3 colonnes :<br>
•	La 1ère colonne ("playlist") contient le nom de chaque playlist.<br>
•	La 2ème colonne ("catégories") contient la ou les catégories concernées par chaque playlist (langage…).<br>
•	La 3ème contient un bouton pour accéder à la page de présentation de la playlist.<br>
Au niveau de la colonne "playlist", 2 boutons permettent de trier les lignes en ordre croissant ("<") ou décroissant (">"). Il est aussi possible de filtrer les lignes en tapant un texte : seuls les lignes qui contiennent ce texte sont affichées. Si la zone est vide, le fait de cliquer sur "filtrer" permet de retrouver la liste complète.<br> 
Au niveau de la catégorie, la sélection d'une catégorie dans le combo permet d'afficher uniquement les playlists qui ont cette catégorie. Le fait de sélectionner la ligne vide du combo permet d'afficher à nouveau toutes les playlists.<br>
Par défaut la liste est triée sur le nom de la playlist.<br>
Cliquer sur le bouton "voir détail" d'une playlist permet d'accéder à la page 5 qui présente le détail de la playlist concernée.<br>
![img5](https://github.com/CNED-SLAM/mediatekformation/assets/100127886/83e4a279-3882-46d2-a7d8-b1b511c184b7)
### Page 5 : détail d'une playlist
Cette page n'est pas accessible par le menu mais uniquement en cliquant sur un bouton "voir détail" dans la page "Playlists".<br>
La partie haute est identique à la page d'accueil (bannière et menu).<br>
La partie centrale est séparée en 2 parties :<br>
•	La partie gauche contient les informations de la playlist (titre, liste des catégories, description).<br>
•	La partie droite contient la liste des formations contenues dans la playlist (miniature et titre) avec possibilité de cliquer sur une formation pour aller dans la page de la formation.<br>
![img6](https://github.com/CNED-SLAM/mediatekformation/assets/100127886/f72a1d0f-fcc7-4fea-bf91-5a3f301e96db)
## La base de données
La base de données exploitée par le site est au format MySQL.
### Schéma conceptuel de données
Voici le schéma correspondant à la BDD.<br>
![img7](https://github.com/CNED-SLAM/mediatekformation/assets/100127886/1f1f4c83-5955-4ae9-b2f2-a030055c1d3f)
<br>video_id contient le code YouTube de la vidéo, qui permet ensuite de lancer la vidéo à l'adresse suivante :<br>
https://www.youtube.com/embed/<<<video_id>>>
### Relations issues du schéma
<code><strong>formation (id, published_at, title, video_id, description, playlist_id)</strong>
id : clé primaire
playlist_id : clé étrangère en ref. à id de playlist
<strong>playlist (id, name, description)</strong>
id : clé primaire
<strong>categorie (id, name)</strong>
id : clé primaire
<strong>formation_categorie (id_formation, id_categorie)</strong>
id_formation, id_categorie : clé primaire
id_formation : clé étrangère en ref. à id de formation
id_categorie : clé étrangère en ref. à id de categorie</code>

Remarques : 
Les clés primaires des entités sont en auto-incrémentation.<br>
Le chemin des images (des 2 tailles) n'est pas mémorisé dans la BDD car il peut être fabriqué de la façon suivante :<br>
"https://i.ytimg.com/vi/" suivi de, soit "/default.jpg" (pour la miniature), soit "/hqdefault.jpg" (pour l'image plus grande de la page d'accueil).
## Installation de l'application
- Vérifier que Composer, Git et Wamserver (ou équivalent) sont installés sur l'ordinateur.
- Télécharger le code et le dézipper dans www de Wampserver (ou dossier équivalent) puis renommer le dossier en "mediatekformation".<br>
- Ouvrir une fenêtre de commandes en mode admin, se positionner dans le dossier du projet et taper "composer install" pour reconstituer le dossier vendor.<br>
- Dans phpMyAdmin, se connecter à MySQL en root sans mot de passe et créer la BDD 'mediatekformation'.<br>
- Récupérer le fichier mediatekformation.sql en racine du projet et l'utiliser pour remplir la BDD (si vous voulez mettre un login/pwd d'accès, il faut créer un utilisateur, lui donner les droits sur la BDD et il faut le préciser dans le fichier ".env" en racine du projet).<br>
- De préférence, ouvrir l'application dans un IDE professionnel. L'adresse pour la lancer est : http://localhost/mediatekformation/public/index.php<br>
