# LOJA is the beginning of your custom ecommerce on Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/suavy/loja-for-laravel.svg?style=flat-square)](https://packagist.org/packages/suavy/loja-for-laravel)
[![Build Status](https://img.shields.io/travis/suavy/loja-for-laravel/master.svg?style=flat-square)](https://travis-ci.org/suavy/loja-for-laravel)
[![Quality Score](https://img.shields.io/scrutinizer/g/suavy/loja-for-laravel.svg?style=flat-square)](https://scrutinizer-ci.com/g/suavy/loja-for-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/suavy/loja-for-laravel.svg?style=flat-square)](https://packagist.org/packages/suavy/loja-for-laravel)

LOJA is a [Laravel](https://laravel.com/) package that help you add eCommerce features to your working Laravel application. LOJA comes with a functional backend (easy to add on existing [Backpack](https://backpackforlaravel.com/) admin panel, or in a new one) and a DIY frontend.

__:warning: THIS IS CURRENTLY IN DEVELOPMENT AND NOT WORKING__

## Installation

Install the package via composer:

```bash
composer require suavy/loja-for-laravel
```

> Please, note that the package is made for [Backpack for Laravel](https://backpackforlaravel.com/) which is free for non-commercial use only.

You need to follow the [Backpack for Laravel](https://backpackforlaravel.com/) installation first if you don't have it already in your project. If you are not familiar with Backpack, it's time to start!

After having your backpack installation ready, it's time to do the LOJA installation.

Start by publishing the config file, get a look at it and fill it! (Some configuration are required, so don't forget to do it)

```bash
php artisan vendor:publish ...
```

Next, publish migrations and migrate.
```bash
php artisan vendor:publish --provider="Suavy\LojaForLaravel\LojaForLaravelServiceProvider" --tag="migrations"
php artisan migrate
```

Publish views
```bash
php artisan vendor:publish --provider="Suavy\LojaForLaravel\LojaForLaravelServiceProvider" --tag="views"
```

<!--
Add LOJA front routes to your web file (or custom) aka Front routes integration
```bash
...
```
-->

Add LOJA Backpack sidebar to your current Backpack sidebar :
```bash
@include('loja::admin.sidebar')
```

Add LOJA Backpack routes ....
```bash
todo
```

<!--
- Stripe configuration ? or already done in main config ?
-->

## Usage

### Backend
> Everything was already done during the installation. So you can start using your backend now :rocket:

### Frontend (Do It Yourself)
LOJA only create empty views for you, but in each view you have access to the needed variables and their attributes to make your beautiful frontend like you always do.

> You can add a prefix to every LOJA routes updating the ``routes_prefix`` on config file.
>
#### GET routes

| route | route name | view | variables |
|---|---|---|---|
| / | loja.home | .../home/index.blade.php | $featuredProducts |
| /cart | loja.cart | .../cart/index.blade.php | $cart |
| /category/{id} | loja.category.show | .../category/show.blade.php |  $category |
| /collection/{id} | loja.collection.show | .../collection/show.blade.php | $collection |
| /product/{id} | loja.product.show | .../product/show.blade.php | $product, $relatedProducts |
| /user/orders | loja.user.order.index | .../user/order/index.blade.php | $orders |
| /user/order/{id} | loja.user.order.show | .../user/order/show.blade.php | $order |

<!-- todo Missing checkout/payment routes -->

#### POST routes

| route name | parameters | description |
|---|---|---|
| cart.product.add | $product, $quantity | add a product to cart |
| cart.product.remove | $product | remove a product from cart |
| cart.empty | - | empty the cart |
| cart.product.update-quantity | $product, $diff | update product cart quantity |

#### Helper features (available everywhere)

| helper function | description |
|---|---|
| loja_categories | return a Collection of categories |
| loja_collections | return a Collection of collections |
| loja_products($params) | return a Collection of products |
