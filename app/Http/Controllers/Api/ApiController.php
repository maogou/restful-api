<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    /**
     * api接口统一抛出异常方法
     *
     * @param string $message
     * @param int $code
     * @throws ApiException
     */
    protected function apiAbort($message='server error',$code = 500){
        throw new ApiException($message,$code);
    }
}
