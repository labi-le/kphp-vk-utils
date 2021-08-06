<?php


namespace Astaroth\VkUtils\Builders\Attachments\Message;


use Astaroth\VkUtils\Builders\Attachments\AbstractAttachments\AbstractPhoto;

class PhotoMessages extends AbstractPhoto
{

    public function setGroupId(int $group_id): PhotoMessages
    {
        return $this->_setGroupId($group_id);
    }

    public function getUploadMethod(): string
    {
        return "photos.getMessagesUploadServer";
    }

    public function getSaveMethod(): string
    {
        return "photos.saveMessagesPhoto";
    }

    public function getUploadParams(): array
    {
        return [
            "group_id" => $this->group_id,
        ];
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