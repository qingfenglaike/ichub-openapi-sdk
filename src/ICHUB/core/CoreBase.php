<?php
/**
 * Created by PhpStorm.
 * User: KYO
 * Date: 2019/6/21
 * Time: 11:12
 */

namespace ICHUB\core;


class CoreBase
{
    const SIGN_MD5 = 'MD5';
    const SIGN_RSA = 'RSA';

    private $msg = '';

    /**
     * set error msg
     * @param $msg
     */
    public function setErrorMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * get error msg
     * @return string
     */
    public function getErrorMsg()
    {
        return $this->msg;
    }
}