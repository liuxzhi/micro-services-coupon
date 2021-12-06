<?php
declare(strict_types=1);

namespace App\Contract\Rpc;

interface MerchandiseServiceInterface extends RpcBaseServiceInterface
{
	/**
	 * 获取商品列表
	 * @param array $conditions
	 * @param array $options
	 * @param array $columns
	 *
	 * @return array
	 */
	public function merchandiseList(array $conditions=[], array $options=[], array $columns = ['*']): array;
}