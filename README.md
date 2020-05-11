# LOJA is the beginning of your custom ecommerce on Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/suavy/loja-for-laravel.svg?style=flat-square)](https://packagist.org/packages/suavy/loja-for-laravel)
[![Build Status](https://img.shields.io/travis/suavy/loja-for-laravel/master.svg?style=flat-square)](https://travis-ci.org/suavy/loja-for-laravel)
[![Quality Score](https://img.shields.io/scrutinizer/g/suavy/loja-for-laravel.svg?style=flat-square)](https://scrutinizer-ci.com/g/suavy/loja-for-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/suavy/loja-for-laravel.svg?style=flat-square)](https://packagist.org/packages/suavy/loja-for-laravel)

LOJA is a [Laravel](https://laravel.com/) package that help you add eCommerce features to your working Laravel application. LOJA comes with a functional backend (easy to add on existing [Backpack](https://backpackforlaravel.com/) admin panel, or in a new one) and a DIY frontend.

__:warning: THIS IS CURRENTLY IN DEVELOPMENT AND NOT WORKING__

## Installation

:one: Install the package via composer:

```bash
composer require suavy/loja-for-laravel
```

> Please, note that the package is made for [Backpack for Laravel](https://backpackforlaravel.com/) which is free for non-commercial use only.

:two: Follow the [Backpack for Laravel](https://backpackforlaravel.com/) installation first if you don't have it already in your project. If you are not familiar with Backpack, it's time to start!

:three: Start by publishing our files (that include config file, migrations and views)

```bash
php artisan vendor:publish --provider="Suavy\LojaForLaravel\LojaForLaravelServiceProvider"
```

> Please, before continuing, get a look at ``config/loja.php`` and fill it! Some configuration are required, so don't forget to do it 

:four: Migrate your database
```bash
php artisan migrate
```

:five: Add our LOJA Admin Sidebar to your current Backpack sidebar :
```bash
@include('loja::admin.sidebar')
```

<!--
Add LOJA Backpack routes ....
```bash
todo
```
-->

<!--
Add LOJA front routes to your web file (or custom) aka Front routes integration
```bash
...
```
-->

<!--
- Stripe configuration ? or already done in main config ?
-->

Installation is done now :tada:  

## Usage

### Backend
> Everything was already done during the installation. So you can start using your backend now :rocket:

### Frontend (Do It Yourself)
LOJA only create empty views for you, but in each view you have access to the needed variables and their attributes to make your beautiful frontend like you always do.

> You can add a prefix to every LOJA routes updating the ``routes_prefix`` on config file.

#### GET routes

| route | route name | view | variables |
|---|---|---|---|
| / | loja.home | .../home/index.blade.php | $featuredProducts |
| /cart | loja.cart.index | .../cart/index.blade.php | $cart |
| /category/{category} | loja.category.show | .../category/show.blade.php |  $category |
| /collection/{collection} | loja.collection.show | .../collection/show.blade.php | $collection |
| /product/{product} | loja.product.show | .../product/show.blade.php | $product, $relatedProducts |
| /search?... | loja.search | .../search/index.blade.php | $products |
| /user/orders | loja.user.order.index | .../user/order/index.blade.php | $orders |
| /user/order/{order} | loja.user.order.show | .../user/order/show.blade.php | $order |

> Empty views are located at ``resources/views/vendor/loja/``

<!-- todo Missing checkout/payment routes -->

#### POST routes

| route name | parameters | description |
|---|---|---|
| loja.cart.product.add | $product, $quantity | add a product to cart |
| loja.cart.product.remove | $product | remove a product from cart |
| loja.cart.empty | - | empty the cart |
| loja.cart.product.update.quantity | $product, $quantity | update product cart quantity |

#### Helper features (available everywhere)

| helper function | description |
|---|---|
| loja_categories | return a Collection of categories |
| loja_collections | return a Collection of collections |
| loja_products($params) | return a Collection of products |
