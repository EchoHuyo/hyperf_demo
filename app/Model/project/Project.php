<?php

declare (strict_types=1);
namespace App\model\project;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property string $symbol 
 * @property string $describe 
 * @property string $symbol_code 
 * @property string $symbol_icon 
 * @property string $contact 
 * @property string $contact_phone 
 * @property string $project_home 
 * @property string $white_paper 
 * @property string $ratio 
 * @property string $circulation_out 
 * @property string $circulation_private 
 * @property float $symbol_price 
 * @property string $online_exchange 
 * @property int $status 
 * @property int $user_id 
 * @property string $admin_status 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Project extends Model
{
    /**
     * @Message('已提交')
     */
    const Status_Submit = 10;

    /**
     * @Message('已受理')
     */
    const Status_Processing = 20;

    /**
     * @Message('已结束')
     */
    const Status_End = 30;

    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_project';
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
    protected $casts = ['id' => 'integer', 'symbol_price' => 'float', 'status' => 'integer', 'user_id' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}