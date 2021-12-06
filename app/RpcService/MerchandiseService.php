<?php
declare(strict_types=1);

namespace App\RpcService;

use Hyperf\Di\Annotation\Inject;
use Hyperf\Config\Annotation\Value;
use App\Contract\Rpc\MerchandiseServiceInterface;

class MerchandiseService extends RpcBaseService implements MerchandiseServiceInterface
{


    /**
     * @Value("rpc_services.merchandise_service_api_host")
     */
    protected string $apiHost;

    /**
     * @Value("rpc_services.merchandise_list_uri")
     */
    protected string $uri;

	/**
	 * 获取商品列表
	 * @param array $conditions
	 * @param array $options
	 * @param array $columns
	 *
	 * @return array
	 */
    public function merchandiseList(array $conditions=[], array $options=[], array $columns = ['*']): array
    {
        return $this->request("POST" ,$this->apiHost.'/'.$this->uri, [ 'conditions' => $conditions,  'options' => $options, 'columns' => $columns]);
    }


}