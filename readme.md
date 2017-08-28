# Montly PHP SDK

[![Build Status](https://travis-ci.org/montly/montly-php-sdk.svg?branch=master)](https://travis-ci.org/montly/montly-php-sdk)
[![codecov](https://codecov.io/gh/montly/montly-php-sdk/branch/master/graph/badge.svg)](https://codecov.io/gh/montly/montly-php-sdk)
[![License](https://poser.pugx.org/stripe/stripe-php/license.svg)](https://packagist.org/packages/stripe/stripe-php)

Sign up for a Montly account at https://www.montly.com/sv/

## Requirements

PHP 5.6 and later.

## Composer

You can install the bindings via [Composer](http://getcomposer.org/). Run the following command:

```bash
composer require montly/montly-php-sdk
```

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Dependencies

The SDK require the following extension in order to work properly:

- [`curl`](https://secure.php.net/manual/en/book.curl.php), although you can use your own non-cURL client if you prefer
- [`json`](https://secure.php.net/manual/en/book.json.php)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.

## Documentation

Please see [http://montly.io](http://montly.io) for up-to-date documentation about the underlying REST API.

## Getting started

### Getting your tariffs

```php
require_once('vendor/autoload.php');

Montly\Montly::setApiKey(API_KEY);
$tariffs = Montly\Tariff::retrieve();
print_r($tariffs);

```

### Creating an order

```php
require_once('vendor/autoload.php');

/*
  See http://montly.io/#create-a-new-order for complete set of fields
*/
$order = [ "orderId" => $orderId,    // Unique id from your ecommerce system
           "firstName" => "Stan",
           "lastName" => "Hunter",
            "totalAmount" => 900000, // Equals 9000.00 SEK 
            "VAT" => 250000,         // Equals 25.00%
            "customerIp" => "..",    // Valid IP-number
            "months" => 24,          // Length of leasing agreement
            "tariff" => .05,         // Tariff
         ]

Montly\Montly::setApiKey(API_KEY);
$response = Montly\Order::create($order);
if (isset($response->errors)) {
    // Something went wrong!
    // Error details in $response->errors array
    print_r($response);
} else {
    // Success
}

```

### Checking order status

```php
require_once('vendor/autoload.php');
$orderId = 'abc123'; 
Montly::setApiKey(API_KEY);
$response = Order::status($orderId);
$status = $response->status;

```




