<?php

declare(strict_types=1);

namespace App\Constants\Coupon;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 * @method static getMessage($code, array $options = [])
 */
class CouponConstants extends AbstractConstants
{
	/**
	 * @Message("满减券")
	 */
	const TYPE_FULL_CUT = 1;


	/**
	 * @Message("未开始")
	 */
	const USE_STATE_PENDING = 1;

	/**
	 * @Message("进行中")
	 */
	const USE_STATE_IN_PROCESS = 2;

	/**
	 * @Message("已完成")
	 */
	const USE_STATE_COMPLETED = 3;


	/**
	 * @Message("停用")
	 */
	const STATE_DISABLE = 0;

	/**
	 * @Message("启用")
	 */
	const STATE_ENABLE = 1;

	/**
	 * @var array;
	 */
	const TYPE_ENUM = [
		self::TYPE_FULL_CUT => "满减券",
	];


	/**
	 * @var array;
	 */
	const STATE_ENUM = [
		self::USE_STATE_PENDING => "未开始",
		self::USE_STATE_IN_PROCESS => "进行中",
		self::USE_STATE_COMPLETED => "已完成",
	];

	/**
	 * @Message("未自动启用")
	 */
	const AUTOMATIC_STATE_NO = 0;

	/**
	 * @Message("已自动启用")
	 */
	const AUTOMATIC_STATE_YES = 1;

	/**
	 * @Message("全部商品")
	 */
	const COUPON_SCOPE_ALL = 1;

	/**
	 * @Message("部分可用")
	 */
	const COUPON_SCOPE_PART = 2;


	/**
	 * @Message("部分不可用")
	 */
	const COUPON_SCOPE_PART_UNAVAILABLE = 3;

}
