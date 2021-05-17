<?php

declare(strict_types=1);


namespace Astaroth\VkUtils;

use Astaroth\VkUtils\Contracts\IDocsUpload;
use Astaroth\VkUtils\Contracts\IFileUploader;
use Astaroth\VkUtils\Contracts\IPhoto;
use Astaroth\VkUtils\Contracts\IVideo;
use Astaroth\VkUtils\Traits\ParallelProcessingTrait;
use Astaroth\VkUtils\Uploading\Doc;
use Astaroth\VkUtils\Uploading\DocCompatibility;
use Astaroth\VkUtils\Uploading\Photo;
use Astaroth\VkUtils\Uploading\Video;
use Closure;
use Throwable;

/**
 * Class Uploader
 * @package Astaroth\VkUtils
 */
class Uploader extends Client implements IFileUploader
{
    use ParallelProcessingTrait;

    /**
     * Download and open a file from the internet
     * @param string $direct_link
     * @return mixed
     * @throws Throwable
     */
    private function openWebFile(string $direct_link): mixed
    {

        return fopen(tmpfile_ext($direct_link), 'rb') ?: $this->createException(self::RUNTIME_EXCEPTION, 'Failed to load file');
    }

    /**
     * Open local file
     * @param string $path
     * @return mixed
     * @throws Throwable
     */
    private function openLocalFile(string $path): mixed
    {
        return file_exists($path) ? fopen($path, 'rb') : $this->createException(self::RUNTIME_EXCEPTION, 'File does not exist');
    }

    /**
     * @throws Throwable
     */
    private function openFile(string $file)
    {
        return filter_var($file, FILTER_VALIDATE_URL)
            ? $this->openWebFile($file)
            : $this->openLocalFile($file);
    }

    /**
     * @throws Throwable
     */
    private function multipartGenerator(string $name, string $content): array
    {
        return ['multipart' => [['name' => $name, 'contents' => $this->openFile($content)],]];
    }

    /**
     * @param ?int $id
     * @param string $selector
     * @return ?array
     * @throws Throwable
     */
    private function getMessagesUploadServer(?int $id, string $selector): ?array
    {
        if ($selector === 'doc' || $selector === 'audio_message' || $selector === 'graffiti') {
            return $this->request('docs.getMessagesUploadServer', ['type' => $selector, 'peer_id' => $id]);
        }

        if ($selector === 'photo') {
            return $this->request('photos.getMessagesUploadServer', ['group_id' => $id]);
        }

        return null;
    }


    /**
     * @param string $path
     * @param string $name
     * @param string|null $description
     * @param bool|null $is_private
     * @param bool|null $wallpost
     * @param string|null $link
     * @param int|null $group_id
     * @param int|null $album_id
     * @param string|null $privacy_view
     * @param string|null $privacy_comment
     * @param bool|null $no_comments
     * @param bool|null $repeat
     * @param bool|null $compression
     * @return string
     * @throws Throwable
     */
    protected function videoSave(
        string $path,
        string $name,
        ?string $description,
        ?bool $is_private,
        ?bool $wallpost,
        ?string $link,
        ?int $group_id,
        ?int $album_id,
        ?string $privacy_view,
        ?string $privacy_comment,
        ?bool $no_comments,
        ?bool $repeat,
        ?bool $compression,
    ): string
    {
        $param = get_defined_vars();
        unset($param['path']);
        $data = $this->request('video.save', $param)['response'];

        $this->uploadFile($data['upload_url'], $path, 'video_file');
        return sprintf('%s%s_%s_%s', 'video', $data['owner_id'], $data['video_id'], $data['access_key']);
    }


    /**
     * @param string $photo
     * @param int|null $server
     * @param string|null $hash
     * @return string
     * @throws Throwable
     */
    private function photoSave(string $photo, int $server = null, string $hash = null): string
    {
        $data = $this->request('photos.saveMessagesPhoto', get_defined_vars());
        $item = current($data['response']);

        return sprintf('%s%s_%s_%s', 'photo', $item['owner_id'], $item['id'], $item['access_key']);
    }

    /**
     * @param Doc $docs
     * @return string
     * @throws Throwable
     */
    private function docsSave(DocCompatibility $docs): string
    {
        $data = $this->request('docs.save',
            [
                'file' => $docs->getFile(),
                'title' => $docs->getTitle(),
                'tags' => $docs->getTags(),
                'return_tags' => $docs->isReturnTags()
            ]);

        $response = $data['response'];
        $type = $response['type'];

        $item = $response[$type];

        $owner_id = $item['owner_id'];
        $id = $item['id'];

        return sprintf('%s%s_%s', $type, $owner_id, $id);

    }

    /**
     * @throws Throwable
     */
    private function uploadFile(string $upload_url, string $file, string $type): array
    {
        return $this->requestWithoutBaseUri($upload_url, $this->multipartGenerator($type, $file));
    }

    private function callableVideo(): Closure
    {
        $temp_name = uniqid('', false);

        return function (Video $Video) use ($temp_name) {
            return $this->videoSave
            (
                $Video->getPath(),
                $Video->getName() ?? $temp_name,
                $Video->getDescription(),
                $Video->isIsPrivate(),
                $Video->isWallpost(),
                $Video->getLink(),
                $Video->getGroupId(),
                $Video->getAlbumId(),
                $Video->getPrivacyView(),
                $Video->getPrivacyComment(),
                $Video->isNoComments(),
                $Video->isRepeat(),
                $Video->isCompression()
            );
        };
    }

    private function callableDocCompatibility(): Closure
    {
        return function (DocCompatibility $DocInstances) {
            $data = $this->getMessagesUploadServer($DocInstances->getPeerId(), $DocInstances->getFileType());
            $response = $this->uploadFile
            (
                $data['response']['upload_url'],
                $DocInstances->getPath(),
                'file'
            );

            $DocInstances->setFile($response['file']);
            return $this->docsSave($DocInstances);
        };
    }

    private function callablePhoto(): Closure
    {
        return function (Photo $PhotoInstances) {
            $data = $this->getMessagesUploadServer($PhotoInstances->getGroupId(), $PhotoInstances->getFileType());
            $response = $this->uploadFile
            (
                $data['response']['upload_url'],
                $PhotoInstances->getPath(),
                'file'
            );

            return $this->photoSave($response['photo'], $response['server'], $response['hash']);
        };
    }


    /**
     * @throws Throwable
     */
    private function saver(IDocsUpload|Photo|Video ...$CompatibilityInstances): array
    {
        $callable = function ($CompatibilityInstances) {

            if ($CompatibilityInstances instanceof DocCompatibility) {
                return $this->callableDocCompatibility()($CompatibilityInstances);
            }
            if ($CompatibilityInstances instanceof Photo) {
                return $this->callablePhoto()($CompatibilityInstances);
            }
            if ($CompatibilityInstances instanceof Video) {
                return $this->callableVideo()($CompatibilityInstances);
            }

            return self::createException(self::RUNTIME_EXCEPTION, "Callback function error, no compatibility instance found ");
        };

        return self::isParallelUpload()
            ? $this->parallelRequest($callable, $CompatibilityInstances)
            : $this->nonParallelRequest($callable, $CompatibilityInstances);
    }

    /**
     * @throws Throwable
     */
    public function upload(IDocsUpload|IVideo|IPhoto ...$CompatibilityInstances): array
    {
        return $this->saver(...$CompatibilityInstances);
    }
}