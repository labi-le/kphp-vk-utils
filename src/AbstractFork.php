<?php


namespace Astaroth\VkUtils;


abstract class AbstractFork extends Client
{

    /**
     * user token - 3 call\sec
     * group token - 20 call\sec
     * execute - 25 call in one request
     * https://vk.com/dev/api_requests
     *
     * if false - parallel requests is off
     */
    private bool $fork = false;

    /**
     * Enable for
     * It's very fast
     *
     * @return static
     */
    public function enableFork()
    {
        $this->fork = true;
        return $this;
    }

    /**
     * Get status parallel
     * @return bool
     */
    public function statusFork(): bool
    {
        return $this->fork;
    }

    /**
     * Fork tasks
     * @see https://vkcom.github.io/kphp/kphp-language/best-practices/async-programming-forks.html
     * @param callable $callable
     * @param object ...$instances
     * @return array
     */
    protected function parallelRequest(callable $callable, object ...$instances): array
    {
//        $callable_result = [];
//
//        $fork_ids = [];
//        // it doesn’t work like that, and I don’t know why
//        foreach ($instances as $instance) {
//            $fork_ids[] = fork($callable($instance));
//        }
//
//        $queue = wait_queue_create($fork_ids);
//        while (!wait_queue_empty($queue)) {
//            $ready_fork_id = wait_queue_next($queue);
//            $callable_result[] = wait($ready_fork_id);
//        }
//
//        return $callable_result;

        return wait_multi(array_map(static function ($instance) use ($callable) {
            return fork($callable($instance));
        }, $instances));
    }

    /**
     * @param callable $callable
     * @param object ...$instances
     * @return mixed[]
     */
    protected function nonParallelRequest(callable $callable, object...$instances): array
    {
        return array_map(static function ($instance) use ($callable) {
            return $callable($instance);
        }, $instances);
    }
}