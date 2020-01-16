<?php


namespace App\Service\Api;


use App\Exception\AccountLockedException;
use App\model\user\AppUser;
use App\Service\BaseService;

class UserFrom extends BaseService
{
    /**
     * 用户注册
     * @param array $signupInfo
     * @return array
     */
    public function signup(array $signupInfo){
        $userModel = new AppUser();
        $userModel->telephone = $signupInfo['telephone'];
        $userModel->username = self::hideTelephone($signupInfo['telephone']);
        $userModel->setPassword($signupInfo['password']);
        $userModel->area = $signupInfo['area'];
        try{
            if($userModel->save()){
                $data = [
                    'username' => $userModel->username,
                ];
                return $this->success($data);
            }else{
                throw new \ErrorException('注册失败');
            }
        }catch (\Throwable $exception){
            return $this->error($exception->getMessage());
        }
    }

    /**
     * 默认用户名
     * @param $telephone
     * @return mixed
     */
    private static function hideTelephone($telephone){
        return substr_replace($telephone, '****', 3, 4);
    }

    public function login(array $loginInfo){
        $userModel = AppUser::query()->where(['telephone' => $loginInfo['telephone']])->first();
        try{
            if(!empty($userModel)&&$userModel->validatePassword($loginInfo['password'])){
                /**
                 * @var AppUser $userModel
                 */
                $this->checkUser($userModel);
                $data = [
                    'id' => $userModel->id,
                    'username' => $userModel->username,
                ];
                return $this->success($data);
            }
            throw new \ErrorException('用户名或者密码错误',700);
        }catch (\Throwable $exception){
            return $this->error($exception->getMessage(),$exception->getCode());
        }
    }

    /**
     * 获取用户信息
     * @param $user_id
     * @return array
     */
    public function getUserInfo($user_id){
        try{
            $userModel = AppUser::query()->find($user_id);
            if(empty($userModel)){
                throw new \ErrorException('用户不存在',404);
            }
            $this->checkUser($userModel);
            $data = [
                'username' => $userModel->username,
                'header_img' => $userModel->header_img,
                'telephone' => self::hideTelephone($userModel->telephone),
            ];
            return $this->success($data);
        }catch (\Throwable $exception){
            return $this->error($exception->getMessage(),$exception->getCode());
        }

    }

    /***
     * @param AppUser $user
     */
    private function checkUser(Appuser $user){
        if($user->status != AppUser::STATUS_YES){
            throw new AccountLockedException('账户已被冻结');
        }
    }
}