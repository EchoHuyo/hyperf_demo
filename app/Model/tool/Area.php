<?php

declare (strict_types=1);
namespace App\model\tool;

use Hyperf\DbConnection\Model\Model;
/**
 * @property int $id 
 * @property string $cname 
 * @property string $ename 
 * @property int $area 
 * @property int $sort 
 */
class Area extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'area';
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
    protected $casts = ['id' => 'integer', 'area' => 'integer', 'sort' => 'integer'];
}