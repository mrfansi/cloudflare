<?php

namespace Mrfansi\Cloudflare\Exceptions;

use Exception;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

/**
 * Class ApiException
 *
 * @category Exception
 * @package  Mrfansi\Cloudflare\Exceptions
 * @author   Muhammad Irfan <mrfansi@outlook.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://developers.cloudflare.com/api/
 */
class ApiException extends Exception implements ExceptionInterface
{
    protected string $errorCode;

    /**
     * Create new instance of ApiException
     *
     * @param string $message corresponds to message field in Cloudflare HTTP error
     * @param string $code corresponds to http status in Cloudflare HTTP response
     * @param string $errorCode corresponds to error_code field in Cloudflare HTTP
     *                          error
     * @throws ApiException
     */
    public function __construct(string $message, $code, $errorCode)
    {
        if (!$message) {
            throw new $this('Unknown ' . get_class($this));
        }
        parent::__construct($message, $code);
        $this->errorCode = $errorCode;
    }

    /**
     * Get error code for the exception instance
     *
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }
}
