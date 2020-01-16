<?php


namespace App\Service;


class BaseService
{
    /**
     * 成功返回code
     */
    const SUCCESS_CODE = 200;

    /**
     * 失败默认返回code
     */
    const ERROR_CODE = 500;

    /**
     * 成功返回模板
     * @param $data
     * @return array
     */
    protected function success($data = []){
        return [
            'code' => self::SUCCESS_CODE,
            'data' => $data
        ];
    }

    /**
     * 错误返回模板
     * @param string $msg
     * @param int $code
     * @param string|null $model
     * @return array
     */
    protected function error(string $msg, int $code=self::ERROR_CODE,?string $model= null){
        return [
            'code' => $code,
            'msg' => $msg,
            'data' => ''
        ];
    }
}