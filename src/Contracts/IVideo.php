<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Contracts;

use Astaroth\VkUtils\Uploading\Video;

/**
 * https://vk.com/dev/video.save
 * Interface IVideo
 * @package Astaroth\VkUtils\Contracts
 */
interface IVideo
{
    /**
     * Name of the video
     * @param string $name
     * @return $this
     */
    public function setName(string $name): Video;

    /**
     * Description of the video
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): Video;

    /**
     * To designate the video as private? (send it via a private message); the video will not appear on the user's video list and will not be available by ID for other users
     * @param bool $is_private
     * @return $this
     */
    public function setIsPrivate(bool $is_private): Video;

    /**
     * Post on the wall?
     * @param bool $wallpost
     * @return $this
     */
    public function setWallpost(bool $wallpost): Video;

    /**
     * URL for embedding the video from an external website
     * @param string $link
     * @return $this
     */
    public function setLink(string $link): Video;

    /**
     * ID of the community in which the video will be saved. By default, the current user's page
     * @param int $group_id
     * @return $this
     */
    public function setGroupId(int $group_id): Video;

    /**
     * ID of the album to which the saved video will be added
     * @param int $album_id
     * @return $this
     */
    public function setAlbumId(int $album_id): Video;

    /**
     * Privacy settings for watching videos in a special format
     * Available for videos that the user has uploaded to their profile
     * @param string $privacy_view
     * @return $this
     */
    public function setPrivacyView(string $privacy_view): Video;

    /**
     * Privacy settings for commenting videos in a special format
     * Available for videos that the user has uploaded to their profile
     * @param string $privacy_comment
     * @return $this
     */
    public function setPrivacyComment(string $privacy_comment): Video;

    /**
     * Disallow commenting?
     * @param bool $no_comments
     * @return $this
     */
    public function setNoComments(bool $no_comments): Video;

    /**
     * To loop the video or not?
     * @param bool $repeat
     * @return $this
     */
    public function setRepeat(bool $repeat): Video;

    /**
     * Compress video or not?
     * @param bool $compression
     * @return $this
     */
    public function setCompression(bool $compression): Video;


}