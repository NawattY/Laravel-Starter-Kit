# Laravel 5 Project Core

Create Laravel 5 Project with ACL Management

### Include
* [l5-repository] - Laravel 5 - Repositories to abstract the database layer package
* [Entrust] - Role-based Permissions for Laravel 5
* [Laravel Theme] - Theme and asset managing for laravel
* [AdminLTE] - AdminLTE Control Panel Template

### Installation

* Download zip file or clone
* edit environment data on app/Bootstrap/DetectEnvironment.php
* config .env.local file ([env config])
* Run [migration]
```sh
php artisan migrate
```
* Run [database seeding]
```sh
php artisan db:seed
```
* Enter http://**your_project_url**/backend with email/password => demo@demo.com/demo

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does it's job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)


   [l5-repository]: <https://github.com/andersao/l5-repository>
   [Entrust]: <https://github.com/Zizaco/entrust>
   [Laravel Theme]: <https://github.com/teepluss/laravel-theme>
   [AdminLTE]: <https://almsaeedstudio.com/>
   [env config]: <http://laravel.com/docs/5.1/installation#environment-configuration>
   [migration]: <http://laravel.com/docs/5.1/migrations>
   [database seeding]: <http://laravel.com/docs/5.1/seeding>