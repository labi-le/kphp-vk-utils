<?php

declare(strict_types=1);


use Astaroth\VkUtils\Builders\MessageBuilder;
use Astaroth\VkUtils\Message;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertNotNull;

class MessageTest extends TestCase
{

    private Message $message;

    protected function setUp(): void
    {
        $this->message = new Message();
        $this->message->setDefaultToken('');
    }

    /**
     * @throws Throwable
     */
    public function testCreate(): void
    {
        $message = $this->message->create
        (
            (new MessageBuilder())
                ->setUserId(259166248)
                ->setMessage('hi i am running a test')
                ->setAttachment('photo-33798093_457440878')
                ->setLat(60.04884218508145)
                ->setLong(30.44217421912819)
        );

        array_walk_recursive($message, static fn($element) => assertNotNull($message));
    }
}
