<?php

namespace Mrfansi\Cloudflare\HttpClient;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Mrfansi\Cloudflare\Cloudflare;
use Mrfansi\Cloudflare\Exceptions\ApiException;
use Mrfansi\Cloudflare\HttpClientInterface;

class GuzzleClient implements ClientInterface
{
    private static GuzzleClient $_instance;

    protected Guzzle|HttpClientInterface $http;

    /**
     * XenditClient constructor
     */
    public function __construct()
    {
        if (Cloudflare::getHttpClient()) {
            $this->http = Cloudflare::getHttpClient();
        } else {
            $baseUri = Cloudflare::$apiBase;
            $this->http = new Guzzle(
                [
                    'base_uri' => $baseUri,
                    'verify' => false,
                    'timeout' => 60,
                ]
            );
        }
    }

    /**
     * Create Client instance
     */
    public static function instance(): GuzzleClient
    {
        if (! self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Create a request to execute in _executeRequest
     *
     * @param  string  $method request method
     * @param  string  $url url
     * @param  array  $defaultHeaders request headers
     * @param  array  $params parameters
     *
     * @throws ApiException
     * @throws GuzzleException
     */
    public function sendRequest(string $method, string $url, array $defaultHeaders, array $params): array
    {
        $method = strtoupper($method);

        $opts = [];

        $opts['method'] = $method;
        $opts['headers'] = $defaultHeaders;
        $opts['params'] = $params;

        $response = $this->_executeRequest($opts, $url);

        $responseBody = $response[0];
        $responseCode = $response[1];
        $responseHeader = $response[2];

        return [$responseBody, $responseCode, $responseHeader];
    }

    /**
     * Execute request
     *
     * @param  array  $opts request options (headers, params)
     * @param  string  $url request url
     *
     * @throws ApiException|GuzzleException
     */
    private function _executeRequest(array $opts, string $url): array
    {
        $headers = $opts['headers'];
        $params = $opts['params'];
        $apiKey = Cloudflare::$apiKey;
        try {
            if (count($params) > 0) {
                $isQueryParam = isset($params['query-param']) && $params['query-param'] === 'true'; // additional condition to check if the requester is imposing query param, otherwise default json

                if ($isQueryParam) {
                    unset($params['query-param']);
                }

                $response = $this->http->request(
                    $opts['method'], $url, [
                        'auth' => [$apiKey, ''],
                        'headers' => $headers,
                        $isQueryParam ? RequestOptions::QUERY : RequestOptions::JSON => $params,
                    ]
                );
            } else {
                $response = $this->http->request(
                    $opts['method'], $url, [
                        'auth' => [$apiKey, ''],
                        'headers' => $headers,
                    ]
                );
            }
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $responseBody = json_decode($response->getBody()->getContents(), true);
            $responseCode = $response->getStatusCode();
            $responseHeader = $response->getHeaders();

            self::_handleAPIError(
                ['body' => $responseBody,
                    'code' => $responseCode,
                    'header' => $responseHeader]
            );
        }

        $responseBody = $response->getBody();
        $responseCode = (int) $response->getStatusCode();
        $responseHeader = $response->getHeaders();

        return [$responseBody, $responseCode, $responseHeader];
    }

    /**
     * Handles API Error
     *
     * @param  array  $response response from GuzzleClient
     *
     * @throws ApiException
     */
    private static function _handleAPIError(array $response): void
    {
        $responseBody = $response['body'];

        $responseCode = strval($response['code']);
        $message = $responseBody['message'];
        $errorCode = $responseBody['error_code'];

        throw new ApiException($message, $responseCode, $errorCode);
    }
}
