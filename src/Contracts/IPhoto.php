<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Contracts;


interface IPhoto
{
    public function setGroupId(int $group_id): static;
}