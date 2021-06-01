<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading\Methods;


/**
 * Class PhotoSaveWall
 * @package Astaroth\VkUtils\Uploading\Methods
 */
class PhotoSaveWall extends PhotoSave
{
    public int $user_id;

    public function getMethod(): string
    {
        return "photos.saveWallPhoto";
    }
}