<?php


namespace App\Controller;

use App\Constants\StatusCode;
use App\Kernel\ResponseCreate;
use App\Service\BaseService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Phper666\JwtAuth\Jwt;
use Hyperf\Contract\ContainerInterface;

class BaseController extends AbstractController
{

    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;
    /**
     * 通过 `@Inject` 注解注入由 `@var` 注解声明的属性类型对象
     *
     * @Inject
     * @var ResponseCreate
     */
    protected $responseCreate;
    /**
     * @Inject()
     * @var Jwt
     */
    protected $jwt;

    /**
     * @param array $result
     * @param array $response
     * @param bool $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function getResult(array $result,$response = [],$request = false){
        $request = empty($request)?$this->request:$response;
        $response = empty($response)?$this->response:$response;
        if($result['code'] == BaseService::SUCCESS_CODE){
            return $this->responseCreate->success($request,$response,$result['data']);
        }
        return $this->responseCreate->error($request,$response,StatusCode::Success,$result['msg'],$result['code']);
    }

    /**
     * 获取认证数据
     * @return array
     */
    protected function getJwtData(){
        return $this->jwt->getParserData();
    }
}