<?php

declare(strict_types=1);

namespace App\Service;
use App\Contract\CouponGoodsServiceInterface;
use App\Model\CouponGoods;
use App\Model\Model;

class CouponGoodsService extends AbstractService implements CouponGoodsServiceInterface
{

	/**
	 * @return Model|mixed
	 */
	public function getModelObject() :Model
	{
		return make(CouponGoods::class);
	}


	/**
	 * 删除优惠券和商品的绑定关系
	 * @param $couponId
	 *
	 * @return mixed
	 */
	public function deleteCouponGoods($couponId)
	{
		return CouponGoods::where("coupon_id", "=", $couponId)->delete();
	}

	/**
	 * 创建商品和优惠券的绑定关系
	 *
	 * @param $couponId
	 * @param $params
	 *
	 * @return mixed
	 */
	public function createCouponGoods($couponId, $params)
	{
		$couponGoodsList = $params['scope_goods_ids'];
		foreach ($couponGoodsList as &$couponGoods) {
			$couponGoods['coupon_id'] = $couponId;
			$couponGoods['created_at'] = time();
			$couponGoods['updated_at'] = time();
		}

		return CouponGoods::insert($couponGoodsList);
	}


	/**
	 * 获取优惠券商品列表
	 * @param array $conditions
	 * @param array $options
	 * @param array $columns
	 * @return array
	 */
	public function getCouponGoodsList(array $conditions=[], array $options=[], array $columns = ['*']) :array
	{
		$model = $this->getModelObject();
		$data = $this->optionWhere($model, $conditions, $options)->select($columns)->get();
		$data || $data = collect([]);
		return $data->toArray();
	}
}