<?php


namespace Astaroth\VkUtils\Contracts;

/**
 * Interface IBuilder
 * @package Astaroth\VkUtils\Contracts
 */
interface IBuilder
{
    /**
     * Method from vk api that builder implements
     * @return string
     */
    public function getMethod(): string;

    /**
     * Trick kphp
     * Big getter, which gets all the filled properties in the object
     * @return array
     */
    public function getParams(): array;
}