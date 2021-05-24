<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Contracts;


use Astaroth\VkUtils\Uploading\Photo;

interface IPhoto
{
    public function setGroupId(int $group_id): Photo;
}