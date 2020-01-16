<?php


namespace App\Controller\admin;


use App\Constants\StatusCode;
use App\Controller\BaseController;
use App\Request\admin\user\LoginFrom;
use App\Request\admin\user\SignupFrom;
use App\Service\Admin\UserFrom;
use App\Service\BaseService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface;

class UserController extends BaseController
{
    /**
     * @Inject()
     * @var UserFrom
     */
    private  $userFrom;

    public function login(LoginFrom $from,ResponseInterface $response){
        $fromData = $from->validated();
        $result = $this->userFrom->login($fromData);
        if($result['code'] == BaseService::SUCCESS_CODE){
            $result['admin'] = 'admin';
            $token = $this->jwt->getToken($result['data']);
            $data = [
                'token' => (string)$token,
                'username' => $result['data']['username'],
            ];
            return $this->responseCreate->success($from,$response,$data);
        }
        return $this->responseCreate->error($from,$response,StatusCode::Success,$result['msg'],$result['code']);
    }

    public function signup(SignupFrom $from){
        $validated = $from->validated();
        $result = $this->userFrom->signup($validated);
        return $this->getResult($result,[],$from);
    }


}