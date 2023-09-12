<?php

namespace Mrfansi\Cloudflare\Endpoints\Rules;

use Mrfansi\Cloudflare\Exceptions\ApiException;
use Mrfansi\Cloudflare\Operations\Create;
use Mrfansi\Cloudflare\Operations\Request;
use Mrfansi\Cloudflare\Operations\RetrieveAll;

class Lists
{
  use Create;
  use Request;
  use RetrieveAll;

  /**
   * Instantiate base URL
   *
   * @return string
   */
  public static function classUrl(): string
  {
    return "/accounts/" . config('cloudflare.account') . '/rules/lists';
  }

  /**
   * Instantiate required params for Create
   *
   * @return array
   */
  public static function createReqParams(): array
  {
    return ['kind', 'name'];
  }

  /**
   * Get list items by list_id
   *
   * @param string $list_id list ID
   *
   * @return array please check for responses parameters here
   * https://developers.cloudflare.com/api/operations/lists-get-list-items
   * @throws ApiException
   */
  public static function listItems(string $list_id, $params = []): array
  {
    $url = static::classUrl()
      . "/" . $list_id . '/items';

    return static::_request('GET', $url, $params);
  }


}
