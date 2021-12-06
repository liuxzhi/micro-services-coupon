<?php

declare(strict_types=1);

namespace App\Service;
use App\Contract\CouponMerchandiseServiceInterface;
use App\Model\CouponMerchandise;
use App\Model\Model;

class CouponMerchandiseService extends AbstractService implements CouponMerchandiseServiceInterface
{

	/**
	 * @return Model|mixed
	 */
	public function getModelObject() :Model
	{
		return make(CouponMerchandise::class);
	}


	/**
	 * 删除优惠券和商品的绑定关系
	 * @param $couponId
	 *
	 * @return mixed
	 */
	public function deleteCouponMerchandise($couponId)
	{
		return CouponMerchandise::where("coupon_id", "=", $couponId)->delete();
	}

	/**
	 * 创建商品和优惠券的绑定关系
	 *
	 * @param $couponId
	 * @param $params
	 *
	 * @return mixed
	 */
	public function createCouponMerchandise($couponId, $params)
	{
		$couponGoodsList = $params['scope_goods_ids'];
		foreach ($couponGoodsList as &$couponGoods) {
			$couponGoods['coupon_id'] = $couponId;
			$couponGoods['created_at'] = time();
			$couponGoods['updated_at'] = time();
		}

		return CouponMerchandise::insert($couponGoodsList);
	}


	/**
	 * 获取优惠券商品列表
	 * @param array $conditions
	 * @param array $options
	 * @param array $columns
	 * @return array
	 */
	public function getCouponMerchandiseList(array $conditions=[], array $options=[], array $columns = ['*']) :array
	{
		$model = $this->getModelObject();
		$data = $this->optionWhere($model, $conditions, $options)->select($columns)->get();
		$data || $data = collect([]);
		return $data->toArray();
	}
}