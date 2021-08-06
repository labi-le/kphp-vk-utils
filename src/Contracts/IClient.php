<?php

namespace Astaroth\VkUtils\Contracts;

use Astaroth\VkUtils\Exceptions\VkException;


/**
 * Interface Client
 * @package Astaroth\VkClient\Contracts
 */
interface IClient
{
    /**
     * @param string $method
     * @param mixed[] $parameters
     * @param string|null $token
     * @return mixed[]
     * @throws VkException
     */
    public function request(string $method, array $parameters = [], ?string $token = null): array;
}
