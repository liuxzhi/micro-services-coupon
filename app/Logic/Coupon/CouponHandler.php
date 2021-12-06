<?php

declare(strict_types=1);

namespace App\Logic\Coupon;

use Hyperf\Di\Annotation\Inject;

use App\Contract\CouponServiceInterface;
use App\Contract\CouponMerchandiseServiceInterface;
use App\Contract\Rpc\MerchandiseServiceInterface;
use App\Exception\BusinessException;
use App\Constants\BusinessErrorCode;
use App\Constants\Coupon\CouponConstants;
use Hyperf\DbConnection\Db;
use App\Helper\Log;
use throwable;

class CouponHandler
{
	/**
	 * @Inject
	 * @var CouponServiceInterface
	 */
	protected $CouponService;

	/**
	 * @Inject
	 * @var CouponMerchandiseServiceInterface
	 */
	protected $CouponMerchandiseService;

	/**
	 * @Inject
	 * @var MerchandiseServiceInterface
	 */
	protected $MerchandiseService;


	/**
	 * 创建优惠券
	 *
	 * @param $params
	 *
	 * @return int[]
	 * @throws throwable
	 */
	public function create($params)
	{
		// 从商品中心获取渠道商品(RPC调用)
		$conditions=[];
		$result = $this->MerchandiseService->merchandiseList($conditions);
		if($result['code'] != 0 || empty($result['body']['list'])) {
			throw new BusinessException(CouponConstants::COUPON_MERCHANDISE_ERROR);
		}
		$businessMerchandiseList = $this->formatBusinessMerchandiseList($result);

		try {

			Db::beginTransaction();
			// 创建优惠券商品对应关系
			if ($params['scope'] == CouponConstants::COUPON_SCOPE_ALL) {
				$params['scope_merchandise_ids'] = $businessMerchandiseList;
				$params['scope_limit_goods_ids'] = [];

			} elseif ($params['scope'] == CouponConstants::COUPON_SCOPE_PART && $params['scope_merchandise_ids']) {

				$scopeMerchandiseIds = $params['scope_merchandise_ids'];
				$scopeLimitGoodsIds = array_filter($businessMerchandiseList, function ($v) use ($scopeMerchandiseIds) {
					return !in_array($v, $scopeMerchandiseIds);
				});

				$params['scope_limit_merchandise_ids'] = array_values($scopeLimitGoodsIds);

			} elseif ($params['scope'] == CouponConstants::COUPON_SCOPE_PART_UNAVAILABLE && $params['scope_limit_merchandise_ids']) {

				$scopeLimitMerchandiseIds = $params['scope_limit_merchandise_ids'];
				$scopeMerchandiseIds = array_filter($businessMerchandiseList, function ($v) use ($scopeLimitMerchandiseIds) {
					return !in_array($v, $scopeLimitMerchandiseIds);
				});

				$params['scope_merchandise_ids'] =  array_values($scopeMerchandiseIds);

			} else {
				throw new BusinessException(BusinessErrorCode::COUPON_SCOPE_ERROR);
			}

			// 创建优惠券
			$coupon = $this->CouponService->create($params);
			$couponId = (int)$coupon['id'];

			// 创建优惠券商品关联关系
			$this->CouponMerchandiseService->createCouponMerchandise($couponId, $params);

			Db::commit();

		} catch (throwable $throwable) {
			Log::error("create_coupon_throwable_error", ['params' => $params, "message" => $throwable->getMessage()]);
			Db::rollBack();
			throw $throwable;
		}

		return ['coupon_id' => $couponId];
	}


	/**
	 * 格式化商品渠道信心
	 * @param $result
	 *
	 * @return array
	 */
	protected function formatBusinessMerchandiseList($result) :array
	{

		$businessMerchandiseList = [];
		foreach ($result['body']['list'] as $businessMerchandise) {
			$businessMerchandiseList[] = ['merchandise_id' => $businessMerchandise['merchandise_id'], 'app_id' => 1 ];
		}
		return $businessMerchandiseList;
	}
}