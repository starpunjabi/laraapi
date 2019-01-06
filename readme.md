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

As we moved our Controllers, so we need to regenerate namespaces for autoload, so need to run below command,



```
composer dump-autoload

```
 it will associate our controller paths correctly in below files:

> vendor\composer\autoload_classmap.php 

&
> vendor\composer\autoload_static.php 

One more thing, as we moved our controllers inside some other directory i.e API, so we also need to use Controller namespace now inside our Controllers, so please update namespace and add below lines in AuthorController.php and BlogController.php respectively:

    namespace  App\Http\Controllers\API
    use App\Http\Controllers\Controller;

Thats it, now your copy is up to date!

## Setting up ROUTES 
Navigate to api.php under routes
>  'routes\api.php'

First, we will add new route as given below:

    Route::Resource('/authors','API\AuthorController');

and run below command in terminal:

> php artisan route:list

It will show all routes as :

| Method    | URI                       | Name            | Action                                            | Middleware   |
|-----------|---------------------------|-----------------|---------------------------------------------------|--------------|
| GET|HEAD  | /                         |                 | Closure                                           | web          |
| GET|HEAD  | api/authors               | authors.index   | App\Http\Controllers\API\AuthorController@index   | api          |
| POST      | api/authors               | authors.store   | App\Http\Controllers\API\AuthorController@store   | api          |
| GET|HEAD  | api/authors/create        | authors.create  | App\Http\Controllers\API\AuthorController@create  | api          |
| GET|HEAD  | api/authors/{author}      | authors.show    | App\Http\Controllers\API\AuthorController@show    | api          |
| PUT|PATCH | api/authors/{author}      | authors.update  | App\Http\Controllers\API\AuthorController@update  | api          |
| DELETE    | api/authors/{author}      | authors.destroy | App\Http\Controllers\API\AuthorController@destroy | api          |
| GET|HEAD  | api/authors/{author}/edit | authors.edit    | App\Http\Controllers\API\AuthorController@edit    | api          |


Now, we will add api with Resource like:

    Route::apiResource('/authors','API\AuthorController');

now again check routes list by using artisan, you will see difference

> php artisan route:list

It will remove ***~~create~~*** and ***~~edit~~*** from route list, see below:

| Method    | URI                  | Name            | Action                                            | Middleware   |
|-----------|----------------------|-----------------|---------------------------------------------------|--------------|
| GET|HEAD  | /                    |                 | Closure                                           | web          |
| GET|HEAD  | api/authors          | authors.index   | App\Http\Controllers\API\AuthorController@index   | api          |
| POST      | api/authors          | authors.store   | App\Http\Controllers\API\AuthorController@store   | api          |
| GET|HEAD  | api/authors/{author} | authors.show    | App\Http\Controllers\API\AuthorController@show    | api          |
| PUT|PATCH | api/authors/{author} | authors.update  | App\Http\Controllers\API\AuthorController@update  | api          |
| DELETE    | api/authors/{author} | authors.destroy | App\Http\Controllers\API\AuthorController@destroy | api          |


This is how **apiResource**, is helping us by removing unwanted routes, as when using APIs we don't require any page for **creating** and for **editing** purpose.

Similarly, let's create Blog Route also quickly:

Here, as we have to access all blogs associated with particular author like:

> // author/{id}/blogs

so, let's create prefix for authors/

    Route::prefix('/authors')->group(function () {
    	Route::apiResource('{author}/blogs','API\BlogController');
    });

 Now, check **route:list** once again, to see if everything is working fine.
 
| Method    | URI                               | Name            | Action                                            | Middleware   |
|-----------|-----------------------------------|-----------------|---------------------------------------------------|--------------|
| GET|HEAD  | /                                 |                 | Closure                                           | web          |
| GET|HEAD  | api/authors                       | authors.index   | App\Http\Controllers\API\AuthorController@index   | api          |
| POST      | api/authors                       | authors.store   | App\Http\Controllers\API\AuthorController@store   | api          |
| GET|HEAD  | api/authors/{author}              | authors.show    | App\Http\Controllers\API\AuthorController@show    | api          |
| PUT|PATCH | api/authors/{author}              | authors.update  | App\Http\Controllers\API\AuthorController@update  | api          |
| DELETE    | api/authors/{author}              | authors.destroy | App\Http\Controllers\API\AuthorController@destroy | api          |
| GET|HEAD  | api/authors/{author}/blogs        | blogs.index     | App\Http\Controllers\API\BlogController@index     | api          |
| POST      | api/authors/{author}/blogs        | blogs.store     | App\Http\Controllers\API\BlogController@store     | api          |
| GET|HEAD  | api/authors/{author}/blogs/{blog} | blogs.show      | App\Http\Controllers\API\BlogController@show      | api          |
| PUT|PATCH | api/authors/{author}/blogs/{blog} | blogs.update    | App\Http\Controllers\API\BlogController@update    | api          |
| DELETE    | api/authors/{author}/blogs/{blog} | blogs.destroy   | App\Http\Controllers\API\BlogController@destroy   | api          |


 