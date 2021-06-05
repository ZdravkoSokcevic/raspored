# App is written in Laravel v8.12 framework

## Requirements To run this app:

* php >= 7.3 | php 8.0

* BCMath PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* GD Library >=2.0 or Imagick PHP extension >=6.5.7

## Packages used for backend:

* fideloper/proxy
* fruitcake/laravel-cors
* laravel/sail
* nunomaduro/collision

## Frontend libraries
* [Font-Awesome v5.12.0](https://fontawesome.com)
* [jQuery v3.4.1](https://jquery.com)
* [jQuery scrollTo](https://github.com/flesler/jquery.scrollTo)
* [Moment js v2.29](https://momentjs.com)
* [bootstrap-timepicker v0.5.2 ](https://mdbootstrap.com/docs/b4/jquery/forms/time-picker1/)
* [Bootstrap v4.6.0](https://getbootstrap.com)
* [Chart.js](https://www.chartjs.org)
* [Toastr](https://github.com/CodeSeven/toastr)


## For properly run app you need:

* Go to root of app
* Run `$which(php) composer.phar install` or `composer install`
* Run `$which(php) artisan key:generate`
* Run `cp .env.example .env`
* Run `npm i` or `npm install`
* In env you need to setup:
	* `APP_NAME` possible values `DM_SRBIJA` or `DM_BIH`
	* `APP_URL` is domain (path) to your app
	* `APP_LOCALE` possible values `bih` or `sr`
	* `DB_DATABASE` name of your database
	* `DB_USERNAME` your mysql client user
	* `DB_PASSWORD` your mysql client password

* For Dev Run `$which(php) artisan migrate` to run app migrations and make tables
* If you wann'a to fill tables go to `database/seeds/DatabaseSeeder.php` file and uncomment lines for specific tables which you wan't to fill and then run `$which(php) artisan db:seed` from root of your project
* Run App:
	* Add propietary permissions for your app
	* Go to root of your project
	* Run `sudo chown $(id -u):$(id -g) -R .` in case if you run your app on internal php cli server
	* Run `sudo chown $(id -u):www-data -R .` in case if you run your app on Nginx/Fpm or Apache2 server
	* Run `chmod 755 -R .` to change permissions for your app
	* Link storage
		* Run `$which(php) artisan storage:link` or
		* Run `cd ./public && ln -s ../storage/app/public ./storage`
		* If you are in public folder run `ln -s ../resources ./src` to link resources folder in public path
	* If you run internal server go to root of your project and then run `php artisan serve` and internal cli server goes listening on `127.0.0.1:8000`
	* To run desktop app install gulp with `npm i --global gulp` and then run `gulp`