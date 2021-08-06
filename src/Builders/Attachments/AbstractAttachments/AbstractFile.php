<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders\Attachments\AbstractAttachments;


use Astaroth\VkUtils\Contracts\ICanBeSaved;

abstract class AbstractFile implements ICanBeSaved
{
    protected string $path;

    /**
     * Set path to file\url
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

    abstract public function getConcreteType(): string;
}