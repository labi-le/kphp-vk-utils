<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders\Attachments\AbstractAttachments;


use Astaroth\VkUtils\Contracts\IStories;


abstract class AbstractStories extends AbstractFile implements IStories
{
    /**
     * @param string $path
     * @see Trick for KPHP
     * AbstractPhoto constructor.
     */
    public function __construct(string $path)
    {
        parent::__construct($path);
    }

    protected bool $add_to_news = false;
    protected ?string $user_ids = null;
    protected ?string $reply_to_story = null;
    protected ?string $link_text = null;
    protected ?string $link_url = null;
    protected ?int $group_id = null;
    protected ?string $clickable_stickers = null;


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
    public function setUserIds(int ...$user_ids): AbstractStories
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

    public function getUploadParams(): array
    {
        return [
            "add_to_news" => $this->add_to_news,
            "user_ids" => $this->user_ids,
            "reply_to_story" => $this->reply_to_story,
            "link_text" => $this->link_text,
            "link_url" => $this->link_url,
            "group_id" => $this->group_id,
            "clickable_stickers" => $this->clickable_stickers,
        ];
    }

    public function getSaveParams(array $data): array
    {
        $params = array_merge([
            "upload_result" => null,
            "extended" => null,
            "fields" => null,
        ], $data);

        /** Trick */
        $params["upload_results"] = $params["upload_result"];

        return $params;
    }

    public function getSaveMethod(): string
    {
        return "stories.save";
    }

}