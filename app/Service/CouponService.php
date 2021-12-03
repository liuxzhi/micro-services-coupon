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
	 * 优惠券自动启用
	 * @return array
	 */
	public function enableCoupon(): array
	{
		$executeInterval = (int)env('COUPON_EXECUTE_INTERVAL');
		$conditions = [
			'state' => CouponConstants::STATE_DISABLE,
			'automatic_state_on' => CouponConstants::AUTOMATIC_STATE_NO,
			['receive_start_time', "<=", time()],
			['receive_start_time', ">=", (time() - $executeInterval)]
		];

		$couponList = $this->getCouponList($conditions);
		Log::info("enable_coupon_list", $couponList);

		$result = [];
		if (!$couponList) {
			return $result;
		}

		// 乐观锁保证更新
		foreach ($couponList as $coupon) {
			$result[$coupon['id']]['result'] = $this->getModelObject()->where($coupon)->update([
				                                                                                   'state' => CouponConstants::STATE_ENABLE,
				                                                                                   'automatic_state_on' => CouponConstants::AUTOMATIC_STATE_YES
			                                                                                   ]);
		}
		return $result;
	}

	/**
	 * 过期优惠券自动禁用
	 *
	 * @return array
	 */
	public function disableCoupon(): array
	{

		$conditions = [
			'state' => CouponConstants::STATE_ENABLE,
			'automatic_state_off' => CouponConstants::AUTOMATIC_STATE_NO,
			['use_end_time', '<=', time()]
		];

		$couponList = $this->getCouponList($conditions);
		Log::info("disable_coupon_list", $couponList);

		$result = [];
		if (!$couponList) {
			return $result;
		}

		// 乐观锁保证更新
		foreach ($couponList as $coupon) {
			$result[$coupon['id']]['result'] = $this->getModelObject()->where($coupon)->update([
				                                                                                   'state' => CouponConstants::STATE_DISABLE,
				                                                                                   'automatic_state_off' => CouponConstants::AUTOMATIC_STATE_YES
			                                                                                   ]);
		}

		return $result;
	}


	/**
	 * @return Coupon|Model|mixed
	 */

	public function getModelObject() :Model
	{
		return make(Coupon::class);
	}
}