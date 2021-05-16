<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders;


use Astaroth\VkUtils\Contracts\IPostBuilder;

final class PostBuilder implements IPostBuilder
{
    public ?int $owner_id = null;
    public bool $friends_only = false;
    public bool $from_group = false;

    public ?string $message = null;
    public ?array $attachments = null;
    public ?string $services = null;
    public ?string $signed = null;

    public ?int $publish_date = null;
    public ?float $lat = null;

    public ?float $long = null;
    public ?int $place_id = null;

    public ?int $post_id = null;
    public ?string $guid = null;

    public bool $mark_as_ads = false;
    public bool $close_comments = false;
    public ?int $donut_paid_duration = null;

    public bool $mute_notifications = false;

    public ?string $copyright = null;


    /**
     * @inheritDoc
     */
    public function setOwnerId(int $owner_id): PostBuilder
    {
        $this->owner_id = $owner_id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setFriendsOnly(bool $friends_only): PostBuilder
    {
        $this->friends_only = $friends_only;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setFromGroup(bool $from_group): PostBuilder
    {
        $this->from_group = $from_group;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setMessage(?string $message): PostBuilder
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setAttachments(...$attachments): PostBuilder
    {
        $this->attachments = $attachments;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setServices(string $services): PostBuilder
    {
        $this->services = $services;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setSigned(string $signed): PostBuilder
    {
        $this->signed = $signed;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPublishDate(int $publish_date): PostBuilder
    {
        $this->publish_date = $publish_date;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLat(float $lat): PostBuilder
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLong(float $long): PostBuilder
    {
        $this->long = $long;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPlaceId(int $place_id): PostBuilder
    {
        $this->place_id = $place_id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPostId(int $post_id): PostBuilder
    {
        $this->post_id = $post_id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setGuid(string $guid): PostBuilder
    {
        $this->guid = $guid;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setMarkAsAds(bool $mark_as_ads): PostBuilder
    {
        $this->mark_as_ads = $mark_as_ads;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCloseComments(bool $close_comments): PostBuilder
    {
        $this->close_comments = $close_comments;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDonutPaidDuration(int $donut_paid_duration): PostBuilder
    {
        $this->donut_paid_duration = $donut_paid_duration;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setMuteNotifications(bool $mute_notifications): PostBuilder
    {
        $this->mute_notifications = $mute_notifications;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setCopyright(string $copyright): PostBuilder
    {
        $this->copyright = $copyright;
        return $this;
    }

}