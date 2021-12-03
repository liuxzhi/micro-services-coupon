<?php

declare(strict_types=1);

namespace App\Traits\Trace;

use Hyperf\Utils\Context;

/**
 * 设置trace_id
 * Trait Trace
 * @package App\Traits\Trace
 */
trait Trace
{
	/**
	 * 设置traceId.
	 *
	 * @param mixed $traceId
	 * @param mixed $coverContext
	 */

	protected function putTraceId($traceId = false, $coverContext = true) :void
	{
		if ($coverContext || ! Context::get('trace_id')) {
			$traceId || $traceId = $this->getTraceId();
			Context::set('trace_id', $traceId);
		}
	}

	protected function clearTraceId() :void
	{
		Context::destroy('trace_id');
	}

	/**
	 * 获取TraceId.
	 *
	 * @return string
	 */
	private function getTraceId() :string
	{
		return sha1(uniqid(
			            '',
			            true
		            ) . str_shuffle(str_repeat(
			                            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
			                            16
		                            )));
	}
}