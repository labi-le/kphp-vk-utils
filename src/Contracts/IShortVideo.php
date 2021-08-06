<?php

namespace Astaroth\VkUtils\Contracts;

interface IShortVideo
{
    /**
     * @param bool $wallpost
     * @return static
     */
    public function setWallpost(bool $wallpost);

    /**
     * @param bool $can_make_duet
     * @return static
     */
    public function setCanMakeDuet(bool $can_make_duet);

    /**
     * @param string $description
     * @return static
     */
    public function setDescription(string $description);

    /**
     * @param string $device_id
     * @return static
     */
    public function setDeviceId(string $device_id);
}