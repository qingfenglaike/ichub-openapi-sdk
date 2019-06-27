<?php
/**
 * Created by PhpStorm.
 * User: KYO
 * Date: 2019/6/21
 * Time: 10:42
 */

namespace ICHUB;


use ICHUB\request\RequestCore;
use ICHUB\core\Sign;
use ICHUB\exception\RequestCore_Exception;
use ICHUB\model\SupplyModel;

class IchubClient extends IchubClientBase
{
    /**
     * @param $currency_id  string U|R 币种
     * @param $tax_rate float --税率[0-2]
     * @param $items --供货项
     * @return array|bool|mixed
     */
    public function uploadSupply($currency_id, $tax_rate, $items)
    {
        $data = ['api_code' => SupplyModel::$method, 'tax_rate' => $tax_rate, 'currency_id' => $currency_id, 'items' => $items];
        return $this->request($data, ['items']);
    }
}