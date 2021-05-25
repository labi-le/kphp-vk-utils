<?php

declare(strict_types=1);


namespace Astaroth\VkUtils;


use Astaroth\VkUtils\Builders\Builder;
use Astaroth\VkUtils\Contracts\IPostBuilder;
use Astaroth\VkUtils\Traits\ParallelProcessingTrait;
use Throwable;

final class Post extends Builder
{
    use ParallelProcessingTrait;

    /**
     * @throws Throwable
     */
    public function create(IPostBuilder ...$post): array
    {
        $callable = function ($post) {
            $params = get_object_vars($post);
            $post_id = $this->request('wall.post', $params)['response']['post_id'];
            return sprintf('wall%s_%s', $params['owner_id'], $post_id);
        };

        return $this->isEnabledParallelRequests()
            ? $this->parallelRequest($callable, $post)
            : $this->nonParallelRequest($callable, $post);
    }
}