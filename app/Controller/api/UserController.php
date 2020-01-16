<?php


namespace App\Controller\api;


use App\Constants\StatusCode;
use App\Controller\BaseController;
use App\Request\api\user\LoginFrom;
use App\Request\api\user\SignupFrom;
use App\Service\Api\UserFrom;
use App\Service\BaseService;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\SessionInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Lizhaoyang\Captcha\Captcha;

class UserController extends BaseController
{
    /**
     * @Inject()
     * @var UserFrom
     */
    private $userFrom;

    public function login(LoginFrom $loginFrom,ResponseInterface $response){
        $validated = $loginFrom->validated();
        $result = $this->userFrom->login($validated);
        if($result['code'] == BaseService::SUCCESS_CODE){
//            var_dump($result['data']);
            $token = $this->jwt->getToken($result['data']);
            var_dump($token);
            $data = [
                'token' => (string)$token,
                'username' => $result['data']['username'],
            ];
            return $this->responseCreate->success($loginFrom,$response,$data);
        }
        return $this->responseCreate->error($loginFrom,$response,StatusCode::Success,$result['msg'],$result['code']);
    }

    public function signup(SignupFrom $signupFrom,ResponseInterface $response){
        $validated = $signupFrom->validated();
        $captcha = new Captcha($this->container->get(ConfigInterface::class), $this->container->get(SessionInterface::class));
        if($captcha->check($validated['captcha'])){
            $result = $this->userFrom->signup($validated);
        }else{
            $result =  [
                'code' => 422,
                'msg' => '图形验证错误',
                'data' => []
            ];
        }
        return $this->getResult($result,$response,$signupFrom);
    }

    # 刷新token，http头部必须携带token才能访问的路由
    public function refreshToken()
    {
        $token = $this->jwt->refreshToken();
        $data = [
            'code' => 0,
            'msg' => 'success',
            'data' => [
                'token' => (string)$token,
                'exp' => $this->jwt->getTTL(),
            ]
        ];
        return $this->response->json($data);
    }

    public function getUserInfo(ResponseInterface $response){
        $data = $this->jwt->getParserData();
        $user_id = $data['id'];
        $result = $this->userFrom->getUserInfo($user_id);
        return $this->getResult($result,$response);
    }
}