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
Le centre contient la liste des formations avec pour chacune la possibilité de l'éditer ou de la supprimer.<br>
La suppression d'une formation se fait en cliquant sur le bouton supprimer et en répondant à une demande de confirmation.<br><br>
<img width="671" alt="liste formations" src="https://github.com/marcbernad/mediatekformation/assets/115026928/c82f8a34-a7a8-4f72-be12-56ebab3ec2b6"><br>


### Page 2 : Ajout d'une formation
Cette page affiche le formulaire permettant d'ajouter une formation.<br>
La partie haute contient la bannière et le menu, comme pour toutes les pages du site.<br>
La partie centrale contient un formulaire composé de 6 champs :<br>
•	Le premier champ ("date") permet de sélectionner la date de création.<br>
•	Le deuxième champ ("Titre") permet de saisir le titre de la formation.<br>
•	Le troisième champ permet de saisir l'ID de la vidéo.<br>
•	Le quatrième champ permet de sélectionner un playlist où insérer cette formation.<br>
•	Le cinquième champ permet d'attribuer une ou plusieurs catégories à la formation.<br>
•	Le sixième champ permet de saisir une description de la formation.<br>
Un bouton permet d'enregistrer les informations saisies.<br><br>
<img width="668" alt="ajout formation" src="https://github.com/marcbernad/mediatekformation/assets/115026928/be98ad5d-a1e3-477e-8e76-c4320404b2e3"><br>


### Page 3 : Edition d'une formation
Cette page est accessible en cliquant sur le bouton d'édition dans la liste des formations.<br>
La partie centrale contient le formulaire pré-rempli reprenant les mêmes champs que pour l'ajout.<br><br>
<img width="664" alt="édition formation" src="https://github.com/marcbernad/mediatekformation/assets/115026928/0336ec0a-f092-4044-a32f-5f1ea2fb5b10"><br>

### Page 4 : Gestion des playlists
Après avoir cliqué sur "PLaylists" dans le menu, cette page affiche la gestion des playlists.<br>
La partie haute contient, en plus de la bannière et du menu, un bouton d'ajout de playlist.<br>
La partie centrale contient la liste des playlists avec pour chacune la possibilité de l'éditer ou de la supprimer.<br>
La suppression d'une playlist se fait en cliquant sur le bouton supprimer et en répondant à une demande de confirmation.<br><br>
<img width="668" alt="liste playlists" src="https://github.com/marcbernad/mediatekformation/assets/115026928/abf221dd-0827-4230-bc51-f6f9003268b7"><br>

### Page 5 : Ajout d'une playlist
Cette page affiche le formulaire permettant d'ajouter une playlist.<br>
La partie centrale contient un formulaire composé de 2 champs :<br>
•	Le premier champ ("Titre") permet de donner un nom à la playlist.<br>
•	Le deuxième champ ("Description") permet de saisir une description de la playlist.<br><br>
<img width="679" alt="ajout playlist" src="https://github.com/marcbernad/mediatekformation/assets/115026928/cb6f944b-0b63-4d98-a968-95827e701a3e"><br>

### Page 6 : Edition d'une playlist
Cette page est accessible en cliquant sur le bouton d'édition dans la liste des playlists.<br>
La partie centrale contient le formulaire pré-rempli reprenant les mêmes champs que pour l'ajout.<br><br>
<img width="673" alt="edition playlist" src="https://github.com/marcbernad/mediatekformation/assets/115026928/25dc7d0e-8bcc-470b-9932-51c7096b6f58"><br>

### Page 7 : Gestion des catégories
Après avoir cliqué sur "Catégories" dans le menu, cette page affiche la gestion des catégories.<br>
La partie haute contient, en plus de la bannière et du menu, un bouton d'ajout de catégorie.<br>
La partie centrale contient la liste des playlists avec pour chacune la possibilité de la supprimer.<br>
La suppression d'une playlist se fait en cliquant sur le bouton supprimer et en répondant à une demande de confirmation.<br><br>
<img width="677" alt="catégories" src="https://github.com/marcbernad/mediatekformation/assets/115026928/e7bf142f-8761-45d6-aee9-cd36506a0f27"><br>


## Installation de l'application
- Vérifier que Composer, Git et Wamserver (ou équivalent) sont installés sur l'ordinateur.
- Télécharger le code et le dézipper dans www de Wampserver (ou dossier équivalent) puis renommer le dossier en "mediatekformation".<br>
- Ouvrir une fenêtre de commandes en mode admin, se positionner dans le dossier du projet et taper "composer install" pour reconstituer le dossier vendor.<br>
- Dans phpMyAdmin, se connecter à MySQL en root sans mot de passe et créer la BDD 'mediatekformation'.<br>
- Récupérer le fichier mediatekformation.sql en racine du projet et l'utiliser pour remplir la BDD (si vous voulez mettre un login/pwd d'accès, il faut créer un utilisateur, lui donner les droits sur la BDD et il faut le préciser dans le fichier ".env" en racine du projet).<br>
- L'adresse pour lancer le site en local est : http://localhost/mediatekformation/public/index.php<br>
- Pour l'authentification, télécharger Keycloak. Configurer un client et un user dans l'interface de gestion à l'adresse : http://localhost:8080. Ajouter les données de connexion dans le fichier .env<br>
