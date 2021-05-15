<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Contracts;


interface IMessage
{
    public function create(IMessageBuilder $message): array;
}