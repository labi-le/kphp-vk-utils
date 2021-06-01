<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading\Methods;

use Astaroth\VkUtils\Uploading\Objects\Abstract\AbstractSaveFile;

/**
 * Class SavePhoto
 * https://vk.com/dev/photos.save
 * @package Astaroth\VkUtils\Uploading\Methods
 */
class PhotoSave extends AbstractSaveFile
{
    public int $server;
    public string $hash;
    public string $photo;
    public ?string $photos_list;
    public int $album_id;
    public ?int $group_id = null;
    public ?float $latitude = null;
    public ?float $longitude = null;
    public ?string $caption = null;

    public function getMethod(): string
    {
        return "photos.save";
    }
}