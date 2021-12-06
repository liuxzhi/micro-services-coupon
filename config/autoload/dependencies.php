<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

$dependencies =  [
	App\Contract\Rpc\MerchandiseServiceInterface::class => App\RpcService\MerchandiseService::class,
];

$serviceDependencies = serviceMap();
return array_merge($serviceDependencies, $dependencies);
