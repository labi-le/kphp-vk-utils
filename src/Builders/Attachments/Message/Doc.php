<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders\Attachments\Message;


use Astaroth\VkUtils\Builders\Attachments\AbstractAttachments\AbstractDoc;

/**
 * Class DocWall
 * @package Astaroth\VkUtils\Uploading\Objects
 */
final class Doc extends AbstractDoc
{
    public function getConcreteType(): string
    {
        return "doc";
    }

    public function getUploadMethod(): string
    {
        return "docs.getMessagesUploadServer";
    }
}