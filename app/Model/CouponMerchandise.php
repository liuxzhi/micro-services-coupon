<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $id 
 * @property string $business_line_id 
 * @property int $coupon_id 
 * @property int $goods_id 
 * @property int $deleted_at 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 */
class CouponMerchandise extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coupon_merchandise';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'business_id', 'coupon_id', 'merchandise_id', 'deleted_at', 'created_at', 'updated_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'coupon_id' => 'integer', 'merchandise_id' => 'integer', 'deleted_at' => 'integer', 'created_at' => 'integer', 'updated_at' => 'integer'];

	protected $dateFormat = 'U';
}