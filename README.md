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

:three: Publish BackpackSettings files (official Backpack addon)
```bash
php artisan vendor:publish --provider="Backpack\Settings\SettingsServiceProvider"
```

:four: Publish our files (that include config file, migrations and views)

```bash
php artisan vendor:publish --provider="Suavy\LojaForLaravel\LojaForLaravelServiceProvider"
```

> Please, before continuing, get a look at ``config/loja.php`` and fill it! Some configuration are required, so don't forget to do it 

:five: Migrate your database
```bash
php artisan migrate
```

:six: Add our LOJA Admin Sidebar to your current Backpack sidebar (located at ``ressources/views/vendor/backpack/base/inc/sidebar_content.blade.php``)
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
:seven: We use [Laravel Livewire]() for some dynamic components (instead of Vue or React), to make theses components work, you need to first include their javascript using their custom blade directives.
```html
<head>
    ...
    @livewireStyles
</head>
<body>
    ...
    @livewireScripts
</body>
```

:eight: Add HasAddress trait to user model
```bash
use Suavy\LojaForLaravel\Traits\HasAddress;

class User extends ...
{
    use HasAddress;
}
```
:nine: Add button to backpack admin in views/vendor/backpack/crud/buttons/toggle-country.blade.php // TODO Trie to remove this step
```bash
@include('loja::admin.crud.buttons.toggle-country')
```

Installation is done now :tada:  

## Usage

### Backend
> Everything was already done during the installation. So you can start using your backend now :rocket:

### Frontend (Do It Yourself)
LOJA only create empty views (except for the cart page that is included), but in each view you have access to the needed variables and their attributes to make your own frontend views.

> You can add a prefix to every LOJA routes updating the ``routes_prefix`` on config file.

#### GET routes

| route | route name | view | variables |
|---|---|---|---|
| /cart | loja.cart.index | .../cart/index.blade.php | $cart |
| - | - | .../cart/empty.blade.php | - |
| /categories | loja.category.index | .../category/index.blade.php |  $categories |
| /category/{category} | loja.category.show | .../category/show.blade.php |  $category |
| /collections | loja.collection.index | .../collection/index.blade.php | $collections |
| /collection/{collection} | loja.collection.show | .../collection/show.blade.php | $collection |
| /payment/success | loja.payment.success | .../cart/payment-success.blade.php | $cart |
| /payment/cancel | **redirects to /cart with message** | - | - |
| /product/{product} | loja.product.show | .../product/show.blade.php | $product, $relatedProducts |
| /search?... | loja.search | .../search/index.blade.php | $products |
| /user/orders | loja.user.order.index | .../user/order/index.blade.php | $orders |
| /user/order/{order} | loja.user.order.show | .../user/order/show.blade.php | $order |

> Empty views are located at ``resources/views/vendor/loja/``

#### Components

| name | description |
|---|---|
| "Loja Add To Cart" | this components must be added in every product page (loja.product.show) |

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
