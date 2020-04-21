<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Str;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof  ApiException) {
            $data['message'] = $exception->getMessage();
            $code = $exception->getCode();

            return $this->transferJson($data,$code);
        }

        $uri = ltrim($request->getRequestUri(),'/');

        $response = parent::render($request, $exception);

        if (Str::startsWith(strtolower($uri),'api')) {
            $content = json_decode($response->getContent(),true);
            $code = $response->getStatusCode();

            return $this->transferJson($content,$code);
        }

        return $response;

    }

    /**
     * 针对api请求的把异常转换为json格式返回
     *
     * @param $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function transferJson($data,$code = 500) {

        return response()->json([
            'data'=>$data,
            'code'=>empty($code) ? 500 : $code
        ]);
    }
}
