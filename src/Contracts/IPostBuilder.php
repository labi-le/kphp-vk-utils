<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Contracts;


use Astaroth\VkUtils\Builders\Post;

interface IPostBuilder
{
    /**
     * User ID or community ID. Use a negative value to designate a community ID
     * @param int $owner_id
     * @return Post
     */
    public function setOwnerId(int $owner_id): Post;

    /**
     * Post will be available to friends only?
     * @param bool $friends_only
     * @return Post
     */
    public function setFriendsOnly(bool $friends_only): Post;

    /**
     * For a community:
     * Post will be published by the community?
     * @param bool $from_group
     * @return Post
     */
    public function setFromGroup(bool $from_group): Post;

    /**
     * (Required if attachments is not set.) Text of the post.
     * @param string|null $message
     * @return Post
     */
    public function setMessage(?string $message): Post;

    /**
     * (Required if message is not set.) List of objects attached to the post, in the following format:
     *
     * <type><owner_id>_<media_id>,<type><owner_id>_<media_id>
     *
     * @param string ...$attachments
     * @return Post
     */
    public function setAttachments(string ...$attachments): Post;

    /**
     * List of services or websites the update will be exported to, if the user has so requested. Sample values: twitter, facebook
     * @param string $services
     * @return Post
     */
    public function setServices(string $services): Post;

    /**
     * Only for posts in communities with from_group set to
     * Post will be signed with the name of the posting user?
     * @param string $signed
     * @return Post
     */
    public function setSigned(string $signed): Post;

    /**
     * Publication date (in Unix time). If used, posting will be delayed until the set time
     * @param int $publish_date
     * @return Post
     */
    public function setPublishDate(int $publish_date): Post;

    /**
     * Geographical latitude of a check-in, in degrees (from -90 to 90).
     * @param float $lat
     * @return Post
     */
    public function setLat(float $lat): Post;

    /**
     * Geographical longitude of a check-in, in degrees (from -180 to 180).
     * @param float $long
     * @return Post
     */
    public function setLong(float $long): Post;

    /**
     * ID of the location where the user was tagged
     * @param int $place_id
     * @return Post
     */
    public function setPlaceId(int $place_id): Post;

    /**
     * Post ID. Used for publishing of scheduled and suggested posts
     * @param int $post_id
     * @return Post
     */
    public function setPostId(int $post_id): Post;

    /**
     * An identifier designed to prevent the repeated sending of the same record
     * Valid for one hour
     * @param string $guid
     * @return Post
     */
    public function setGuid(string $guid): Post;

    /**
     * Mark as ad post?
     * @param bool $mark_as_ads
     * @return Post
     */
    public function setMarkAsAds(bool $mark_as_ads): Post;

    /**
     * Close comments?
     * @param bool $close_comments
     * @return Post
     */
    public function setCloseComments(bool $close_comments): Post;

    /**
     * The period of time during which the recording will be available for dons - paid subscribers of VK Donut. Possible values:
     * -1 - exclusively for dons
     * 86400 - for 1 day
     * 172800 - for 2 days
     * 172800 - for 3 days
     * 345600 - for 4 days
     * 432,000 - for 5 days
     * 518400 - for 6 days
     * 604800 - for 7 days
     * @param int $donut_paid_duration
     * @return Post
     */
    public function setDonutPaidDuration(int $donut_paid_duration): Post;

    /**
     * Publish notifications?
     * @param bool $mute_notifications
     * @return Post
     */
    public function setMuteNotifications(bool $mute_notifications): Post;

    /**
     * Source of material. External and internal links are supported
     * @param string $copyright
     * @return Post
     */
    public function setCopyright(string $copyright): Post;

}