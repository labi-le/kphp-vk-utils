<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Traits;


trait ParallelProcessingTrait
{

    /**
     * Download attachments in parallel?
     *
     * user token - 3 call\sec
     * group token - 20 call\sec
     * execute - 25 call in one request
     * https://vk.com/dev/api_requests
     * @var bool
     */
    protected static bool $parallel_request = false;

    /**
     * Disable parallel uploading
     */
    public static function disableParallelRequest(): void
    {
        self::$parallel_request = false;
    }

    /**
     * Enable parallel uploading
     */
    public static function enableParallelRequest(): void
    {
        static::$parallel_request = true;
    }

    /**
     * @return bool
     */
    public static function isParallelUpload(): bool
    {
        return self::$parallel_request;
    }
}