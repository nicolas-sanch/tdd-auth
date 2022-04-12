# TDD-auth

Pour lancer l'appli

```bash
git clone https://github.com/nicolas-sanch/tdd-auth.git

docker run --rm --interactive --tty \
  --volume $PWD:/app \
  composer install

cp .env.example .env

alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'

sail up -d

sail php artisan key:generate
sail artisan migrate
```