<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading\Objects\Abstract;


abstract class AbstractFile
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
}