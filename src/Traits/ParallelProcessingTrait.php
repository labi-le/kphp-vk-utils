<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Traits;


use Spatie\Fork\Fork;

trait ParallelProcessingTrait
{

    /**
     * Download attachments in parallel?
     *
     * user token - 3 call\sec
     * group token - 20 call\sec
     * execute - 25 call in one request
     * https://vk.com/dev/api_requests
     *
     * if 0 - parallel requests is off
     */
    private int $number_of_parallel_requests = 0;

    public function setNumberOfParallelRequests(int $parallel_request): static
    {
        $this->number_of_parallel_requests = $parallel_request;
        return $this;
    }

    public function isEnabledParallelRequests(): bool
    {
        return (bool)$this->getNumberOfParallelRequests();
    }


    /**
     * @return int
     */
    public function getNumberOfParallelRequests(): int
    {
        return $this->number_of_parallel_requests;
    }

    /**
     * Magic
     * @param callable $callable
     * @param mixed ...$instances
     * @return array
     */
    protected function parallelRequest(callable $callable, ...$instances): array
    {
        return Fork::new()
            ->concurrent($this->getNumberOfParallelRequests())
            ->run(...array_map(static fn($instance) => static fn() => $callable($instance), ...$instances));
    }

    /**
     * @param callable $callable
     * @param array $instances
     * @return array
     */
    protected function nonParallelRequest(callable $callable, array $instances): array
    {
        return array_map(static function ($instance) use ($callable) {
            return $callable($instance);
        }, $instances);
    }
}