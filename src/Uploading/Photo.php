<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading;


use Astaroth\VkUtils\Contracts\IPhoto;
use Astaroth\VkUtils\Traits\AttachmentsUploadTrait;

final class Photo implements IPhoto
{
    use AttachmentsUploadTrait;

    private ?int $group_id = null;

    private string $file_type = 'photo';


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
    public function setGroupId(int $group_id): Photo
    {
        $this->group_id = $group_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileType(): string
    {
        return $this->file_type;
    }
}