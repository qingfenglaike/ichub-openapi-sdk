<?php
/**
 * Created by PhpStorm.
 * User: KYO
 * Date: 2019/6/21
 * Time: 11:04
 */

namespace ICHUB\core;


class SignRsa extends SignRsaBase
{
    private static $public_key = '';
    private static $private_key = '';

    /**
     * SignRsa constructor.
     * @param $public_key
     * @param $private_key
     */
    public function __construct($public_key, $private_key)
    {
        self::$public_key  = $public_key;
        self::$private_key = $private_key;
    }

    /**
     *
     * @param $data
     * @return string
     */
    public function publicSign($data)
    {
        $sign = parent::rsa_encrypt($data, self::$public_key);
        return $sign;
    }

    /**
     * @param $sign
     * @return array|bool
     */
    public function signArr($sign)
    {
        return parent::getSignArr(self::$private_key, $sign);
    }

    /**
     * @param $sign
     * @return array|bool
     */
    public function signStr($sign)
    {
        return parent::getSignStr(self::$private_key, $sign);
    }

    /**
     * @param $preStr
     * @param $sign
     * @return bool
     */
    public function privateRsaVerify($preStr, $sign)
    {
        $result = parent::rsa_decrypt($sign, self::$private_key);
        if ($result && $result == $preStr) {
            return true;
        } else {
            return false;
        }
    }
}