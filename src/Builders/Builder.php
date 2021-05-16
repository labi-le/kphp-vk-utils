<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders;


use Astaroth\VkUtils\Client;

abstract class Builder extends Client
{
    abstract public function create() : array;
}