<?php


namespace App\Controller\tool;


use App\Controller\BaseController;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Contract\SessionInterface;
use Lizhaoyang\Captcha\Captcha;

class CaptchaController extends BaseController
{
    public function getCaptcha(){
        $captcha = new Captcha($this->container->get(ConfigInterface::class), $this->container->get(SessionInterface::class));
        return $captcha->create();
    }
}