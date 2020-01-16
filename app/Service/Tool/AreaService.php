<?php


namespace App\Service\Tool;


use App\model\tool\Area;
use App\Service\BaseService;

class AreaService extends BaseService
{
    public function getList(){
        $areas = Area::query()->orderByDesc('sort')->select('cname','ename','area')->get();
        return $this->success($areas);
    }
}