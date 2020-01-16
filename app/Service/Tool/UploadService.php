<?php


namespace App\Service\Tool;


use App\Service\BaseService;
use Hyperf\Di\Annotation\Inject;
use JunBaby\FileStore\Service\FileStoreInterface;

class UploadService extends BaseService
{
    /**
     *文件管理
     * @Inject()
     * @var FileStoreInterface
     */
    private $file;

    public function upload($request){
        try{
            $path = $this->file->store(
                $request['file']
            );
            $imgUrl = str_replace(config('filestore.local.save_path'),config('filestore.local.path'),$path);
            return $this->success(['path' => $this->file->url($imgUrl)]);
        }catch (\Throwable $exception){
            return $this->error($exception->getMessage(),(int)$exception->getCode());
        }
    }
}