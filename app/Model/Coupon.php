<?php

declare (strict_types=1);
namespace App\Model;

/**
 * @property int $id 
 * @property string $business_line_id 
 * @property string $name 
 * @property string $instructions 
 * @property int $type 
 * @property int $state 
 * @property int $receive_start 
 * @property int $receive_end 
 * @property int $use_start 
 * @property int $use_end 
 * @property int $released_quantity 
 * @property int $received_quantity 
 * @property int $used_quantity 
 * @property int $denomination 
 * @property int $scope 
 * @property string $scope_goods_ids 
 * @property string $scope_limit_goods_ids 
 * @property int $limit_quantity 
 * @property int $limit_amount 
 * @property int $limit_crowd 
 * @property int $automatic_state_on 
 * @property int $automatic_state_off 
 * @property int $deleted_at 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $created_at 
 */
class Coupon extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coupon';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'business_line_id', 'name', 'instructions', 'type', 'state', 'receive_start', 'receive_end', 'use_start', 'use_end', 'released_quantity', 'received_quantity', 'used_quantity', 'denomination', 'scope', 'scope_goods_ids', 'scope_limit_goods_ids', 'limit_quantity', 'limit_amount', 'limit_crowd', 'automatic_state_on', 'automatic_state_off', 'deleted_at', 'updated_at', 'created_at'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['id' => 'integer', 'type' => 'integer', 'state' => 'integer', 'receive_start' => 'integer', 'receive_end' => 'integer', 'use_start' => 'integer', 'use_end' => 'integer', 'released_quantity' => 'integer', 'received_quantity' => 'integer', 'used_quantity' => 'integer', 'denomination' => 'integer', 'scope' => 'integer', 'limit_quantity' => 'integer', 'limit_amount' => 'integer', 'limit_crowd' => 'integer', 'automatic_state_on' => 'integer', 'automatic_state_off' => 'integer', 'deleted_at' => 'integer', 'updated_at' => 'integer', 'created_at' => 'integer'];

	protected $dateFormat = 'U';
}