<?php


namespace Astaroth\VkUtils\Contracts;

/**
 * Interface IUploadAndSaveMethod
 * @package Astaroth\VkUtils\Contracts
 */
interface IUploadAndSaveMethod
{
    public function getUploadParams(): array;

    public function getSaveParams(array $data): array;

    public function getUploadMethod(): string;

    public function getSaveMethod(): string;
}