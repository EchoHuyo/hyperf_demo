<?php


namespace App\Controller\api;


use App\Controller\BaseController;
use App\Request\api\rotation\RotationFrom;
use App\Service\Api\Rotation\RotationService;
use Hyperf\Di\Annotation\Inject;

class RotationController extends BaseController
{
    /**
     * @Inject()
     * @var RotationService
     */
    private $rotationService;

    public function index(RotationFrom $from){
        $fromData = $from->validated();
        $result = $this->rotationService->rotation($fromData);
        return $this->getResult($result);
    }
}