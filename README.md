# TDD-auth

Démonstration de Test driven development - _Développement piloté par les test_ avec Laravel

## Pour démarrer le projet

```bash
git clone https://github.com/nicolas-sanch/tdd-auth.git

cd tdd-auth

docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer install

cp .env.example .env

alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'

sail up -d

sail php artisan key:generate
sail artisan migrate
```

## Les principales commandes utilisées

```bash
vendor/bin/sail artisan make:test LoginTest # Permet de créer le fichier de test /tests/Feature/LoginTest.php

vendor/bin/sail test --filter <nom-du-test> # Pour lancer un test spécifique

vendor/bin/sail artisan make:controller LoginController # Créer LoginController.php
```

## Ajouter un utilisateur en base de donnée

Pour tester notre fonctionnalité, nous avons besoin d'un utilisateur en base de donnée. <br>
Pour le créer, nous pouvons utiliser _tinker_
```bash
vendor/bin/sail artisan migrate
vendor/bin/sail artisan tinker 
```
Dans l'interface qui apparait, saisir
```bash
User::factory()->create(['email' => 'john@test.com']);
exit;
```