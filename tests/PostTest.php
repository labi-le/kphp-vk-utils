<?php

declare(strict_types=1);


use Astaroth\VkUtils\Builders\PostBuilder;
use Astaroth\VkUtils\Post;
use Astaroth\VkUtils\Uploading\Objects\Doc;
use Astaroth\VkUtils\Uploading\Objects\Photo;
use Astaroth\VkUtils\Uploading\Objects\Video;
use Astaroth\VkUtils\Uploading\WallUploader;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertIsString;

class PostTest extends TestCase
{
    private const ACCESS_TOKEN = "";

    private Post $post;
    private WallUploader $uploader;

    protected function setUp(): void
    {
        $this->post = new Post();
        $this->post->setDefaultToken(self::ACCESS_TOKEN);

        $this->uploader = new WallUploader();
        $this->uploader->setDefaultToken(self::ACCESS_TOKEN);

        $this->post->setNumberOfParallelRequests(2);
        $this->uploader->setNumberOfParallelRequests(2);
    }


    public function testCreate(): void
    {
        $post = $this->post->create
        (
            (new PostBuilder())
                ->setMessage('never gonna give up')
                ->setAttachments('photo-200765156_457240211', 'photo-200765156_457240199', 'photo-200765156_457240196')
                ->setLat(60.04884218508145)
                ->setLong(30.44217421912819)
                ->setCopyright('https://www.youtube.com/watch?v=dQw4w9WgXcQ'),

            (new PostBuilder())
                ->setMessage('uwu')
                ->setAttachments(...$this->uploader
                    ->upload(
                        new Doc('https://images.dog.ceo/breeds/newfoundland/n02111277_11806.jpg'),
                        new Photo('https://images.dog.ceo/breeds/dane-great/n02109047_31049.jpg'),

                        (new Video('https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerMeltdowns.mp4'))
                            ->setName('Test Video')
                            ->setIsPrivate(true)
                    ))
                ->setLat(61.04884218508145)
                ->setLong(32.44217421912819)
                ->setCopyright('https://www.youtube.com/watch?v=dQw4w9WgXcQ')
        );

        array_walk_recursive($post, static fn($element) => assertIsString($element));
    }
}
