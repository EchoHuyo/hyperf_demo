<?php

declare (strict_types=1);
namespace App\model\rotation;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property string $url 
 * @property string $lang 
 * @property int $status 
 * @property int $sort 
 * @property string $type 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class Rotation extends Model
{

    const Status_Yes = 1;

    const Status_No = 2;

    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rotation';
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
    protected $casts = ['id' => 'integer', 'status' => 'integer', 'sort' => 'integer', 'created_at' => 'datetime', 'updated_at' => 'datetime'];
}