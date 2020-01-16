<?php

declare (strict_types=1);
namespace App\model\user;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property string $password 
 * @property string $username 
 * @property string $payment_password 
 * @property int $status 
 * @property string $header_img 
 * @property string $telephone 
 * @property int $area 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class AppUser extends Model
{
    const STATUS_YES = 1; // 正常用户
    const STATUS_NO = 0; // 黑名单

    /**
     * @var array
     */
    protected $guarded = ['password','payment_password','telephone'];
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'status' => 'integer', 'area' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    /**
     * 设置登陆密码
     * @param $password
     */
    public function setPassword($password){
        $this->password = static::getHashPassword($password);
    }

    /**
     * 获取password的hash值
     * @param $password
     * @return false|string
     */
    private static function getHashPassword($password){
        return password_hash($password,PASSWORD_DEFAULT);
    }

    /**
     * 验证密码
     * @param $password /输入的密码
     * @param $hash /用户的hash
     * @return bool
     * @throws \ErrorException
     */
    private static function validateHashPassword($password,$hash){
        if(empty($password)){
            throw new \ErrorException('密码不能为空',700);
        }
        if (!preg_match('/^\$2[axy]\$(\d\d)\$[\.\/0-9A-Za-z]{22}/', $hash, $matches)
            || $matches[1] < 4
            || $matches[1] > 30
        ) {
            throw new \ErrorException('Hash is invalid.',900);
        }
        if (function_exists('password_verify')) {
            return password_verify($password, $hash);
        }else{
            throw new \ErrorException('函数不存在',570);
        }
    }

    /**
     * 设置支付密码
     * @param $password
     */
    public function setPaymentPassword($password){
        $this->payment_password = static::getHashPassword($password);
    }

    /**
     * 验证登陆密码
     * @param $password
     * @return bool
     * @throws \ErrorException
     */
    public function validatePassword($password){
        if(empty($this->password)){
            throw new \ErrorException('未设置密码',800);
        }
        if(empty($password)){
            throw new \ErrorException('密码不能为空',1000);
        }
        return self::validateHashPassword($password,$this->password);
    }

    /**
     * 验证支付密码
     * @param $password
     * @return bool
     * @throws \ErrorException
     */
    public function validatePaymentPassword($password){
        if(empty($this->payment_password)){
            throw new \ErrorException('未设置支付密码',810);
        }
        if(empty($password)){
            throw new \ErrorException('密码不能为空',1000);
        }
        return self::validateHashPassword($password,$this->payment_password);
    }
}