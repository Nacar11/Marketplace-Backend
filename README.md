## About Marketplace Configuration

Install Xampp version 8.2.12 above 

<a href="https://www.apachefriends.org/download.html"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>

Run xampp, create and name a fresh empty database, then download the database here: 

<a href="https://drive.google.com/drive/folders/11S3gyDeC9NV2jPEph4Jn89UiIlKmTj7U?usp=sharing"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Latest Stable Version"></a>

Open project with a code editor

Using composer.phar file, input from terminal inside project directory: 
```sh
$ php composer.phar install
```

Make sure to set environment variable for php installed as part of the package from xampp

Input in terminal: 
```sh
$ php artisan key:generate
```
and 
```sh
$ cp .env.example .env
```

Inside env. file:

Make sure DB_PORT is the same port where MySQL of xammp is running

Change MAIL_USERNAME AND MAIL_PASSWORD to the username and password of your google developer account

MAIL_PASSWORD is generated from your google account -> password -> 2-step Verification -> Generate App Password

VONAGE_KEY AND VONAGE_SECRET is provided by creating a vonage account, important for SMS Notification Features but not entirely needed

To run the project, input in terminal:
```sh
$ php artisan serve
```


Check if http://127.0.0.1:8000/api/test 

returns success

Finally, run ngrok:
```sh
$ .\ngrok http --domain=prompt-closely-goose.ngrok-free.app 8000
```



<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
