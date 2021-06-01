<?php

declare(strict_types=1);


use Astaroth\VkUtils\Uploading\MessagesUploader;
use Astaroth\VkUtils\Uploading\Objects\AudioMessage;
use Astaroth\VkUtils\Uploading\Objects\Doc;
use Astaroth\VkUtils\Uploading\Objects\Graffiti;
use Astaroth\VkUtils\Uploading\Objects\Photo;
use Astaroth\VkUtils\Uploading\Objects\PhotoStories;
use Astaroth\VkUtils\Uploading\Objects\Video;
use Astaroth\VkUtils\Uploading\Objects\VideoStories;
use Astaroth\VkUtils\Uploading\WallUploader;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertIsString;

class UploaderTest extends TestCase
{
    private const ACCESS_TOKEN = "";

    private MessagesUploader $messageUploader;
    private WallUploader $wallUploader;

    protected function setUp(): void
    {
        $this->wallUploader = new WallUploader();
        $this->messageUploader = new MessagesUploader();

        $this->wallUploader->setDefaultToken(self::ACCESS_TOKEN);
        $this->messageUploader->setDefaultToken(self::ACCESS_TOKEN);

        $this->wallUploader->setNumberOfParallelRequests(3);
        $this->messageUploader->setNumberOfParallelRequests(3);
    }

    public function testWallUploader(): void
    {
        $attachments = $this->wallUploader->upload(
            new Doc('https://images.dog.ceo/breeds/newfoundland/n02111277_11806.jpg'),
            new Photo('https://images.dog.ceo/breeds/dane-great/n02109047_31049.jpg'),

            (new Video('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4'))
                ->setName('Test Video')
                ->setIsPrivate(true)

        );

        array_walk($attachments, static fn($element) => assertIsString($element));
    }

    public function testMessageUploader(): void
    {
        $attachments = $this->messageUploader->upload(
            new Doc('https://images.dog.ceo/breeds/newfoundland/n02111277_11806.jpg'),
            new AudioMessage('https://psv4.userapi.com/c505636//u259166248/audiomsg/d47/6a42fe5ebc.mp3'),
            new Graffiti('https://upload.wikimedia.org/wikipedia/commons/5/59/Empty.png'),
            new Photo('https://images.dog.ceo/breeds/dane-great/n02109047_31049.jpg'),

            (new VideoStories('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4'))->setAddToNews(false),
            (new PhotoStories('https://purr.objects-us-east-1.dream.io/i/img-20171124-wa0007.jpg'))->setAddToNews(false),

            (new Video('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4'))
                ->setName('Test Video')
                ->setIsPrivate(true)

        );

        array_walk($attachments, static fn($element) => assertIsString($element));
    }
}
