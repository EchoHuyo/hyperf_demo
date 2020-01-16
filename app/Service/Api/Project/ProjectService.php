<?php


namespace App\Service\Api\Project;


use App\model\project\Project;
use App\Service\BaseService;

class ProjectService extends BaseService
{
    /**
     * 增加项目
     * @param array $fromData
     * @return array
     */
    public function addProject(array $fromData){
        $projectModel = new Project();
        $projectModel->user_id = $fromData['user_id'];
        $projectModel->symbol = $fromData['symbol'];
        $projectModel->describe = $fromData['describe'];
        $projectModel->symbol_code = $fromData['symbol_code'];
        $projectModel->symbol_icon = $fromData['symbol_icon'];
        $projectModel->contact = $fromData['contact'];
        $projectModel->contact_phone = $fromData['contact_phone'];
        $projectModel->project_home = $fromData['project_home'];
        $projectModel->white_paper = $fromData['white_paper'];
        $projectModel->ratio = $fromData['ratio'];
        $projectModel->circulation_out = $fromData['circulation_out'];
        $projectModel->circulation_private = $fromData['circulation_private'];
        $projectModel->symbol_price = $fromData['symbol_price'];
        $projectModel->online_exchange = $fromData['online_exchange'];
        try{
            if($projectModel->save()){
                return $this->success();
            }else{
                throw new \ErrorException('项目申请失败');
            }
        }catch (\Throwable $exception){
            return $this->error($exception->getMessage(),(int)$exception->getCode());
        }
    }

    public function page(int $user_id,int $page){
        $paginate = Project::where(['user_id'=>$user_id])->orderByDesc('created_at','id')->paginate(20,["symbol",
            "describe",
            "symbol_code",
            "symbol_icon",
            "contact",
            "contact_phone",
            "project_home",
            "white_paper",
            "ratio",
            "circulation_out",
            "circulation_private",
            "symbol_price",
            "online_exchange",
            "status",
            "created_at",
            "updated_at"],'page',$page);
        foreach ($paginate as $project){
            $project->status_text = 'text';
        }
        return $this->success($paginate);
    }

    public function pageData(Project $project){
        return [
                "symbol", 
				"describe", 
				"symbol_code", 
				"symbol_icon", 
				"contact", 
				"contact_phone", 
				"project_home", 
				"white_paper", 
				"ratio", 
				"circulation_out", 
				"circulation_private", 
				"symbol_price", 
				"online_exchange", 
				"status",
				"admin_status", 
				"created_at", 
				"updated_at", 
        ];
    }
}