# Biblioteca

Biblioteca CRUD.

## Recursos Utilizados

[PHP 8.1](https://www.php.net/releases/8.1/en.php)

[Laravel](https://laravel.com/docs/5.8/installation)

[Composer](https://getcomposer.org)

[MySQL](https://www.mysql.com)



## Utilização



```bash
git clone https://github.com/macdev14/biblioteca.git
cd biblioteca
composer install 
```


## Definir Variáveis de Ambiente


Criar arquivo .env dentro de /biblioteca copiar as informações de .env.example
ou copiar as informações abaixo
```bash
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=example_app
DB_USERNAME=root
DB_PASSWORD=root

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

```
## Alterar informações de Banco de Dados
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=''porta do servidor''
DB_DATABASE=example_app
DB_USERNAME=''seu usuário''
DB_PASSWORD=''sua senha''
```

Salvar e executar os seguintes comandos
```
php artisan key:generate
php artisan migrate
php artisan serve
```

## Licença

[MIT](https://choosealicense.com/licenses/mit/)