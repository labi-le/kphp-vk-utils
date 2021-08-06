<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Contracts;


/**
 * https://vk.com/dev/stories.getVideoUploadServer
 * Interface IStories
 * @package Astaroth\VkUtils\Contracts
 */
interface IStories
{
    /**
     * Add story to news
     * @param bool $add_to_news
     * @return static
     */
    public function setAddToNews(bool $add_to_news);

    /**
     * User IDs who can see the story
     * @param int ...$user_ids
     * @return static
     */
    public function setUserIds(int ...$user_ids);

    /**
     * ID of the story to reply with the current
     * @param string $reply_to_story
     * @return static
     */
    public function setReplyToStory(string $reply_to_story);

    /**
     * Link text to navigate from story (only for community stories). Possible values:
     *
     * to_store - "To the store"
     * voting - "Vote"
     * more details - "More"
     * book - "Book"
     * order - "Order"
     * sign up - "Sign up"
     * fill - "Fill in"
     * registration - "Register"
     * buy - "Buy"
     * ticket - "Buy a ticket"
     * write - "Write"
     * open - "Open"
     * learn_more - "More details" (default)
     * view - "View"
     * go_to - "Go"
     * contact - "Contact"
     * watch - "Watch"
     * play - "Listen"
     * install - "Install"
     * read - "Read"
     * game - "Play"
     * @param string $link_text
     * @return static
     */
    public function setLinkText(string $link_text);

    /**
     * Link address for going from history
     * @param string $link_url
     * @return static
     */
    public function setLinkUrl(string $link_url);

    /**
     * ID of the community to upload the story (should be verified or with the "fire" icon)
     * @param int $group_id
     * @return static
     */
    public function setGroupId(int $group_id);

    /**
     * https://vk.com/dev//objects/clickable_stickers
     * @param string $clickable_stickers
     * @return static
     */
    public function setClickableStickers(string $clickable_stickers);

}