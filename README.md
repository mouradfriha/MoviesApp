

## Movies App

### Prérequis
- Docker installé sur votre machine

1- Cloner le projet sur votre machine 

`
git clone https://github.com/mouradfriha/MoviesApp.git
`

Créer le fichier .env à partier du fichier .env.example:

`cp .env.example .env`

2- Démarrer l'environnement Docker avec la commande suivante: 

`docker-compose up -d` ou `docker compose up -d`

3- Acceder au container laravel via la commande suivante :

`docker compose exec laravel.test bash`

ou 

`docker-compose exec laravel.test bash`

4- Au sein du container, lancer la commande suivante pour génerer la clé de l'application: 

`php artisan key:generate`

5- installer les dépendences NPM:

`npm install`

6- Compiler les assets css et js: 

`npm run build`


7- Lancer les migrations via la commande suivante: 
`php artisan migrate`

8- Générer une clé d'API TMDB puis renseigner la variable d'environnement dans le ficher .env

TMDB_API_TOKEN=votre_token

Afin de remplir la base de données avec les films en vedette (trends), lancer la commande suivante:

`php artisan import:movies`

9- Consulter l'application sur votre navigateur via l'url http://localhost/movies