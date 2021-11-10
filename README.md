# TodoAndCo

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/e1af60abb30d473d86a5cac299878126)](https://app.codacy.com/gh/5-1/ToDoandCo?utm_source=github.com&utm_medium=referral&utm_content=5-1/ToDoandCo&utm_campaign=Badge_Grade_Settings)

Amélioration d'une application existante  
**Amélioration de Todo and co, application permettant de gérer ses tâches quotidiennes  **

## Installation
- Cloner le projet
- Executer `composer install`
- Configurer l'accès à mysql dans .env ou .env.local
- Créer la base de donnée : `php bin/console doctrine:database:create`  
  puis `php bin/console doctrine:schema:update --force`
- Installer les datafixtures si besoin : `php bin/console doctrine:fixtures:load`  
```
Identifiants admin :
email: "ali@ali.com"  password: "ali"

``` 

- Executer les tests avec la commande : `php bin/phpunit`

