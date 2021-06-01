<?php

declare(strict_types=1);

namespace Astaroth\VkUtils\Uploading\Objects\Abstract;

use Astaroth\VkUtils\Contracts\ISave;

abstract class AbstractSaveFile implements ISave
{
    public function __construct(array $data)
    {
        array_walk_recursive($data, function ($value, $property) {
            if (property_exists($this, $property)) {
                $this->$property = $value;
            }
        });
    }
}