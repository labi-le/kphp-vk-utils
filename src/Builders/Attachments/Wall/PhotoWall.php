<?php


namespace Astaroth\VkUtils\Builders\Attachments\Wall;


use Astaroth\VkUtils\Builders\Attachments\AbstractAttachments\AbstractPhoto;

class PhotoWall extends AbstractPhoto
{
    protected function setGroupId(int $group_id): PhotoWall
    {
        return $this->_setGroupId($group_id);
    }

    public function getUploadMethod(): string
    {
        return "photos.getWallUploadServer";
    }

    public function getSaveMethod(): string
    {
        return "photos.saveWallPhoto";
    }

    public function getUploadParams(): array
    {
        return [
            "group_id" => $this->group_id,
        ];
    }

    public function getSaveParams(array $data): array
    {
        return array_merge([
            "user_id" => null,
            "server" => null,
            "photo" => null,
            "hash" => null,
            "group_id" => $this->group_id,
            "latitude" => null,
            "longitude" => null,
            "caption" => null,
        ], $data);
    }
}