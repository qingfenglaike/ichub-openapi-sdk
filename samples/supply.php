<?php
/**
 * Created by PhpStorm.
 * User: KYO
 * Date: 2019/6/21
 * Time: 12:27
 */
require_once __DIR__ . '/common.php';

$app_id    = '4d7a6d8828a8bf7ec48195c6f7e81a88';
$app_key   = '123456';
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