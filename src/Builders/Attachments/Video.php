<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders\Attachments;


use Astaroth\VkUtils\Builders\Attachments\AbstractAttachments\AbstractFile;
use Astaroth\VkUtils\Contracts\IVideo;

/**
 * Class Video
 * @package Astaroth\VkUtils\Builders\Attachments
 */
class Video extends AbstractFile implements IVideo
{
    /**
     * KPHP Trick
     * @param string $path
     */
    public function __construct(string $path)
    {
        parent::__construct($path);
    }

    private ?string $name = null;
    private ?string $description = null;
    private bool $is_private = false;
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

    public function getUploadMethod(): string
    {
        return "video.save";
    }

    public function getConcreteType(): string
    {
        return "video";
    }

    public function getPostFileType(): string
    {
        return "video_file";
    }

    public function getSaveMethod(): string
    {
//        throw new \LogicException("This type of attachment does not require saving (automatically saved)");
        return "";
    }

    public function getUploadParams(): array
    {
        return
            [
                "name" => $this->name,
                "description" => $this->description,
                "is_private" => $this->is_private,
                "wallpost" => $this->wallpost,
                "link" => $this->link,
                "group_id" => $this->group_id,
                "album_id" => $this->album_id,
                "privacy_view" => $this->privacy_view,
                "privacy_comment" => $this->privacy_comment,
                "no_comments" => $this->no_comments,
                "repeat" => $this->repeat,
                "compression" => $this->compression,
            ];
    }


    public function getSaveParams(array $data): array
    {
//        throw new \LogicException("This type of attachment does not require parameters to save (saved automatically)");
        //trick
        return [];
    }
}