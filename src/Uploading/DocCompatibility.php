<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading;


use Astaroth\VkUtils\Contracts\IDocsUpload;

abstract class DocCompatibility implements IDocsUpload
{
    protected string $path;
    protected ?string $title = null;
    protected ?string $tags = null;
    protected bool $return_tags = false;

    protected string $file_type;

    protected ?int $peer_id = null;
    protected string $file;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @inheritDoc
     */
    public function setTitle(?string $title): static
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setTags(?string $tags): static
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setReturnTags(bool $return_tags): static
    {
        $this->return_tags = $return_tags;
        return $this;
    }

    public function getFile(): string
    {
        return $this->file;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function isReturnTags(): bool
    {
        return $this->return_tags;
    }

    /**
     * @inheritDoc
     */
    public function setPeerId(?int $peer_id): static
    {
        $this->peer_id = $peer_id;
        return $this;
    }

    public function getPeerId(): ?int
    {
        return $this->peer_id;
    }

    /**
     * @inheritDoc
     */
    public function setFile(string $file): static
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    public function getFileType(): string
    {
        return $this->file_type;
    }
}