<?php

declare(strict_types=1);

namespace App\Service;
use App\Contract\CouponServiceInterface;
use App\Model\Model;

class CouponService extends AbstractService implements CouponServiceInterface
{
	public function getModelObject(): Model
	{
		// TODO: Implement getModelObject() method.
	}
}