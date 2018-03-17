entec-2017 [![Latest Stable Version](https://poser.pugx.org/gzero/eloquent-tree/v/stable.png)](https://packagist.org/packages/gzero/eloquent-tree) [![Total Downloads](https://poser.pugx.org/gzero/eloquent-tree/downloads.png)](https://packagist.org/packages/gzero/eloquent-tree) [![Build Status](https://travis-ci.org/AdrianSkierniewski/eloquent-tree.png)](https://travis-ci.org/AdrianSkierniewski/eloquent-tree)
=============

Entec 2017 is a simple project with goal to use TDD  and SOLID principles

## Table of Contents

- [Features](#features)
- [Installation](#installation)

##Features

* Create a Doctor
* List all Doctors
* Update a Doctor
* Remove a Doctor and its appointments
* Create Appointment
* Remove Appointment


## Installation

**Version 1.0 has no patterns.***

**Version 2.0 - TDD, SOLID principles**

1- Begin by installing this package through Composer. You need run:
```
composer require alustau/entec2017
```
2- Next, you should set up your .env through .env.example.
3- Next, you must start server using:
```
php artisan serve
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
