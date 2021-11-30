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
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST'], '/', 'App\Controller\IndexController@index');
Router::addRoute(['GET', 'POST'], '/coupon/create', 'App\Controller\CouponController@create');
Router::addRoute(['GET', 'POST'], '/coupon/get', 'App\Controller\CouponController@get');
