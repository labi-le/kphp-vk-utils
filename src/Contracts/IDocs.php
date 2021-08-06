<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Contracts;


interface IDocs
{
    /**
     * @param string $title
     * @return static
     */
    public function setTitle(string $title);

    /**
     * @param string $tags
     * @return static
     */
    public function setTags(string $tags);

    /**
     * @param bool $return_tags
     * @return static
     */
    public function setReturnTags(bool $return_tags);


    /**
     * @param int $peer_id
     * @return static
     */
    public function setPeerId(int $peer_id);

}