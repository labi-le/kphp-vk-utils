<?php

declare(strict_types=1);


use Astaroth\VkUtils\Builders\PostBuilder;
use Astaroth\VkUtils\Post;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertIsInt;

class PostTest extends TestCase
{

    private Post $post;

    protected function setUp(): void
    {
        $this->post = new Post();
        $this->post->setDefaultToken('');

        $this->post->setNumberOfParallelRequests(10);
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
                ->setCopyright('https://www.youtube.com/watch?v=dQw4w9WgXcQ')
        );

        array_walk_recursive($post, static fn($element) => assertIsInt($element));
    }
}
