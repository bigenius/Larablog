# Larablog

 Larablog aims to be a Wordpress-like framework, built in Laravel

## Install

* composer install
* npm install
* copy .env.example to .env
* edit db-settings and Recaptcha-keys in .env 
* php artisan key:generate
* php artisan migrate
* php artisan db:seed
* php artisan elfinder:publish
* gulp


## Content

The seeder will create an admin user: **admin@example.com** with the password: **admin**, as well as create some initial content (post, page, menu, categories and tags).

## License

Larablog and the Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
