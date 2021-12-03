<?php

declare(strict_types=1);

namespace App\Service;
use App\Constants\Coupon\CouponConstants;
use App\Contract\CouponServiceInterface;
use App\Helper\Log;
use App\Model\Coupon;
use App\Model\CouponGoods;
use App\Model\Model;

class CouponService extends AbstractService implements CouponServiceInterface
{

	/**
	 * 根据查询条件获取属性值
	 *
	 * @param array $conditions
	 * @param array $options
	 * @param array $columns
	 *
	 * @return array
	 */
	public function getCouponList(array $conditions = [], array $options = [], array $columns = ['*']): array
	{
		$model = $this->getModelObject();
		$data = $this->optionWhere($model, $conditions, $options)->select($columns)->get();
		$data || $data = collect([]);
		return $data->toArray();
	}



	/**
	 * 获取优惠券商品
	 *
	 * @param $couponId
	 *
	 * @return array
	 */
	public function getCouponGoodsList($couponId)
	{
		$data = CouponGoods::where(['coupon_id' => $couponId, "is_delete" => 0])->select(['id', 'app_id', 'coupon_id', 'goods_id'])->get();
		$data || $data = collect([]);

		return $data->toArray();
	}


	/**
	 * @return Coupon|Model|mixed
	 */

	public function getModelObject() :Model
	{
		return make(Coupon::class);
	}
}