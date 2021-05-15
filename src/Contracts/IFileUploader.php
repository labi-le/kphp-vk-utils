<?php


namespace Astaroth\VkUtils\Contracts;


/**
 * Interface IFileUploader
 * @package Astaroth\VkUtils\Contracts
 */
interface IFileUploader
{

    public function upload(IDocsUpload|IPhoto|IVideo ...$CompatibilityInstances): array;

    public function uploadPhoto(IPhoto ...$PhotoInstances): array;

    public function uploadAudioMessage(IDocsUpload ...$AudioInstances): array;

    public function uploadGraffiti(IDocsUpload ...$GraffitiInstances): array;

    public function uploadVideo(IVideo ...$VideoInstances): array;

    public function uploadDoc(IDocsUpload ...$DocInstances): array;

}