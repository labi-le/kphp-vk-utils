<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading\Objects\Abstract;


use Astaroth\VkUtils\Contracts\IDocsUpload;
use Astaroth\VkUtils\Contracts\ISave;

abstract class AbstractDoc extends AbstractFile implements IDocsUpload, ISave
{
    public ?string $title = null;
    public ?string $tags = null;
    public bool $return_tags = false;

    protected string $file_type;

    public ?int $peer_id = null;
    public string $file;

    /**
     * @inheritDoc
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setTags(string $tags): static
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
    public function setPeerId(int $peer_id): static
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

    public function getFileType(): string
    {
        return $this->file_type;
    }

    public function getMethod(): string
    {
        return "docs.save";
    }
}