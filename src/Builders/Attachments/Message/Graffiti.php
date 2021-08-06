<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders\Attachments\Message;


use Astaroth\VkUtils\Builders\Attachments\AbstractAttachments\AbstractDoc;

/**
 * Class Graffiti
 * @package Astaroth\VkUtils\Uploading\Objects
 */
final class Graffiti extends AbstractDoc
{
    public function getConcreteType(): string
    {
        return "graffiti";
    }

    public function getUploadMethod(): string
    {
        return "docs.getMessagesUploadServer";
    }
}