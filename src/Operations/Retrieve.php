<?php

namespace Mrfansi\Cloudflare\Operations;

trait Retrieve
{
    /**
     * Send GET request to retrieve data
     *
     * @param string $id ID
     * @param array $params
     * @return array
     */
    public static function retrieve(string $id, array $params = []): array
    {
        $url = static::classUrl() . '/' . $id;
        return static::_request('GET', $url, $params);
    }

}
