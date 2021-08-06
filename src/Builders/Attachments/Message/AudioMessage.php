<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders\Attachments\Message;


use Astaroth\VkUtils\Builders\Attachments\AbstractAttachments\AbstractDoc;

/**
 * Class AudioMessage
 * @package Astaroth\VkUtils\Uploading\Objects
 */
final class AudioMessage extends AbstractDoc
{
    public function getConcreteType(): string
    {
        return "audio_message";
    }

    public function getUploadMethod(): string
    {
        return "docs.getMessagesUploadServer";
    }
}