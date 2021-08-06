<?php

namespace Astaroth\VkUtils\Builders\Attachments;

use Astaroth\VkUtils\Builders\Attachments\AbstractAttachments\AbstractFile;
use Astaroth\VkUtils\Contracts\IShortVideo;
use Astaroth\VkUtils\Tricks\HelpersTricks;


class ShortVideo extends AbstractFile implements IShortVideo
{
    private ?string $device_id = null;
    private bool $wallpost = false;
    private bool $can_make_duet = false;
    private ?string $description = null;

    public function getConcreteType(): string
    {
        return "video";
    }

    public function getPostFileType(): string
    {
        return "video_file";
    }

    public function setWallpost(bool $wallpost): ShortVideo
    {
        $this->wallpost = $wallpost;
        return $this;
    }

    public function setCanMakeDuet(bool $can_make_duet): ShortVideo
    {
        $this->can_make_duet = $can_make_duet;
        return $this;
    }

    public function setDescription(string $description): ShortVideo
    {
        $this->description = $description;
        return $this;
    }

    public function setDeviceId(string $device_id): ShortVideo
    {
        $this->device_id = $device_id;
        return $this;
    }

    public function getUploadParams(): array
    {
        return
            [
                "wallpost" => $this->wallpost,
                "can_make_duet" => $this->can_make_duet,
                "file_size" => file_exists($this->path)
                    ? filesize($this->path)
                    : HelpersTricks::filesize_web($this->path),
                "description" => $this->description,
                "device_id" => $this->device_id,
            ];
    }

    public function getSaveParams(array $data): array
    {
//        throw new \LogicException("This type of attachment does not require parameters to save (saved automatically)");
        //trick
        return [];
    }

    public function getUploadMethod(): string
    {
        return "shortVideo.create";
    }

    public function getSaveMethod(): string
    {
//        throw new \LogicException("This type of attachment does not require saving (automatically saved)");
        //trick
        return '';
    }
}