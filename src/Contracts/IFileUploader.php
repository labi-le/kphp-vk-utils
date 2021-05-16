<?php


namespace Astaroth\VkUtils\Contracts;


/**
 * Interface IFileUploader
 * @package Astaroth\VkUtils\Contracts
 */
interface IFileUploader
{

    public function upload(IDocsUpload|IPhoto|IVideo ...$CompatibilityInstances): array;

}