<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface as SymfonyHttpExceptionInterface;


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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
    /**
     * 共通エラーページ
     * エラーコードは500と404だけにする
     * @return \Illuminate\Http\Response
     */
    protected function renderHttpException(SymfonyHttpExceptionInterface $e)
    {
        $status = $e->getStatusCode();

        if ($status >= 500 && $status <= 600) {
            $status_code = 500;
            $message = '予期せぬエラーが発生しました。';
        } else {
            $status_code = 404;
            $message = 'お探しのページは見つかりませんでした。';
        }

        return response()->view("errors.common", ['status_code' => $status_code, 'message' => $message]);
    }
}
