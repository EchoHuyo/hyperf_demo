<?php


namespace App\Controller\tool;


use App\Controller\BaseController;
use App\model\tool\Sms;
use App\Request\tool\ForgetSmsFrom;
use App\Request\tool\SmsFrom;
use App\Service\Tool\AreaService;
use App\Service\Tool\SmsService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\ResponseInterface;

class SmsController extends BaseController
{
    /**
     * @Inject()
     * @var SmsService
     */
    private $smsService;
    /**
     * @Inject()
     * @var AreaService
     */
    private $areaService;
    /**
     * 发送注册短信
     * @param SmsFrom $from
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendSignupSms(SmsFrom $from,ResponseInterface $response){
        $fromData = $from->validated();
        $result = $this->smsService->sendSms($fromData['telephone'],Sms::type_signup,$fromData['area']);
        return $this->getResult($result,$response,$from);
    }

    /**
     * 发送忘记密码短信
     * @param ForgetSmsFrom $from
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendForgetSms(ForgetSmsFrom $from,ResponseInterface $response){
        $fromData = $from->validated();
        $result = $this->smsService->sendSms($fromData['telephone'],Sms::type_forget,$fromData['area']);
        return $this->getResult($result,$response,$from);
    }

    /**
     * 获取area列表
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getArea(ResponseInterface $response){
        $result = $this->areaService->getList();
        return $this->getResult($result,$response);
    }
}