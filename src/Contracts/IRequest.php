<?php


namespace Astaroth\VkUtils\Contracts;

/**
 * Interface IRequest
 * @package Astaroth\VkUtils\Contracts
 */
interface IRequest
{
    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return array
     */
    public function getParameters(): array;

    /**
     * @return null|string
     */
    public function getToken(): ?string;
}
