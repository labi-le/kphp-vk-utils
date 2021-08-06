<?php

declare(strict_types=1);

namespace Astaroth\VkUtils;


use Astaroth\VkUtils\Contracts\IClient;
use Astaroth\VkUtils\Exceptions\VkException;
use Astaroth\VkUtils\Tricks\RequestTricks;
use Throwable;

/**
 * Class Client
 * @package Astaroth
 */
class Client implements IClient
{
    private const API = "https://api.vk.com/method/";
    private string $access_token;
    private string $version;


    /**
     * @var bool
     */
    protected bool $skipError = false;

    public function __construct(string $version = "5.131")
    {
        $this->version = $version;
    }

    /**
     * @param string $token
     * @return static
     */
    public function setDefaultToken(string $token): Client
    {
        $this->access_token = $token;

        return $this;
    }

    /**
     * @param bool $bool
     * @return static
     */
    public function setSkipError(bool $bool = true)
    {
        $this->skipError = $bool;
        return $this;
    }


    /**
     * @param string $method
     * @param array $parameters
     * @param string|null $token
     * @return array
     * @throws Throwable
     */
    public function request(string $method, array $parameters = [], ?string $token = null): array
    {
        return $this->base_request(self::API . $method, $parameters, $token);
    }

    /**
     * @param string $url
     * @param array $parameters
     * @param string|null $token
     * @return array
     * @throws Throwable
     */
    protected function base_request(string $url, array $parameters = [], ?string $token = null): array
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($this->buildOptions($parameters, $token))
        ]);

        $data = curl_exec($ch);
        curl_close($ch);

        return $this->getResponseData((string)$data);
    }

    /**
     * @param string $response
     * @return array
     * @throws Throwable
     */
    protected function getResponseData(string $response): array
    {
        $data = (array)@json_decode($response, true);

        if ($this->skipError === false) {
            $this->checkErrors($data);
        }

        if (isset($data["response"])) {
            $data = (array)$data["response"];
        }
        return $data;
    }

    /**
     * @param mixed $data
     * @throws Throwable
     */
    protected function checkErrors($data): void
    {
        if ($data === false) {
            throw new VkException('Invalid VK response format');
        }

        if (isset($data['error'])) {
            @count($data['error'])
                ?: $data['error'] = ['error_msg' => $data['error'], 'error_code' => 0];

            $this->createException((array)$data['error']);
        }

        if (isset($data['execute_errors'][0])) {
            $this->createException((array)$data['execute_errors'][0]);
        }
    }

    /**
     * @throws VkException
     * @throws \Exception
     */
    protected function createException(array $error): void
    {
        $message = $error['error_msg'] ?? $error['error'] ?? '';
        $code = $error['error_code'] ?? 0;

        (new ExceptionGenerator((int)$code, (string)$message))->throw();
    }

    /**
     * @param array $parameters
     * @param string|null $requestToken
     * @return array
     */
    protected function buildOptions(array $parameters, ?string $requestToken = null): array
    {
        $parameters['v'] = $this->version;
        $token = $requestToken ?: $this->access_token;

        if ($token) {
            $parameters['access_token'] = $token;
        }

        return $parameters;
    }

    /**
     * Upload file to server
     * In progress...
     * @param string $url
     * @param string $path
     * @param string $type
     * @return array
     * @throws Throwable
     */
    protected function uploadFile(string $url, string $path, string $type): array
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        RequestTricks::curl_custom_postfields($curl, [$type => $path]);

        $response = (string)curl_exec($curl);
        curl_close($curl);

        return $this->getResponseData($response);
    }
}