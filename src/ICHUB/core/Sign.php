<?php
/**
 * Created by PhpStorm.
 * User: KYO
 * Date: 2019/6/21
 * Time: 10:48
 */

namespace ICHUB\core;
class Sign extends CoreBase
{
    private static $sign_type = self::SIGN_MD5;
    private static $instance = null;

    final public static function init()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setSignType($sign_type)
    {
        if ($sign_type == self::SIGN_MD5 || $sign_type == self::SIGN_RSA) {
            self::$sign_type = $sign_type;
        }
        return self::$instance;
    }

    /**
     * build sign
     * @param $para_temp
     * @param $key
     * @param string $public_key_path
     * @param string $private_key_path
     * @return string
     */
    public function buildRequestSign($para_temp, $key, $public_key_path = '', $private_key_path = '')
    {
        $para_filter = $this->paraFilter($para_temp);
        $para_sort   = $this->argSort($para_filter);
        $preStr      = $this->createLinkstring($para_sort);

        if ($key) {
            $preStr = $preStr . "&" . $key;
        }
        if (self::$sign_type == self::SIGN_MD5) {
            $mySign = $this->md5Sign($preStr);
        } else if (self::$sign_type == self::SIGN_RSA) {
            if ($public_key_path || $private_key_path) {
                $this->setErrorMsg('public_key_path or private_key_path is empty ');
                return false;
            }
            if (!file_exists($public_key_path) || !file_exists($private_key_path)) {
                $this->setErrorMsg('public_key or private_key file not exists ');
                return false;
            }
            $Sign   = new SignRsa($public_key_path, $private_key_path);
            $mySign = $Sign->publicSign($preStr);
        } else {
            $this->setErrorMsg('sign_type is invalid');
            return false;
        }

        return $mySign;
    }

    /**
     * @param $preStr
     * @return string
     */
    function md5Sign($preStr)
    {
        $sign = md5($preStr);
        return $sign;
    }

    /**
     * @param $preStr
     * @param $sign
     * @return bool
     */
    function md5Verify($preStr, $sign)
    {
        $mySign = md5($preStr);
        if ($mySign == $sign) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param  array $param
     * @return mixed
     */
    public function paraFilter($param)
    {
        $para_filter = array();
        foreach ($param as $key => $val) {
            if ($key == "sign" || $key == "sign_type" || $val === "") continue;
            else    $para_filter[$key] = $param[$key];
        }
        return $para_filter;
    }

    /**
     *
     * @param  array $param
     * @return mixed
     */
    public function argSort($param)
    {
        ksort($param);
        reset($param);
        return $param;
    }

    /**
     * @param array $param
     * @return mixed
     */
    function createLinkString($param)
    {
        $arg = "";
        foreach ($param as $key => $val) {
            if (is_array($val)) $val = json_encode($val);

            $arg .= $key . "=" . $val . "&";
        }
        //去掉最后一个&字符
        $arg = substr($arg, 0, strlen($arg) - 1);
        //如果存在转义字符，那么去掉转义
        if (get_magic_quotes_gpc()) {
            $arg = stripslashes($arg);
        }
        return $arg;
    }

}