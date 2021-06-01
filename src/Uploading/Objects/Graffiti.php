<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading\Objects;


use Astaroth\VkUtils\Uploading\Objects\Abstract\AbstractDoc;

/**
 * Class Graffiti
 * @package Astaroth\VkUtils\Uploading\Objects
 */
final class Graffiti extends AbstractDoc
{
    protected string $file_type = 'graffiti';
}