<?php

namespace Mrfansi\Cloudflare\Operations;

trait RetrieveAll
{
    /**
     * Send request to get all object, e.g Invoice
     */
    public static function retrieveAll(array $params = []): array
    {
        $url = static::classUrl();

        return static::_request('GET', $url, $params);
    }
}
