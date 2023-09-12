<?php

namespace Mrfansi\Cloudflare\Operations;

trait RetrievePagination
{
  private static ?array $data = [];

  /**
   * Send request to get all object, e.g Invoice
   *
   * @param array $params
   * @return array
   */
  public static function retrievePagination(array $params = []): array
  {
    $url = static::classUrl();
    $response = static::_request('GET', $url, $params);
    if (!empty($response['result_info']['cursors']['after']) && !empty($response['result'])) {
      static::setData($response['result']);
      return static::retrievePagination([
        ...$params,
        "cursor" => $response['result_info']['cursors']['after']
      ]);
    }

    return static::getData();
  }

  private static function setData(array $data): void
  {
    static::$data = array_merge(self::$data, $data);
  }

  private static function getData(): ?array
  {
    return static::$data;
  }
}
