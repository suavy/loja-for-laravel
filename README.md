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
Simply include ``todo`` on your existing backpack sidebar, or configure backpack first to get started.

### Do It Yourself Frontend

blabla

| Route | View | Variables |
|---|---|---|
| / |  | $featuredProducts |
| /category/{id} |  |  |
| /collection/{id} |  |  |
| /product/{id} |  |  |

- If you want you can add a prefix to every loja routes, change "routes_prefix" on config file.
- aze

#### Helper features
```
loja_categories()
loja_category($id)
loja_collections()
loja_collection($id)
loja_products()
loja_product($id)
```
