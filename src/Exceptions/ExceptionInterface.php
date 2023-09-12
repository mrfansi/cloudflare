<?php

namespace Mrfansi\Cloudflare\Exceptions;

/**
 * Interface ExceptionInterface
 *
 * @category Interface
 *
 * @author   Muhammad irfan <mrfansi@outlook.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 *
 * @link     https://developers.cloudflare.com/api/
 */
interface ExceptionInterface extends \Throwable
{
    /**
     * Get error code for the exception instance
     */
    public function getErrorCode(): string;
}
