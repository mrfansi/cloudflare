<?php

namespace Mrfansi\Cloudflare\Operations;

trait Create
{
    /**
     * Send a create request
     *
     * @param  array  $params user's params
     */
    public static function create(array $params = []): array
    {
        self::validateParams($params, static::createReqParams());

        $url = static::classUrl();

        return static::_request('POST', $url, $params);
    }
}
