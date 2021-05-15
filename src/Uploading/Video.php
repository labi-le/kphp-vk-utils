<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading;

use Astaroth\VkUtils\Contracts\IAttachmentUpload;
use Astaroth\VkUtils\Contracts\IVideo;

/**
 * Class Video
 * @package Astaroth\VkUtils\Uploading
 */
final class Video implements IAttachmentUpload, IVideo
{
    private string $path;
    private ?string $name = null;
    private ?string $description = null;

    private bool $is_private = false;
    /**
     * @var bool
     */
    private bool $wallpost = false;

    private ?string $link = null;

    private ?int $group_id = null;
    private ?int $album_id = null;

    /**
     * https://vk.com/dev/privacy_setting
     * @var string|null
     */
    private ?string $privacy_view = null;

    private ?string $privacy_comment = null;

    private bool $no_comments = false;
    private bool $repeat = false;
    private bool $compression = false;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @inheritDoc
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setIsPrivate(bool $is_private): static
    {
        $this->is_private = $is_private;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setWallpost(bool $wallpost): static
    {
        $this->wallpost = $wallpost;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLink(string $link): static
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setGroupId(int $group_id): static
    {
        $this->group_id = $group_id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setAlbumId(int $album_id): static
    {
        $this->album_id = $album_id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPrivacyView(string $privacy_view): static
    {
        $this->privacy_view = $privacy_view;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPrivacyComment(string $privacy_comment): static
    {
        $this->privacy_comment = $privacy_comment;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setNoComments(bool $no_comments): static
    {
        $this->no_comments = $no_comments;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setRepeat(bool $repeat): static
    {
        $this->repeat = $repeat;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCompression(bool $compression): static
    {
        $this->compression = $compression;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function isIsPrivate(): bool
    {
        return $this->is_private;
    }

    /**
     * @return bool
     */
    public function isWallpost(): bool
    {
        return $this->wallpost;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->group_id;
    }

    /**
     * @return int|null
     */
    public function getAlbumId(): ?int
    {
        return $this->album_id;
    }

    /**
     * @return string|null
     */
    public function getPrivacyView(): ?string
    {
        return $this->privacy_view;
    }

    /**
     * @return string|null
     */
    public function getPrivacyComment(): ?string
    {
        return $this->privacy_comment;
    }

    /**
     * @return bool
     */
    public function isNoComments(): bool
    {
        return $this->no_comments;
    }

    /**
     * @return bool
     */
    public function isRepeat(): bool
    {
        return $this->repeat;
    }

    /**
     * @return bool
     */
    public function isCompression(): bool
    {
        return $this->compression;
    }

}