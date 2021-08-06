<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders\Attachments;



use Astaroth\VkUtils\Builders\Attachments\AbstractAttachments\AbstractStories;

/**
 * Class StoriesVideo
 * @package Astaroth\VkUtils\Builders\Attachments
 */
class StoriesVideo extends AbstractStories
{
    public function getConcreteType(): string
    {
        return "stories.video";
    }

    public function getUploadMethod(): string
    {
        return "stories.getVideoUploadServer";
    }

    public function getPostFileType(): string
    {
        return "video_file";
    }
}