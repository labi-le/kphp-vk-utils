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
     * @param IRequest $request
     * @return array
     * @throws VkException
     */
    public function send(IRequest $request): array;

    /**
     * @param string $method
     * @param array $parameters
     * @param string|null $token
     * @return array
     * @throws VkException
     */
    public function request(string $method, array $parameters = [], ?string $token = null): array;
}
