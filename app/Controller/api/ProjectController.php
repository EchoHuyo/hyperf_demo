<?php


namespace App\Controller\api;


use App\Controller\BaseController;
use App\Request\api\project\ProjectFrom;
use App\Service\Api\Project\ProjectService;
use Hyperf\Di\Annotation\Inject;

class ProjectController extends BaseController
{
    /**
     * @Inject()
     * @var ProjectService
     */
    private $projectService;

    public function addProject(ProjectFrom $from){
        $fromData = $from->validated();
        $userData = $this->jwt->getParserData();
        $fromData['user_id'] = $userData['id'];
        $result = $this->projectService->addProject($fromData);
        return $this->getResult($result);
    }

    public function page(){
        $result = $this->projectService->page(1,2);
        return $this->getResult($result);
    }
}