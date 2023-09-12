<?php

namespace Mrfansi\Cloudflare\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mrfansi\Cloudflare\Cloudflare
 */
class Cloudflare extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mrfansi\Cloudflare\Cloudflare::class;
    }
}
