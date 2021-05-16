<?php

declare(strict_types=1);


use Astaroth\VkUtils\Uploader;
use Astaroth\VkUtils\Uploading\AudioMessage;
use Astaroth\VkUtils\Uploading\Doc;
use Astaroth\VkUtils\Uploading\Graffiti;
use Astaroth\VkUtils\Uploading\Photo;
use Astaroth\VkUtils\Uploading\Video;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertIsString;

class UploaderTest extends TestCase
{

    private Uploader $uploader;

    protected function setUp(): void
    {
        $this->uploader = new Uploader();
        $this->uploader->setDefaultToken('');
    }

    public function testUpload(): void
    {
        $attachments = $this->uploader->upload(
            new Doc('https://images.dog.ceo/breeds/newfoundland/n02111277_11806.jpg'),
            new AudioMessage('https://psv4.userapi.com/c505636//u259166248/audiomsg/d47/6a42fe5ebc.mp3'),
            new Graffiti('https://upload.wikimedia.org/wikipedia/commons/5/59/Empty.png'),
            new Photo('https://images.dog.ceo/breeds/dane-great/n02109047_31049.jpg'),

            (new Video('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4'))
                ->setName('Test Video')
                ->setIsPrivate(true)

        );

        array_walk($attachments, fn($element) => assertIsString($element));
    }
}
