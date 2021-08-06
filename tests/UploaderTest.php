<?php

declare(strict_types=1);


use Astaroth\VkUtils\Builders\Attachments\Message\Doc;
use Astaroth\VkUtils\Builders\Attachments\Message\PhotoMessages;
use Astaroth\VkUtils\Builders\Attachments\Photo;
use Astaroth\VkUtils\Builders\Attachments\ShortVideo;
use Astaroth\VkUtils\Builders\Attachments\StoriesPhoto;
use Astaroth\VkUtils\Builders\Attachments\StoriesVideo;
use Astaroth\VkUtils\Builders\Attachments\Video;
use Astaroth\VkUtils\Builders\Attachments\Wall\PhotoWall;
use Astaroth\VkUtils\Uploader;
use function PHPUnit\Framework\assertIsString;

use PHPUnit\Framework\TestCase;

class UploaderTest extends TestCase
{
    private const ACCESS_TOKEN = "";
    private const ALBUM_ID = 280398652; //set

    private Uploader $uploader;

    protected function setUp(): void
    {
        $this->uploader = new Uploader();
        $this->uploader->setDefaultToken(self::ACCESS_TOKEN);
    }

    public function testUpload(): void
    {
        $attachments = $this->uploader->upload(
            (new ShortVideo("https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4"))
                ->setDescription("#oldad"),
            new Doc("https://images.dog.ceo/breeds/newfoundland/n02111277_11806.jpg"),
            (new Photo("https://images.dog.ceo/breeds/dane-great/n02109047_31049.jpg"))
                ->setAlbumId(self::ALBUM_ID),
            new PhotoWall("https://images.dog.ceo/breeds/dane-great/n02109047_31049.jpg"),
            new PhotoMessages("https://images.dog.ceo/breeds/dane-great/n02109047_31049.jpg"),
            (new Video("https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4"))
                ->setName("Test Video")
                ->setIsPrivate(true),
            new StoriesVideo("https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4"),
            new StoriesPhoto("https://images.dog.ceo/breeds/dane-great/n02109047_31049.jpg")

        );

        array_walk($attachments, static fn($element) => assertIsString($element));
    }
}
