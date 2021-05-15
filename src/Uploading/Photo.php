<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading;


use Astaroth\VkUtils\Contracts\IAttachmentUpload;
use Astaroth\VkUtils\Contracts\IPhoto;

final class Photo implements IAttachmentUpload, IPhoto
{
    private string $path;
    private ?int $group_id = null;

    private string $file_type = 'photo';

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->group_id;
    }

    /**
     * @param int $group_id
     * @return static
     */
    public function setGroupId(int $group_id): static
    {
        $this->group_id = $group_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getFileType(): string
    {
        return $this->file_type;
    }
}