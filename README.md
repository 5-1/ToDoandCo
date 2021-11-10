# TodoAndCo
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/a60ea85b54cf4341b2088acd1eb2231a)](https://www.codacy.com/gh/5-1/ToDoandCo/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=5-1/ToDoandCo&amp;utm_campaign=Badge_Grade)

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

