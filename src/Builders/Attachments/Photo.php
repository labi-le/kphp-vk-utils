<?php


namespace Astaroth\VkUtils\Builders\Attachments;


use Astaroth\VkUtils\Builders\Attachments\AbstractAttachments\AbstractPhoto;

class Photo extends AbstractPhoto
{

    public function setAlbumId(int $album_id): Photo
    {
        return $this->_setAlbumId($album_id);
    }

    public function setGroupId(int $group_id): Photo
    {
        return $this->_setGroupId($group_id);
    }

    public function getUploadMethod(): string
    {
        return "photos.getUploadServer";
    }

    public function getSaveMethod(): string
    {
        return "photos.save";
    }

    public function getUploadParams(): array
    {
        return ["album_id" => $this->album_id, "group_id" => $this->group_id];
    }

    public function getSaveParams(array $data): array
    {
        return array_merge(
            [
                "photo" => null,

                "album_id" => $this->album_id,
                "server" => null,
                "photos_list" => null,
                "hash" => null,
                "group_id" => $this->group_id,
                "latitude" => null,
                "longitude" => null,
                "caption" => null,
            ], $data);
    }
}