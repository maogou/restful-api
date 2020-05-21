<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\ApiException;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @var int
     */
    protected $dataCode = 200;

    /**
     * 设置状态码
     * @param $code
     * @return $this
     */
    public function setStatusCode($code)
    {
        $this->statusCode = $code;

        return $this;
    }

    /**
     * 获取状态码
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * 设置返回数据的状态码
     *
     * @param $code
     * @return $this
     */
    public function setDataCode($code){
        $this->dataCode = $code;

        return $this;
    }

    /**
     * 获取返回数据的状态码
     *
     * @return int
     */
    public function getDataCode(){
        return $this->dataCode;
    }


    /**
     * 成功响应
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithSuccess($data)
    {
        $data = (is_array($data) || is_object($data)) ? $data : ['message' => $data];

        return $this->respond([
            'data' => $data,
            'code' => $this->getDataCode()
        ]);
    }

    /**
     * 统一响应数据
     * @param $data
     * @param array $header
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respond($data, array $header = [])
    {
        return response()->json($data, $this->getStatusCode(), $header);
    }

    /**
     * api接口统一抛出异常方法
     *
     * @param string $message
     * @param int $code
     * @throws ApiException
     */
    protected function apiAbort($message = 'Server internal error', $code = 500)
    {
        throw new ApiException($message, $code);
    }
}
