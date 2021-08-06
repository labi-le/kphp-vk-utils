<?php

declare(strict_types=1);

namespace Astaroth\VkUtils;


use Astaroth\VkUtils\Builders\Attachments\Message\AudioMessage;
use Astaroth\VkUtils\Builders\Attachments\Message\Doc;
use Astaroth\VkUtils\Builders\Attachments\Message\Graffiti;
use Astaroth\VkUtils\Builders\Attachments\Message\PhotoMessages;
use Astaroth\VkUtils\Builders\Attachments\Photo;
use Astaroth\VkUtils\Builders\Attachments\ShortVideo;
use Astaroth\VkUtils\Builders\Attachments\StoriesPhoto;
use Astaroth\VkUtils\Builders\Attachments\StoriesVideo;
use Astaroth\VkUtils\Builders\Attachments\Video;
use Astaroth\VkUtils\Builders\Attachments\Wall\DocWall;
use Astaroth\VkUtils\Builders\Attachments\Wall\PhotoWall;
use Astaroth\VkUtils\Contracts\ICanBeSaved;
use Astaroth\VkUtils\Contracts\IFileUploader;

class Uploader extends AbstractFork implements IFileUploader
{
    private const RuntimeException = 20;

    /**
     * KPHP Trick
     * @param string $version
     */
    public function __construct(string $version = "5.131")
    {
        parent::__construct($version);
    }

    /**
     * @param ICanBeSaved ...$CompatibilityInstances
     * @return array
     * @throws \Exception
     */
    public function upload(...$CompatibilityInstances): array
    {
        $callable = function (ICanBeSaved $builder) {
            // get direct download link
            $response = $this->request($builder->getUploadMethod(), $builder->getUploadParams());

            // upload file
            $attach = $this->uploadFile(
                (string)$response["upload_url"],
                $builder->getPath(),
                $builder->getPostFileType()
            );

            /** The video\shortVideo itself is saved, and you don't need to call other methods */
            switch (get_class($builder)) {
                case Video::class:
                case ShortVideo::class:
                    $attachment = $this->parseAttach($response, $builder);
                    break;

                default:
                    $file = $this->request($builder->getSaveMethod(), $builder->getSaveParams($attach));
                    $attachment = $this->parseAttach($file, $builder);
            }

            if ($attachment === null) {
                throw new \LogicException("Failed to save file");
            }
            return $attachment;
        };

        return $this->statusFork()
            ? $this->parallelRequest($callable, ...$CompatibilityInstances)
            : $this->nonParallelRequest($callable, ...$CompatibilityInstances);
    }

    /**
     * @param array $data
     * @param object $object
     * @return string|null
     * @throws \Exception
     */
    private function parseAttach(array $data, object $object): ?string
    {
        switch (get_class($object)) {
            case Photo::class:
            case PhotoWall::class:
            case PhotoMessages::class:
                return $this->fetchPhoto($data);

            case StoriesPhoto::class:
            case StoriesVideo::class:
                return $this->fetchStory($data);

            case Video::class:
            case ShortVideo::class:
                return $this->fetchVideo($data);

            case Doc::class:
            case AudioMessage::class:
            case Graffiti::class:
            case DocWall::class:
                return $this->fetchDoc($data);
        }
        return null;
    }

    /**
     * @throws \Exception
     */
    private function fetchStory(array $data): string
    {
        $attachment = (array)$data[0];
        $this->validateAttachment($attachment, "owner_id", "id");

        return sprintf(
            "%s%s_%s",
            "story",
            $attachment["owner_id"],
            $attachment["id"]
        );
    }

    /**
     * @throws \Exception
     */
    private function fetchPhoto(array $data): string
    {
        $attachment = (array)$data[0];
        $this->validateAttachment($attachment, "owner_id", "id");

        return sprintf(
            "%s%s_%s",
            "photo",
            $attachment["owner_id"],
            $attachment["id"]
        );
    }


    /**
     * @throws \Exception
     */
    private function fetchVideo(array $data): string
    {
        $this->validateAttachment($data, "owner_id", "video_id");

        $attachment = sprintf("%s%s_%s",
            "video", $data["owner_id"], $data["video_id"]
        );
        $attachment .= isset($data["access_key"]) ? "_" . $data["access_key"] : null;

        return $attachment;
    }

    /**
     * @throws \Exception
     */
    private function fetchDoc(array $data): string
    {
        $this->validateAttachment($data, "type");

        $file_type = (string)$data["type"];
        $concrete_file = (array)$data[$file_type];

        $this->validateAttachment($concrete_file, "owner_id", "id");


        $attachment = sprintf(
            "%s%s_%s",
            $file_type,
            $concrete_file["owner_id"],
            $concrete_file["id"],
        );

        $attachment .= isset($concrete_file["access_key"]) ? "_" . $concrete_file["access_key"] : null;

        return $attachment;
    }

    /**
     * @param array $data
     * @param string ...$needles
     * @throws \Exception
     */
    private function validateAttachment(array $data, string ...$needles): void
    {
        foreach ($needles as $needle) {
            if (isset($data[$needle]) === false) {
                (new ExceptionGenerator(self::RuntimeException, "Failed to parse attachment"))->throw();
            }
        }
    }
}