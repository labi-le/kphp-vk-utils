<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders\Attachments\AbstractAttachments;


use Astaroth\VkUtils\Contracts\IDocs;

abstract class AbstractDoc extends AbstractFile implements IDocs
{
    protected ?string $title = null;
    protected ?string $tags = null;
    protected bool $return_tags = false;

    protected ?int $peer_id = null;

    /**
     * KPHP Trick
     * @param string $path
     */
    public function __construct(string $path)
    {
        parent::__construct($path);
    }

    /**
     * @inheritDoc
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setTags(string $tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setReturnTags(bool $return_tags)
    {
        $this->return_tags = $return_tags;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPeerId(int $peer_id)
    {
        $this->peer_id = $peer_id;
        return $this;
    }

    public function getSaveMethod(): string
    {
        return "docs.save";
    }

    public function getPostFileType(): string
    {
        return "file";
    }


    public function getSaveParams(array $data): array
    {
        return array_merge([
            "file" => null,
            "title" => $this->title,
            "return_tags" => $this->return_tags
        ], $data);
    }

    public function getUploadParams(): array
    {
        return ["type" => $this->getConcreteType(), "peer_id" => $this->peer_id];
    }
}