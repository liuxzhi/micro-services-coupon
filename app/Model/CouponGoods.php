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
class CouponGoods extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coupon_goods';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'business_line_id', 'coupon_id', 'goods_id', 'deleted_at', 'created_at', 'updated_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'coupon_id' => 'integer', 'goods_id' => 'integer', 'deleted_at' => 'integer', 'created_at' => 'integer', 'updated_at' => 'integer'];

	protected $dateFormat = 'U';
}