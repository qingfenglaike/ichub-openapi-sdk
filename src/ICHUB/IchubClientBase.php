<?php
/**
 * Created by PhpStorm.
 * User: KYO
 * Date: 2019/6/21
 * Time: 11:37
 */

namespace ICHUB;


use ICHUB\request\RequestCore;
use ICHUB\core\Sign;
use ICHUB\exception\RequestCore_Exception;

class IchubClientBase
{
    protected $app_id = '';
    protected $key = '';
    protected $sign_type = '';
    protected $public_key_path = '';
    protected $private_key_path = '';
    protected $timestamp = 0;
    protected $v = '1.0.0';
    protected $host = 'https://open.ichub.com';
    //protected $host = 'http://opendev.ichub.com/router/rest';
    protected $data = [];

    public function __construct($app_id, $key, $sign_type, $v = '1.0.0', $public_key_path = '', $private_key_path = '', $host = '')
    {
        if (!$app_id) {
            die("invalid app_id");
        }

        if (!$key) {
            die("invalid key");
        }
        if (!$sign_type) {
            die("invalid key");
        }
        $this->app_id           = $app_id;
        $this->key              = $key;
        $this->v                = $v;
        $this->sign_type        = $sign_type;
        $this->public_key_path  = $public_key_path;
        $this->private_key_path = $private_key_path;
        $this->timestamp        = round(microtime(true) * 1000);
        if ($host) {
            $this->host = $host;
        }
    }

    protected
    function buildParams($params)
    {
        $params['timestamp'] = $this->timestamp;
        $params['app_id']    = $this->app_id;
        $params['sign_type'] = $this->sign_type;
        $params['v']         = $this->v;
        return $params;
    }

    protected
    function request($data, $filter = [])
    {
        $data         = $this->buildParams($data);
        $build_params = $data;
        if ($filter) {
            foreach ($filter as $f) {
                unset($build_params[$f]);
            }
        }
        $sign = Sign::init()->buildRequestSign($build_params, $this->key, $this->public_key_path, $this->private_key_path);

        $data['sign'] = $sign;
        try {
            $request = new RequestCore($this->host);
            //    $request->add_header('content-type', 'application/json');
            $request->set_method('post');
            $request->set_body($data);
            $request->send_request();
            $content = $request->get_response_body();
            $content = json_decode($content, true);
            return $content ? $content : [];
        } catch (RequestCore_Exception $e) {
            return false;
        }
    }
}