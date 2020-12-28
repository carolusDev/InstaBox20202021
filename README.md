# Instabook : partage de photos avec des groupes d'ami. 

## Contexte
L'objectif de cette application est de pouvoir créer des groupes d'amis, poster des photos accessibles par le groupe. 
Pour chaque photo, on peut "tagger" les membres du groupe qui y apparaissent. Chaque photo peut-être commentée par un membre du groupe, et chaque membre du groupe peut répondre à un commentaire. 

## Étape de réalisation 

L'objectif est de concevoir les fichiers de migrations, les factories nécessaires aux tests, les modèles Eloquent et les relations entre les modèles. 

Ce projet pourra être étendu par la suite. 

### Récupération du projet et préparation de votre dépôt pour le rendu 

1. Cloner le dépôt 
2. Rentrez dans le dépot : `cd instabook`
3. "Dégiter" le dépôt : `rm -rf .git`
4. Initialiser git : `git init`
5. Créez votre dépôt de rendu sur git, sans README, ni aucune autre case cochée
6. Suivez les instructions indiquées sur git (`git add .`, `git commit -m"initial commit`, `git remote add origin url_de_votre_depot`)
7. Vous pouvez (mais n'êtes pas obligé) rajouter comme second dépôt distant le dépôt actuel : `git remote add prof )
8. Faites votre premier push : `git push -u  origin master`. 

### Création d'une base de données, 

Vous aurez à créer une base de données dans MySQL : 
`sudo mysql`
Une fois dans mysql 

```sql 
CREATE DATABASE instabook;
 -- CREATE USER  laravel@localhost IDENTIFIED BY 'L4R4V3l' ; --  À faire si vous n'avez pas déjà un utilisateur autre que root
 -- On donne les droit à l'utilisateur
 GRANT ALL ON instabook.* TO laravel@localhost; 
```

Copier le fichier `.env.example` en `.env` : 
```sh 
cp .env.example .env
```
Et remplissez les informations propres à la BDD. 


Installer le projet à l'aide de composer : 
```sh
composer install
```

Créer une clé pour le .env
```sh
php artisan key:generate
```

À vous de jouer !!!


### Les jeux de tests
Afin de faciliter le développement, les jeux de tests sont numérotés pour être passé par étapes. Un `seeder` a été fourni pour remplir la base de donnée avec un jeu de donnée valide. pour que celui ci s'execute bien, vous aurez besoin des factories (fournies), ainsi que des modèles. 
Vous aurez aussi besoin d'avoir créé les modèles et vérifié que chacun à bien le trait hasFactory (`use hasFactory;`).
Le modèle Photo est fourni avec une relation nécessaire pour le remplissage de la base. 


Ainsi la première étape concernent simplement la structure de la base données, sans prendre en compte les contraintes de clés étrangères, ni d'unicité. Il y a besoin des fichiers de migration, ainsi que des factory qui sont fournies pour cette étape. 

Si vous rencontrez des problèmes dès cette étape, essayer de réinitialiser la base de données et les jeux de test avec la commande suivante : 
```sh
php artisan migrate:fresh --seed
```

Ensuite, il est nécessaire de coder les relations dans les modèles, pour pouvoir tester les contraintes d'unicité et de clés étrangères, dans leur forme simplifiées, c’est-à-dire sans relations complexes. 

Enfin, il faudra intégrer certaines règles de gestions, telles que l'appartenance à groupe d'une photo pour être mentionné comme apparaissant sur la photo. 
  - Un commentaire ne peut être que fait que par un utilisateur qui appartient au même groupe que la photo
  - La photo n'est créée que si son propriétaire appartient bien au même groupe que la photo
  - Un utilisateur ne peut être ajouté à une photo que si il est dans le même groupe que la photo