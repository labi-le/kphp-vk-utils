<?php

declare(strict_types=1);


use Astaroth\VkUtils\Builders\MessageBuilder;
use Astaroth\VkUtils\Message;
use Astaroth\VkUtils\Uploading\MessagesUploader;
use Astaroth\VkUtils\Uploading\Objects\Photo;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertNotNull;

class MessageTest extends TestCase
{

    private const ACCESS_TOKEN = "";

    private Message $message;
    private MessagesUploader $uploader;

    protected function setUp(): void
    {
        $this->message = new Message();
        $this->message->setDefaultToken(self::ACCESS_TOKEN);

        $this->uploader = new MessagesUploader();
        $this->uploader->setDefaultToken(self::ACCESS_TOKEN);

        $this->uploader->setNumberOfParallelRequests(3);
    }

    /**
     * @throws Throwable
     */
    public function testCreate(): void
    {
        function cat(): string
        {
            return json_decode(file_get_contents('https://aws.random.cat/meow'), true, 512, JSON_THROW_ON_ERROR)['file'];
        }

        $cats = static fn() => array_map(static fn() => cat(), range(0, 10));

        $range = range(0, 2);
        $message = $this->message->create
        (
            ...array_map(function () use ($cats) {
                return (new MessageBuilder())
                    ->setPeerId(360220190)
                    ->setAttachment(...$this->uploader
                        ->upload(
                            ...array_map(static fn($cat) => new Photo($cat), $cats())
                        ));
            },$range)
        );

        array_walk_recursive($message, static fn($element) => assertNotNull($message));
    }
}
