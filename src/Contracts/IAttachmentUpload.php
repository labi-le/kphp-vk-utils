<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Contracts;


interface IAttachmentUpload
{
    /**
     * @return string
     */
    public function getPath(): string;

    public function __construct(string $path);
}