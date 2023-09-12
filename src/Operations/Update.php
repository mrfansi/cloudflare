<?php

namespace Mrfansi\Cloudflare\Operations;

trait Update
{
    /**
     * Send an update request
     *
     * @param string $id     data ID
     * @param array  $params user's params
     *
     * @return array
     */
    public static function update(string $id, array $params = []): array
    {
        self::validateParams($params, static::updateReqParams());

        $url = static::classUrl() . '/' . $id;

        return static::_request('PATCH', $url, $params);
    }
}
