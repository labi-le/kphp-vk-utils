<?php

declare(strict_types=1);


namespace Astaroth\VkUtils;


use Astaroth\VkUtils\Builders\Builder;
use Astaroth\VkUtils\Contracts\IMessageBuilder;
use Astaroth\VkUtils\Traits\ParallelProcessingTrait;
use Throwable;

final class Message extends Builder
{
    use ParallelProcessingTrait;

    /**
     * @throws Throwable
     */
    public function create(IMessageBuilder ...$message): array
    {
        $callable = function ($message) {
            return current($this->request('messages.send',
                get_object_vars($message) +
                ['random_id' => random_int(PHP_INT_MIN, PHP_INT_MAX)]));
        };

        return $this->isEnabledParallelRequests()
            ? $this->parallelRequest($callable, $message)
            : $this->nonParallelRequest($callable, $message);
    }
}