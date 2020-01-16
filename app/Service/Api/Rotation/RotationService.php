<?php


namespace App\Service\Api\Rotation;


use App\model\rotation\Rotation;
use App\Service\BaseService;

class RotationService extends BaseService
{
    /**
     * api获取滚动图
     * @param $info
     * @return array
     */
    public function rotation($info){
        $data = Rotation::query()->where([
            'lang' => $info['lang'],
            'status' => Rotation::Status_Yes
        ])->orderByDesc('sort')->select('url','type','type')->get();
        return $this->success($data);
    }
}