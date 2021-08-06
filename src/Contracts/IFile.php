<?php


namespace Astaroth\VkUtils\Contracts;


interface IFile
{
    public function __construct(string $path);

    public function getPath(): string;

    public function getPostFileType(): string;
}