<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Traits;


trait AttachmentsUploadTrait
{
    protected string $path;

    /**
     * Set path to file\url
     * AttachmentsUploadTrait constructor.
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}