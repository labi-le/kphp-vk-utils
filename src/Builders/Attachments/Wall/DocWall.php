<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders\Attachments\Wall;


use Astaroth\VkUtils\Builders\Attachments\AbstractAttachments\AbstractDoc;

/**
 * Class DocWall
 * @package Astaroth\VkUtils\Uploading\Objects
 */
final class DocWall extends AbstractDoc
{
    public function getConcreteType(): string
    {
        return "doc";
    }

    public function getUploadMethod(): string
    {
        return "docs.getWallUploadServer";
    }

    public function getUploadParams(): array
    {
        return [
            "group_id" => $this->peer_id
        ];
    }
}