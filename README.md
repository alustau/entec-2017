entec-2017 [![Latest Stable Version](https://poser.pugx.org/alustau/entec2017/v/stable.png)](https://packagist.org/packages/alustau/entec2017)
=============

Entec 2017 is a simple project with goal to use TDD  and SOLID principles

## Table of Contents

- [Features](#features)
- [Installation](#installation)

## Features

* Create a Doctor
* List all Doctors
* Update a Doctor
* Remove a Doctor and its appointments
* Create Appointment
* Remove Appointment


## Installation

**Version 1.0 has no patterns.**

**Version 2.0 - TDD, SOLID principles**

1- Install this project running this:
```shell
$ git clone https://github.com/Alustau/entec-2017.git 
```
2- You need checkout on the version.
```shell
$ git checkout tags/v2.0 
```
3- Next, you should set up your .env through .env.example.

4- Next, you must start server using:
```shell
$ php artisan serve
```

## AppServiceProvider
You can swap between Query Builder or Eloquent services
```php
namespace App\Providers;
use ...;

class AppServiceProvider extends ServiceProvider
{
    protected $type = 'Eloquent' // Query Builder or Eloquent;

```
