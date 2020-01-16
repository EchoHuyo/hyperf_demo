<?php


namespace App\Service\Admin;


use App\Exception\AccountLockedException;
use App\model\admin\user\User;
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
        $userModel = new User();
        $userModel->username = $signupInfo['username'];
        $userModel->setPassword($signupInfo['password']);
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

    public function login(array $loginInfo){
        try{
            $userModel = User::query()->where(['username' => $loginInfo['username']])->first();
            if(!empty($userModel)&&$userModel->validatePassword($loginInfo['password'])){
                /**
                 * @var User $userModel
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

    /***
     * @param User $user
     */
    private function checkUser(User $user){
        if($user->status != User::Status_Yes){
            throw new AccountLockedException('账户已被冻结');
        }
    }
}