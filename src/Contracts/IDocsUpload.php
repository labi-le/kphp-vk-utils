<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Contracts;


interface IDocsUpload
{
    /**
     * @param string $title
     * @return static
     */
    public function setTitle(string $title): static;

    /**
     * @param string $tags
     * @return static
     */
    public function setTags(string $tags): static;

    /**
     * @param bool $return_tags
     * @return static
     */
    public function setReturnTags(bool $return_tags): static;

    /**
     * @param string $file
     * @return static
     */
    public function setFile(string $file): static;

    /**
     * @param int $peer_id
     * @return static
     */
    public function setPeerId(int $peer_id): static;

}