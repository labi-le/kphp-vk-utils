<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Uploading;


use Astaroth\VkUtils\Contracts\IStories;
use Astaroth\VkUtils\Traits\AttachmentsUploadTrait;

abstract class AbstractStories implements IStories
{
    use AttachmentsUploadTrait;

    protected bool $add_to_news = false;
    protected ?string $user_ids = null;
    protected ?string $reply_to_story = null;
    protected ?string $link_text = null;
    protected ?string $link_url = null;
    protected ?int $group_id = null;
    protected ?string $clickable_stickers = null;

    protected string $type_story;

    /**
     * @return bool
     */
    public function isAddToNews(): bool
    {
        return $this->add_to_news;
    }

    /**
     * @return string|null
     */
    public function getUserIds(): ?string
    {
        return $this->user_ids;
    }

    /**
     * @return string|null
     */
    public function getReplyToStory(): ?string
    {
        return $this->reply_to_story;
    }

    /**
     * @return string|null
     */
    public function getLinkText(): ?string
    {
        return $this->link_text;
    }

    /**
     * @return string|null
     */
    public function getLinkUrl(): ?string
    {
        return $this->link_url;
    }

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->group_id;
    }
    /**
     * @return string|null
     */
    public function getClickableStickers(): ?string
    {
        return $this->clickable_stickers;
    }

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

    public function getTypeStore(): string
    {
        return $this->type_story;
    }
}