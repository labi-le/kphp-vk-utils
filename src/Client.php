<?php

namespace Astaroth\VkUtils;

use Astaroth\VkUtils\Contracts\IClient as ClientContract;
use Astaroth\VkUtils\Contracts\IRequest;
use Astaroth\VkUtils\Exceptions\VkException;
use Exception;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use function Amp\ParallelFunctions\parallelMap;
use function Amp\Promise\wait;

/**
 * Class Client
 * @package Astaroth\VkUtils
 */
class Client implements ClientContract
{
    public const API_URI = 'https://api.vk.com/method/';
    public const API_VERSION = '5.130';
    public const API_TIMEOUT = 15.0;

    public const RUNTIME_EXCEPTION = 20;

    /**
     * @var HttpClient
     */
    protected HttpClient $http;

    /**
     * @var string
     */
    protected string $version;

    /**
     * @var string
     */
    protected string $token;

    /**
     * @var string
     */
    protected string $uri;

    /**
     * @var bool
     */
    protected bool $passError = false;

    /**
     * Client constructor.
     *
     * @param int|string|null $version
     * @param HttpClient|null $http
     */
    public function __construct(int|string $version = null, ClientInterface $http = null)
    {
        $this->version = $version ?: static::API_VERSION;
        $this->http = $this->resolveHttpClient($http);
    }

    /**
     * @param ClientInterface|null $http
     */
    private function resolveHttpClient(ClientInterface $http = null): ClientInterface
    {
        return $http ?: new HttpClient([
            'base_uri' => static::API_URI,
            'timeout' => static::API_TIMEOUT,
            'http_errors' => false,
            'headers' => [
                'User-Agent' => 'Astaroth',
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * @param string $token
     * @return static
     */
    public function setDefaultToken(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @param bool $bool
     * @return static
     */
    public function setPassError(bool $bool = true): static
    {
        $this->passError = $bool;

        return $this;
    }

    /**
     * @param IRequest $request
     * @return array
     * @throws Throwable
     */
    public function send(IRequest $request): array
    {
        return $this->request(
            $request->getMethod(),
            $request->getParameters(),
            $request->getToken()
        );
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
        $options = $this->buildOptions($parameters, $token);
        $response = $this->http->request('POST', $method, $options);

        return $this->getResponseData($response);
    }

    /**
     * @return array<string, array>
     */
    protected function buildOptions(array $parameters, ?string $requestToken): array
    {
        $parameters['v'] = $this->version;
        $token = $requestToken ?: $this->token;

        if ($token) {
            $parameters['access_token'] = $token;
        }

        return [RequestOptions::FORM_PARAMS => $parameters];
    }

    /**
     * @psalm-suppress FalsableReturnStatement
     * @param ResponseInterface $response
     * @return array
     * @throws Throwable
     */
    protected function getResponseData(ResponseInterface $response): array
    {
        $data = json_decode((string)$response->getBody(), true, 512, JSON_THROW_ON_ERROR);

        $this->passError ?: $this->checkErrors($data);
        return $data;

    }

    /**
     * @throws Throwable
     */
    protected function checkErrors(array|false $data): void
    {
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new VkException('Invalid VK response format: ' . json_last_error_msg());
        }

        if (!is_array($data)) {
            throw new VkException('Invalid response format');
        }

        if (isset($data['error'])) {
            is_array($data['error'])
                ?: $data['error'] = ['error_msg' => $data['error'], 'error_code' => 0];

            throw self::toException($data['error']);

        }

        if (isset($data['execute_errors'][0])) {
            throw self::toException($data['execute_errors'][0]);
        }
    }

    /**
     * @throws Throwable
     */
    protected function createException(int $code, string $message): Throwable
    {
        throw self::toException(['error_code' => $code, 'error_msg' => $message]);
    }

    /**
     * @param array $error
     * @return Throwable
     */
    public static function toException(array $error): Throwable
    {
        $message = $error['error_msg'] ?? $error['error'] ?? '';
        $code = $error['error_code'] ?? 0;

        $map = [
            0 => Exceptions\VkException::class,
            1 => Exceptions\UnknownErrorVkException::class,
            5 => Exceptions\AuthorizationFailedVkException::class,
            6 => Exceptions\TooManyRequestsVkException::class,
            7 => Exceptions\PermissionDeniedVkException::class,
            9 => Exceptions\TooMuchSimilarVkException::class,
            10 => Exceptions\InternalErrorVkException::class,
            14 => Exceptions\CaptchaRequiredVkException::class,
            15 => Exceptions\AccessDeniedVkException::class,
            20 => Exceptions\RuntimeException::class,
        ];

        /** @var Exception|Throwable $exception */
        $exception = $map[$code] ?? $map[0];

        /**
         * @psalm-suppress UndefinedClass
         */
        return new $exception($message, $code);
    }


    /**
     * @param callable $callable
     * @param array $instances
     * @return array
     * @throws Throwable
     */
    protected function parallelRequest(callable $callable, array $instances): array
    {
        return wait(parallelMap($instances, function ($instance) use ($callable) {
            return $callable($instance);
        }));
    }

    /**
     * @param callable $callable
     * @param array $instances
     * @return array
     */
    protected function nonParallelRequest(callable $callable, array $instances): array
    {
        return array_map(static function ($instance) use ($callable) {
            return $callable($instance);
        }, $instances);
    }
}
