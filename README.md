# myShop


myShop, boutique en ligne.


## Installation du projet

1. Cloner le repository github  : ``git clone git@github.com:YounesBelarbi/myShop.git``
2. Se rendre dans le répertoire du projet et installer les dépendances back : ``composer install`` et les dépendances front: ``npm install``

## Base de données 
Pour la mise en place de la BDD, se rendre à la racine du projet créer un fichier .env.local et y insérer la ligne suivantes: ``DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
``

saisir ensuite les commandes suivantes:

1. Création de la base données: ``symfony console doctrine:database:create`` 
2. Appliquer les migrations: ``symfony console  doctrine:migrations:migrate`` 
3. Charger les fixtures : ``symfony console doctrine:fixtures:load``
   
## Lancer le projet

1.Lancer le serveur : ``symfony serve``
2.Compiler les assets, dans un autre terminal: ``npm run dev``

le projet se lance et est accessible sur l'url:
https://localhost:8000/

## InstallationTests

Afin de pouvoir jouer les tests il faut une base de données créer dans ce but.

Pour la mettre en place saisir les commandes suivantes dans cet ordre:
``symfony console --env=test doctrine:database:create``
``symfony console --env=test doctrine:schema:create``
``symfony console --env=test doctrine:fixtures:load``

Pour lancer les tests:
``bin/phpunit``


## Api

Endpoint Rest api:

``/api/products`` : renvoie l'ensemble des produits en format json.
``/api/products/{id}`` : renvoie les information d'un produit, correspondant au paramètre (id) en format json.








