<?php


namespace App\Controller\tool;


use App\Controller\BaseController;
use App\Request\tool\UploadFileFrom;
use App\Request\tool\UploadImgFrom;
use App\Service\Tool\UploadService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface;

class UploadController extends BaseController
{
    /**
     * @Inject()
     * @var UploadService
     */
    private $upload;

    public function index(UploadImgFrom $from ,ResponseInterface $response){
        $fromData = $from->validated();
        $result = $this->upload->upload($fromData);
        return $this->getResult($result,$response,$from);
    }

    public function file(UploadFileFrom $from,ResponseInterface $response){
        $fromData = $from->validated();
        $result = $this->upload->upload($fromData);
        return $this->getResult($result,$response,$from);
    }
}