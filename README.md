# TDD-auth

Pour lancer l'appli

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

## Création de notre premier test
```bash
vendor/bin/sail artisan make:test LoginTest # Permet de créer le fichier de test /tests/Feature/LoginTest.php

vendor/bin/sail artisan --filter <nom-du-test> # Pour lancer un test spécifique
```

## Développement à partir des tests

```bash
vendor/bin/sail artisan make:controller LoginController
```