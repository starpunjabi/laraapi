# Creating Restful APIs with laravel

  We will create simple application that solve all your queries regarding Restful APIs in Laravel 5.7.19 and mySql

## Getting Started

I assume that you have basic knowledge of PHP and laravel. We will create a sample Restful APIs with Authors and their blogs relations, so you will understand easily . 

### Prerequisites
PHP 7.1.3
Laravel 5.7.*
Mysql DB  

 

> I am assuming that you already setup your server and php/mysql, so we can jump directly learning stuff which is the main purpose of this tutorial.

### Installing Laravel

First of navigate to your working directory and install Laravel by composer

**Syntax**
```
composer create-project laravel/laravel {projectName} "5.7.*" --prefer-dist
```
**Or**
```
composer create-project --prefer-dist laravel/laravel:5.7.* {projectName}
```
**Example:**
```
composer create-project --prefer-dist laravel/laravel laraapi
```

Let's start playing with code now !!

## Adding Resource Controller and Models 
First of all we will create Models and Controllers by using artisan CLI
```
php artisan make:model Model/Author –a
```
![enter image description here](https://lh3.googleusercontent.com/gNBjm_b2PhgIsew9PPAMffO989zrvnQvfiOx6wFdX-w0xrP0InRcVcrMpoKpc6ZQcjyF1mJu2ZY "Adding Author Model")

> -a option denotes --all | It will Generate a migration, factory, and resource controller for the model, all at once ;)

Similarly, now we will create Blog Model by using -a option
```
php artisan make:model Model/Blog –a
```
![adding blog model controller](https://lh3.googleusercontent.com/TxNUxLcs8feQRcGOO9-nW3mON7ICs2CCU85lwHnQlYl8ZOR9EBA7A-tWDTx32jK_baaWjL0DtuQ "adding blog")

So, Model, Factory, Migration and Controller created at once. Thanks to artisan :)


### Moving Controllers to API directory
As we are creating APIs here, so i recommend to move resource Controllers created for API purpose under API directory, so new path of our Controller will be:
![enter image description here](https://lh3.googleusercontent.com/PWLl6xpIQ7fjY62Hs4OQygeTLPxLs3lxf7wKnhAupWnvAgah_Up83iKVe5p9ZV-LJeHRarhV0zI "Controller Structure")
