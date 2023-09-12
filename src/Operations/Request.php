<?php

namespace Mrfansi\Cloudflare\Operations;

use Mrfansi\Cloudflare\CloudflareRequester;
use Mrfansi\Cloudflare\Exceptions\ApiException;
use Mrfansi\Cloudflare\Exceptions\InvalidArgumentException;

trait Request
{
    /**
     * Parameters validation
     *
     * @param  array  $params user's parameters
     * @param  array  $requiredParams required parameters
     */
    protected static function validateParams(array $params = [], array $requiredParams = [], string $message = ''): void
    {
        $currParams = array_diff_key(array_flip($requiredParams), $params);
        if ($params && ! is_array($params)) {
            $message = 'You must pass an array as params.';
            throw new InvalidArgumentException($message);
        }
        if (count($currParams) > 0) {
            if (empty($message)) {
                $message = 'You must pass required parameters on your params. '
                  .'Check https://developers.cloudflare.com/api/ for more information.';
            }
            throw new InvalidArgumentException($message);
        }
    }

    /**
     * Send request to Api Requester
     *
     * @param $method string
     * @param $url    string ext url to the API
     * @param $params array parameters
     *
     * @throws ApiException
     */
    protected static function _request(
        string $method,
        string $url,
        array $params = []
    ): array {
        $headers = [];

        return (new CloudflareRequester())->request($method, $url, $params, $headers);
    }
}
