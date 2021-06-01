<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading\Methods;

use Astaroth\VkUtils\Uploading\Objects\Abstract\AbstractSaveFile;

/**
 * Class StoriesSave
 * @package Astaroth\VkUtils\Uploading\Methods
 */
class StoriesSave extends AbstractSaveFile
{
    public string $upload_result;

    /**
     * save param for multiply story
     * @var string
     */
    public string $upload_results;


    public bool $extended = false;
    public ?string $fields = null;

    public function getMethod(): string
    {
        return "stories.save";
    }
}