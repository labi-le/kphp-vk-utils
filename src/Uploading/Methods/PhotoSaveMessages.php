<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading\Methods;


/**
 * Class PhotoSaveMessages
 * @package Astaroth\VkUtils\Uploading\Methods
 */
class PhotoSaveMessages extends PhotoSave
{
    public function getMethod(): string
    {
        return "photos.saveMessagesPhoto";
    }
}