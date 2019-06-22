# ICHUB OpenApi SDK for PHP

## Run environment
- PHP 7.0+.
- cURL extension.

Tips:

- In Ubuntu, you can use the ***apt-get*** package manager to install the *PHP cURL extension*: `sudo apt-get install php5-curl`.

## Install ICHUB APi PHP SDK

- If you use the ***composer*** to manage project dependencies, run the following command in your project's root directory:

        composer require ichub/ichub-openapi-sdk-php

   You can also declare the dependency on Alibaba Cloud OSS SDK for PHP in the `composer.json` file.

        "require": {
            "ichub/ichub-openapi-sdk-php": "~1.0"
        }

   Then run `composer install` to install the dependency. After the Composer Dependency Manager is installed, import the dependency in your PHP code: 

        require_once __DIR__ . '/vendor/autoload.php';

- You can also directly download the packaged [PHAR File][releases-page], and 
   introduce the file to your code: 

        require_once '/path/to/ichub-openapi-sdk-php.phar';

- Download the SDK source code, and introduce the `autoload.php` file under the SDK directory to your code: 

        require_once '/path/to/ichub-openapi-sdk-php/autoload.php';


### supply sample

  ```php 
    <?php
$app_id    = '2916ce5c8c31bbcf9d34954e0a98cbb3';
$app_key   = 'W0ZkINUqP9gm0D0n';
$sign_type = "MD5";

$client = new \ICHUB\IchubClient($app_id, $app_key, $sign_type);
$items  = [
    [
        'sku' => '111', 'brand' => '', 'datecode' => '', 'quality' => '', 'date_of_delivery' => '', 'moq' => '',
        'coo' => '', 'product_qty' => 1, 'price_unit' => '', 'price_interval' => '', 'description' => '', 'product_code' => ''
    ],
    [
        'sku' => '222', 'brand' => '', 'datecode' => '', 'quality' => '', 'date_of_delivery' => '', 'moq' => '',
        'coo' => '', 'product_qty' => 1, 'price_unit' => '', 'price_interval' => '', 'description' => '', 'product_code' => ''
    ]
];
var_dump($client->uploadSupply('R', $items));
exit;
```


## License

- MIT

## Contact us

- [ICHUB  official website](https://www.ichub.com).
-


