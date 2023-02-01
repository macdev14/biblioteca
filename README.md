# Biblioteca

Biblioteca CRUD.

## Recursos Utilizados

[Laravel](https://laravel.com/docs/5.8/installation)

[Composer](https://getcomposer.org)

[MySQL](https://www.mysql.com)

## Variaveis de Ambiente

#### Alterar FILESYSTEM_DISK 

```bash
FILESYSTEM_DISK=public
```

## Utilização



```bash
git clone https://github.com/macdev14/biblioteca.git
cd biblioteca 
php artisan migrate
php artisan criar-permissoes
php artisan db:seed
php artisan db:seed --class=CreateAdminUserSeeder
php artisan serve
```


## License

[MIT](https://choosealicense.com/licenses/mit/)