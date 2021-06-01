<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading\Objects;


use Astaroth\VkUtils\Uploading\Objects\Abstract\AbstractDoc;

/**
 * Class AudioMessage
 * @package Astaroth\VkUtils\Uploading\Objects
 */
final class AudioMessage extends AbstractDoc
{
    protected string $file_type = 'audio_message';
}