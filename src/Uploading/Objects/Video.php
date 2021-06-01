<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading\Objects;

use Astaroth\VkUtils\Contracts\ISave;
use Astaroth\VkUtils\Contracts\IVideo;
use Astaroth\VkUtils\Uploading\Objects\Abstract\AbstractFile;

/**
 * Class Video
 * @package Astaroth\VkUtils\Uploading\Objects
 */
final class Video extends AbstractFIle implements IVideo, ISave
{
    public ?string $name = null;
    public ?string $description = null;
    public bool $is_private = false;
    public bool $wallpost = false;
    public ?string $link = null;
    public ?int $group_id = null;
    public ?int $album_id = null;

    /**
     * https://vk.com/dev/privacy_setting
     * @var string|null
     */
    public ?string $privacy_view = null;

    public ?string $privacy_comment = null;

    public bool $no_comments = false;
    public bool $repeat = false;
    public bool $compression = false;

    /**
     * @inheritDoc
     */
    public function setName(string $name): Video
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDescription(string $description): Video
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setIsPrivate(bool $is_private): Video
    {
        $this->is_private = $is_private;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setWallpost(bool $wallpost): Video
    {
        $this->wallpost = $wallpost;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLink(string $link): Video
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setGroupId(int $group_id): Video
    {
        $this->group_id = $group_id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setAlbumId(int $album_id): Video
    {
        $this->album_id = $album_id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPrivacyView(string $privacy_view): Video
    {
        $this->privacy_view = $privacy_view;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPrivacyComment(string $privacy_comment): Video
    {
        $this->privacy_comment = $privacy_comment;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setNoComments(bool $no_comments): Video
    {
        $this->no_comments = $no_comments;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setRepeat(bool $repeat): Video
    {
        $this->repeat = $repeat;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCompression(bool $compression): Video
    {
        $this->compression = $compression;
        return $this;
    }

    public function getMethod(): string
    {
        return "video.save";
    }
}