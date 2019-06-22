<?php
/**
 * Created by PhpStorm.
 * User: KYO
 * Date: 2019/6/21
 * Time: 12:27
 */
require_once __DIR__ . '/common.php';

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