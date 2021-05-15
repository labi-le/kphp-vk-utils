<?php


namespace Astaroth\VkUtils\Contracts;

/**
 * Interface IScriptable
 * @package Astaroth\VkUtils\Contracts
 */
interface IScriptable
{
    /**
     * @return string
     */
    public function toScript(): string;
}
