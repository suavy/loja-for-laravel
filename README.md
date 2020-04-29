# LOJA is the beginning of your custom ecommerce on Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/suavy/loja-for-laravel.svg?style=flat-square)](https://packagist.org/packages/suavy/loja-for-laravel)
[![Build Status](https://img.shields.io/travis/suavy/loja-for-laravel/master.svg?style=flat-square)](https://travis-ci.org/suavy/loja-for-laravel)
[![Quality Score](https://img.shields.io/scrutinizer/g/suavy/loja-for-laravel.svg?style=flat-square)](https://scrutinizer-ci.com/g/suavy/loja-for-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/suavy/loja-for-laravel.svg?style=flat-square)](https://packagist.org/packages/suavy/loja-for-laravel)

LOJA is a [Laravel](https://laravel.com/) package that help you add eCommerce features to your working Laravel application. LOJA comes with a functional backend (easy to add on existing [Backpack](https://backpackforlaravel.com/) admin panel, or in a new one) and a DIY frontend.

__:warning: THIS IS CURRENTLY IN DEVLOPMENT AND NOT WORKING__

## Installation

You can install the package via composer:

```bash
composer require suavy/loja-for-laravel
```

## Usage

### Backend
The backend is based on [Backpack for Laravel](https://github.com/Laravel-Backpack) which is free for non-commercial use and $69/project for commercial use. Please see [backpackforlaravel.com](https://backpackforlaravel.com/) for more information.


To get started, simply include ``@include('.../views/loja-sidebar-content')`` on your backpack sidebar.

> If you never used backpack before, you will need to learn some basics before getting started.

### Do It Yourself Frontend

#### Routes and "views location" (with their variables)
LOJA only create empty views for you, but in each view you have access to the needed variables and their attributes to make your beautiful frontend.

> If you want you can add a prefix to every LOJA routes, simply update ``routes_prefix`` on config file.

| route | view | variables |
|---|---|---|
| / |  .../home/index.blade.php | $featuredProducts |
| /cart | .../cart/index.blade.php | $cart |
| /category/{id} | .../category/show.blade.php |  $category |
| /collection/{id} | .../collection/show.blade.php | $collection |
| /product/{id} | .../product/show.blade.php | $product, $relatedProducts |
| /user/orders | .../user/order/index.blade.php | variables |
| /user/order/{id} | .../user/order/show.blade.php | variables |
| route | view | variables |
| route | view | variables |


#### Helper features

| helper function | description | additional information |
|---|---|---|
| loja_cart_button | return the card button html | ... |
| loja_categories | return a Collection of categories| ... |
| loja_collections | return a Collection of collections| ... |

#### Trait ...
| function/attribute | description | additional information |
|---|---|---|
|  |  | ... |
|  |  | ... |
|  |  | ... |
