<?php

namespace Mrfansi\Cloudflare\HttpClient;

use Mrfansi\Cloudflare\Exceptions\ApiException;

interface ClientInterface
{
  /**
   * Create a request to execute in _executeRequest
   *
   * @param string $method request method
   * @param string $url url
   * @param array $defaultHeaders request headers
   * @param array $params parameters
   *
   * @return array
   * @throws ApiException
   */
  public function sendRequest(string $method,
                              string $url,
                              array  $defaultHeaders,
                              array  $params
  ): array;
}
