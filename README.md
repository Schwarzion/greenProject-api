# GreenProject-api 

2nd Aston project |  PHP API 

  

## Requirements 

PHP: v7.2 (as a minimum for Lumen 6.0)  Install the following : 

OpenSSL PHP Extension 

PDO PHP Extension 

Mbstring PHP Extension 

Lumen: v6.0 (minimum) 
https://lumen.laravel.com/docs/6.x/installation 

Composer: we recommend that you use the latest version possible (at the moment 1.10.1) 
https://getcomposer.org/ 

MySQL: v8.0. You can install any visual tool to help you. 
https://dev.mysql.com/doc/refman/8.0/en/ 
 

---------------------------------------------- 

## How to install and run project 
 
`composer install` 
 
To be able to run this project, you will need to add a database to your mysql server. 
Be sure to have the minimum mysql requirements. 
 
Add databse to mysql 
Check on the internet if you don’t know how to. 

Complete file .env.exemple with your DB configuration, your username and your password. 

Generate a JWT token with command ‘php artisan jwt:secret’ . 
 
Generate manually an app key and add it to APP_KEY. (Ex: ‘7J/hU/TT<?f=*p7J[U2Gh9_%~ojd8l’)  

Rename file to “.env”. 
 
Launch the server :  
`php -S localhost:8000 -t public` 
 
To test the application open a browser (or Postman if you prefer) and enter this url : 
` http://localhost:8000/test `
If you this message in return: 
` {"msg":"hello"} `
App is working!

If not, try to step backward and retry.

---------------------------------------------- 


# Lumen PHP Framework 

 Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. \ 

We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pa\ 

in out of development by easing common tasks used in the majority of web projects, such as routing, database abstracti\ 

on, queueing, and caching. 

## Official Documentation  

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).  

## License 

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). 

 
## Artisan 
 
Check available commandes : 
` php artisan list` 


---------------------------------------------- 

If you encounter any problem using this project, feel free to post a new issue on Github