<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading\Objects\Abstract;


use Astaroth\VkUtils\Contracts\IStories;

abstract class AbstractStories extends AbstractFile implements IStories
{
    public bool $add_to_news = false;
    public ?string $user_ids = null;
    public ?string $reply_to_story = null;
    public ?string $link_text = null;
    public ?string $link_url = null;
    public ?int $group_id = null;
    public ?string $clickable_stickers = null;


    /**
     * @param bool $add_to_news
     * @return AbstractStories
     */
    public function setAddToNews(bool $add_to_news): AbstractStories
    {
        $this->add_to_news = $add_to_news;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setUserIds(...$user_ids): AbstractStories
    {
        $this->user_ids = implode(',', $user_ids);
        return $this;
    }

    /**
     * @param string $reply_to_story
     * @return AbstractStories
     */
    public function setReplyToStory(string $reply_to_story): AbstractStories
    {
        $this->reply_to_story = $reply_to_story;
        return $this;
    }

    /**
     * @param string $link_text
     * @return AbstractStories
     */
    public function setLinkText(string $link_text): AbstractStories
    {
        $this->link_text = $link_text;
        return $this;
    }

    /**
     * @param string $link_url
     * @return AbstractStories
     */
    public function setLinkUrl(string $link_url): AbstractStories
    {
        $this->link_url = $link_url;
        return $this;
    }

    /**
     * @param int $group_id
     * @return AbstractStories
     */
    public function setGroupId(int $group_id): AbstractStories
    {
        $this->group_id = $group_id;
        return $this;
    }

    /**
     * @param string $clickable_stickers
     * @return AbstractStories
     */
    public function setClickableStickers(string $clickable_stickers): AbstractStories
    {
        $this->clickable_stickers = $clickable_stickers;
        return $this;
    }

}