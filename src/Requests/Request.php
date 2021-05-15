<?php


namespace Astaroth\VkUtils\Requests;


use Astaroth\VkUtils\Contracts\IRequest;
use Astaroth\VkUtils\Contracts\IScriptable;

/**
 * Class Request
 * @package Astaroth\VkUtils\Requests
 */
class Request implements IRequest, IScriptable
{
    /**
     * @var string
     */
    protected string $method;

    protected array $parameters;

    /**
     * @var null|string
     */
    protected ?string $token;

    /**
     * Request constructor.
     *
     * @param string $method
     * @param array $parameters
     * @param ?string $token
     */
    public function __construct(string $method, array $parameters, ?string $token = null)
    {
        $this->method = $method;
        $this->parameters = $parameters;
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return null|string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function toScript(): string
    {
        $parameters = [];

        foreach ($this->parameters as $key => $value) {
            $parameters[] = sprintf('"%s": "%s"', $key, $value);
        }

        return sprintf('API.%s({%s})', $this->method, implode(', ', $parameters));
    }
}
