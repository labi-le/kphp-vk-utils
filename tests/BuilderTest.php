<?php

declare(strict_types=1);

use Astaroth\VkUtils\Builder;
use Astaroth\VkUtils\Builders\Message;
use Astaroth\VkUtils\Builders\Post;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertNotNull;

class BuilderTest extends TestCase
{

    private const ACCESS_TOKEN = "";

    private Builder $builder;

    protected function setUp(): void
    {
        $this->builder = new Builder();
        $this->builder->setDefaultToken(self::ACCESS_TOKEN);
    }

    /**
     * @throws Throwable
     */
    public function testCreate(): void
    {
        $assertData = $this->builder->create(
            (new Post())
                ->setMessage("wheel")
                ->setAttachments("photo418618_457244049"),

            (new Message())
                ->setMessage("hello")
                ->setPeerId(418618)
        );

        array_walk($assertData, static fn($element) => assertNotNull($element));
    }
}
