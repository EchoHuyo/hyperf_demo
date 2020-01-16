<?php


namespace App\Service\Tool;


use App\model\tool\Sms;
use App\Service\BaseService;

class SmsService extends BaseService
{
    /**
     * 发送短信
     * @param $telephone
     * @param $type
     * @param $area
     * @return array
     */
    public function sendSms($telephone,$type,$area = 86){
        $smsModel = new Sms();
        $smsModel->telephone = $telephone;
        $smsModel->code = $this->getCode();
        $smsModel->type = $type;
        switch ($area){
            case 86:
                $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
                $tpl_id = 182753;//模板id
                break;
            default:
                $sendUrl = 'http://v.juhe.cn/smsInternational/send.php';
                $tpl_id = '';//国外模板id
                break;
        }
        try{
            $this->send($telephone,$smsModel->code,$sendUrl,$tpl_id);
            $smsModel->save();
            return $this->success();
        }catch (\Throwable $exception){
            return $this->error($exception->getMessage(),(int)$exception->getCode());
        }
    }

    /**
     * 获取验证码
     * @return int
     */
    private function getCode(){
        return rand(100000, 999999);
    }

    /**
     * 发送短信请求
     * @param $phone
     * @param $code
     * @param $sendUrl
     * @param $tpl_id
     * @return bool
     * @throws \ErrorException
     */
    private function send($phone,$code,$sendUrl,$tpl_id){
//        $sendUrl = 'http://v.juhe.cn/sms/send'; //短信接口的URL
        $smsConf = array(
            'key'   => '099fdec26797abf1518e87fd4f422654', //您申请的APPKEY
            'mobile'    => $phone, //接受短信的用户手机号码
            'tpl_id'    => $tpl_id, //您申请的短信模板ID，根据实际情况修改
            'tpl_value' =>'#code#='.$code.'&#company#=BBCASH' //您设置的模板变量，根据实际情况修改
        );
        $content = $this->smsCurl($sendUrl,$smsConf,1); //请求发送短信
        if($content){
            $result = json_decode($content,true);
            $error_code = $result['error_code'];
            if($error_code == 0){
                return true;
            }else{
                throw new \ErrorException($result['reason'],1010);
            }
        }else{
            throw new \ErrorException('短信服务商出错',1000);
        }
    }


    /**
     * 聚合发送短信
     * @param $url
     * @param bool $params
     * @param int $ispost
     * @return bool|string
     */
    private function smsCurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }

}