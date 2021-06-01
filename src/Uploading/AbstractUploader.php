<?php
/** @noinspection PhpMixedReturnTypeCanBeReducedInspection */

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading;


use Astaroth\VkUtils\Client;
use Astaroth\VkUtils\Contracts\IDocsUpload;
use Astaroth\VkUtils\Contracts\IPhoto;
use Astaroth\VkUtils\Contracts\ISave;
use Astaroth\VkUtils\Contracts\IStories;
use Astaroth\VkUtils\Contracts\IVideo;
use Astaroth\VkUtils\Traits\ParallelProcessingTrait;
use Astaroth\VkUtils\Uploading\Methods\StoriesSave;
use Astaroth\VkUtils\Uploading\Objects\Abstract\AbstractDoc;
use Astaroth\VkUtils\Uploading\Objects\Abstract\AbstractStories;
use Astaroth\VkUtils\Uploading\Objects\Photo;
use Astaroth\VkUtils\Uploading\Objects\PhotoStories;
use Astaroth\VkUtils\Uploading\Objects\Video;
use Astaroth\VkUtils\Uploading\Objects\VideoStories;
use Closure;
use Throwable;

abstract class AbstractUploader extends Client
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
     * @throws Throwable
     */
    protected function getMessagesUploadServer(?int $id, string $selector): array|Throwable
    {
        if ($selector === 'doc' || $selector === 'audio_message' || $selector === 'graffiti') {
            return $this->getUploadServer("docs", "messages", ['type' => $selector, 'peer_id' => $id]);
        }

        if ($selector === 'photo') {
            return $this->getUploadServer("photos", "messages", ['group_id' => $id]);
        }

        return $this->createException(self::RUNTIME_EXCEPTION, 'Incorrect selector');
    }


    /**
     * @throws Throwable
     */
    protected function getWallUploadServer(?int $id, string $selector): array|Throwable
    {
        if ($selector === "doc" || $selector === "photo") {
            return $this->getUploadServer($selector . "s", "wall", ['group_id' => $id]);
        }

        return $this->createException(self::RUNTIME_EXCEPTION, "Wrong Selector");
    }

    /**
     * @throws Throwable
     */
    protected function getUploadServer(string $objectType, ?string $uploadType, array $params): array
    {
        return match ($uploadType) {
            "wall", "messages", "photo", "video" => $this->request(sprintf("%s.get%sUploadServer", $objectType, ucfirst($uploadType)), $params),
            null => $this->request(sprintf("%s.getUploadServer", $objectType), $params)
        };
    }

    /**
     * @deprecated
     * @throws Throwable
     */
    protected function saveObject(string $objectType, ?string $saveType, array $params): array
    {
        $lastWord = substr($objectType, -1) === "s" ? substr($objectType, 0, -1) : $objectType;
        $data = match ($saveType) {
            "Wall", "Messages" => $this->request(
                sprintf("%s.save%s%s",
                    $objectType,
                    $saveType,
                    $lastWord),
                $params)["response"],

            null => $this->request(sprintf("%s.save", $objectType), $params)
        };

        return $data['response'];
    }


    /**
     * @throws Throwable
     */
    protected function getStoriesUploadServer(AbstractStories $stories): array|Throwable
    {
        $type = $stories instanceof PhotoStories ? "photo" : "video";
        return $this->getUploadServer("stories", $type, get_object_vars($stories));
    }


    /**
     * @throws Throwable
     */
    protected function videoSave(Video $video): string
    {
        $data = $this->save($video);

        $this->uploadFile($data['upload_url'], $video->getPath(), 'video_file');
        return sprintf('%s%s_%s_%s', 'video', $data['owner_id'], $data['video_id'], $data['access_key']);
    }


    /**
     * @param AbstractDoc $docs
     * @return string
     * @throws Throwable
     */
    protected function docsSave(AbstractDoc $docs): string
    {
        $data = $this->save($docs);

        $type = $data['type'];
        $item = $data[$type];
        $owner_id = $item['owner_id'];
        $id = $item['id'];

        return sprintf('%s%s_%s', $type, $owner_id, $id);

    }

    /**
     * @throws Throwable
     */
    protected function uploadFile(string $upload_url, string $file, string $type): array
    {
        return $this->requestWithoutBaseUri($upload_url, $this->multipartGenerator($type, $file));
    }

    protected function uploadVideo(): Closure
    {
        return fn(Video $Video) => $this->videoSave($Video);
    }

    abstract protected function uploadDocCompatibility(): Closure;

    abstract protected function uploadPhoto(): Closure;

    /**
     * @throws Throwable
     */
    protected function photoSave(ISave $photo): string
    {
        $item = current($this->save($photo));
        return sprintf('%s%s_%s_%s', 'photo', $item['owner_id'], $item['id'], $item['access_key']);
    }

    /**
     * @throws Throwable
     */
    private function save(ISave $object): array
    {
        return $this->request($object->getMethod(), get_object_vars($object))['response'];
    }


    protected function uploadStory(): Closure
    {
        return function (AbstractStories $StoriesInstances) {
            $data = $this->getStoriesUploadServer($StoriesInstances);

            $result = $this->uploadFile
            (
                $data['response']['upload_url'],
                $StoriesInstances->getPath(),
                $StoriesInstances instanceof VideoStories ? 'video_file' : 'file'
            );

            $stories = new StoriesSave($result['response']);
            $stories->upload_results = $result['response']['upload_result'];

            return current($this->storiesSave($stories));

        };
    }

    /**
     * @throws Throwable
     */
    private function storiesSave(StoriesSave $stories): array
    {
        return array_map(static fn($story) => sprintf("story%s_%s",
            $story['owner_id'],
            $story['id']),
            $this->save($stories)['items']
        );
    }

    /**
     * @throws Throwable
     */
    private function saver(AbstractDoc|Photo|Video|AbstractStories ...$CompatibilityInstances): array
    {
        $callable = function ($CompatibilityInstances) {

            if ($CompatibilityInstances instanceof AbstractDoc) {
                return $this->uploadDocCompatibility()($CompatibilityInstances);
            }
            if ($CompatibilityInstances instanceof Photo) {
                return $this->uploadPhoto()($CompatibilityInstances);
            }
            if ($CompatibilityInstances instanceof Video) {
                return $this->uploadVideo()($CompatibilityInstances);
            }
            if ($CompatibilityInstances instanceof AbstractStories) {
                return $this->uploadStory()($CompatibilityInstances);
            }

            return self::createException(self::RUNTIME_EXCEPTION, "Callback function error, no compatibility instance found ");
        };

        return $this->isEnabledParallelRequests()
            ? $this->parallelRequest($callable, $CompatibilityInstances)
            : $this->nonParallelRequest($callable, $CompatibilityInstances);
    }

    /**
     * @throws Throwable
     */
    public function upload(IDocsUpload|IVideo|IPhoto|IStories ...$CompatibilityInstances): array
    {
        return $this->saver(...$CompatibilityInstances);
    }
}