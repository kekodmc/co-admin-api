<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2020/3/26
 * Time: 10:40
 */

namespace app\exception;


use think\db\exception\PDOException;
use think\exception\Handle;
use Throwable;
use think\Response;

class Http extends Handle
{
    public function render($request, Throwable $e): Response
    {
        // 参数验证错误
//        if ($e instanceof ValidateException) {
//            return json($e->getError(), 422);
//        }

        // 请求异常
//        if ($e instanceof HttpException && $request->isAjax()) {
//            return response($e->getMessage(), $e->getStatusCode());
//        }
        //数据库异常
//        if($e instanceof PDOException){
//            return errorResponse($e->getMessage());
//        }
        return $this->handleError($e->getMessage(),$request->isAjax());
        // 其他错误交给系统处理
//        return parent::render($request, $e);
    }
    //错误处理
    protected function handleError($msg,$isAsync){
        if($isAsync){
            //异步处理
//            return errorResponse($msg);
        }
        return errorResponse($msg);
    }
}