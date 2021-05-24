<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders;


use Astaroth\VkUtils\Client;

abstract class Builder extends Client
{
    /**
     * Create object builder
     * @return array
     */
    abstract public function create() : array;
}