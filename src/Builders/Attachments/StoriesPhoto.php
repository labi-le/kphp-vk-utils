<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders\Attachments;


use Astaroth\VkUtils\Builders\Attachments\AbstractAttachments\AbstractStories;

/**
 * Class StoriesPhoto
 * @package Astaroth\VkUtils\Builders\Attachments
 */
class StoriesPhoto extends AbstractStories
{
    public function getConcreteType(): string
    {
        return "stories.photo";
    }

    public function getUploadMethod(): string
    {
        return "stories.getPhotoUploadServer";
    }

    public function getPostFileType(): string
    {
        return "file";
    }
}