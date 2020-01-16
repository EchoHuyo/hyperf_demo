<?php

declare (strict_types=1);
namespace App\model\tool;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property string $telephone 
 * @property string $code 
 * @property string $type 
 * @property int $count 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Sms extends Model
{

    /**
     * 注册
     */
    const type_signup = 10;
    /**
     * 忘记密码
     */
    const type_forget = 20;
    /**
     * 忘记支付密码
     */
    const type_forget_payment = 30;

    const CREATED_AT = 'created_at';
    const UPDATED_AT =  null;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_sms';
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
    protected $casts = ['id' => 'integer', 'count' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];

    public function fromDateTime($value){
        return time();
    }
}