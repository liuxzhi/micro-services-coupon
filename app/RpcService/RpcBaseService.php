<?php
declare(strict_types=1);

namespace App\RpcService;

use Hyperf\Di\Annotation\Inject;

use App\Contract\Rpc\RpcBaseServiceInterface;
use App\Helper\ApiCurl;

class RpcBaseService implements RpcBaseServiceInterface
{

	/**
	 * @Inject
	 *
	 * @var ApiCurl
	 */
	protected ApiCurl $curl;

    /**
     * @param string $method
     * @param string $url
     * @param array $params
     * @param string $res
     * @return array
     */
	public function request(string $method, string $url,  array $params = [],  string $res = 'json') :array
	{
		return $this->curl->request($method, $url, $params, $res);

	}
}
