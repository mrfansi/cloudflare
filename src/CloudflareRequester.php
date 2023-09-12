<?php

namespace Mrfansi\Cloudflare;

class CloudflareRequester
{
  private static HttpClient\GuzzleClient $_httpClient;

  /**
   * Send request and processing response
   *
   * @param string $method  request method (get, post, patch, etc)
   * @param string $url     base url
   * @param array $params  user's params
   * @param array $headers user's additional headers
   *
   * @return array
   * @throws Exceptions\ApiException
   */
  public function request(string $method, string $url, array $params = [], array $headers = []): array
  {
    list($responseBody, $responseCode, $responseHeaders)
      = $this->_requestRaw($method, $url, $params, $headers);

    return json_decode($responseBody, true);
  }

  /**
   * Set must-have headers
   *
   * @param array $headers user's headers
   *
   * @return array
   */
  private function _setDefaultHeaders(array $headers): array
  {
    $defaultHeaders = [];
    $xApiKey = Cloudflare::getApiKey();
    $xApiEmail = Cloudflare::getApiEmail();

    $defaultHeaders['Content-Type'] = 'application/json';
    $defaultHeaders['X-Auth-Key'] = $xApiKey;
    $defaultHeaders['X-Auth-Email'] = $xApiEmail;

    return array_merge($defaultHeaders, $headers);
  }

  /**
   * Send request from client
   *
   * @param string $method  request method
   * @param string $url     additional url to base url
   * @param array  $params  user's params
   * @param array  $headers request' headers
   *
   * @return array
   * @throws Exceptions\ApiException
   */
  private function _requestRaw(string $method, string $url, array $params, array $headers): array
  {
    $defaultHeaders = self::_setDefaultHeaders($headers);

    $response = $this->_httpClient()->sendRequest(
      $method,
      $url,
      $defaultHeaders,
      $params
    );

    $responseBody = $response[0];
    $responseCode = $response[1];
    $responseHeaders = $response[2];

    return [$responseBody, $responseCode, $responseHeaders];
  }

  /**
   * Create HTTP Client
   *
   * @return HttpClient\GuzzleClient
   */
  private function _httpClient(): HttpClient\GuzzleClient
  {
    if (!self::$_httpClient) {
      self::$_httpClient = HttpClient\GuzzleClient::instance();
    }
    return self::$_httpClient;
  }

  /**
   * GuzzleClient Setter
   *
   * @param HttpClient\GuzzleClient $client client
   *
   * @return void
   */
  public static function setHttpClient(HttpClient\GuzzleClient $client): void
  {
    self::$_httpClient = $client;
  }
}
