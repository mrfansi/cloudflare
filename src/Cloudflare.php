<?php

namespace Mrfansi\Cloudflare;

class Cloudflare
{
  public static string $apiKey;

  public static string $apiAccount;

  public static string $apiEmail;

  public static string $apiBase = 'https://api.cloudflare.com/client/v4';

  private static HttpClientInterface $_httpClient;

  /**
   * ApiBase getter
   */
  public static function getApiBase(): string
  {
    return self::$apiBase;
  }

  /**
   * ApiBase setter
   *
   * @param string $apiBase api base url
   */
  public static function setApiBase(string $apiBase): void
  {
    self::$apiBase = $apiBase;
  }

  /**
   * Get the value of apiKey
   *
   * @return string Secret API key
   */
  public static function getApiKey(): string
  {
    if (empty(self::$apiKey)) {
      return config('cloudflare.key');
    }

    return self::$apiKey;
  }

  /**
   * Set the value of apiKey
   *
   * @param string $apiKey Secret API key
   */
  public static function setApiKey(string $apiKey): void
  {
    self::$apiKey = $apiKey;
  }

  /**
   * Get the value of apiAccount
   *
   * @return string API Account
   */
  public static function getApiAccount(): string
  {
    if (empty(self::$apiAccount)) {
      return config('cloudflare.account');
    }

    return self::$apiAccount;
  }

  /**
   * Set the value of apiKey
   *
   * @param string $apiAccount Secret API key
   */
  public static function setApiAccount(string $apiAccount): void
  {
    self::$apiAccount = $apiAccount;
  }

  /**
   * Get the value of apiAccount
   *
   * @return string API Email
   */
  public static function getApiEmail(): string
  {
    if (empty(self::$apiEmail)) {
      return config('cloudflare.email');
    }

    return self::$apiEmail;
  }

  /**
   * Set the value of apiKey
   *
   * @param string $apiEmail Secret API key
   */
  public static function setApiEmail(string $apiEmail): void
  {
    self::$apiEmail = $apiEmail;
  }

  /**
   * Set custom http client
   *
   * @param HttpCLientInterface $client custom http client
   */
  public static function setHttpClient(HttpClientInterface $client): void
  {
    self::$_httpClient = $client;
  }

  /**
   * Get current http client being used in the package
   */
  public static function getHttpClient(): HttpClientInterface
  {
    return self::$_httpClient;
  }
}
