<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\SessionInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Lizhaoyang\Captcha\Captcha;

class IndexController extends BaseController
{

    public function index()
    {
        $user = $this->request->input('user', 'bbcash');
        $method = $this->request->getMethod();
        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function getData(ResponseInterface $response){
        $data = $this->jwt->getParserData();
        var_dump($data);
        return $this->responseCreate->success([],$response,$data);
    }
    public function captchaCheck(){
        $code = $this->request->input('captcha');
        var_dump($code);
        $captcha = new Captcha($this->container->get(ConfigInterface::class), $this->container->get(SessionInterface::class));
         var_dump($captcha->check($code));
        return 'success';
    }
}
