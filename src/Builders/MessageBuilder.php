<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders;


use Astaroth\VkUtils\Contracts\IMessageBuilder;

final class MessageBuilder implements IMessageBuilder
{

    public ?string $user_ids = null;
    public ?string $peer_ids = null;
    public ?string $domain = null;
    public ?int $chat_id = null;
    public ?string $message = null;

    public ?float $lat = null;
    public ?float $long = null;

    public ?string $attachment = null;
    public ?int $reply_to = null;
    public ?string $forward_messages = null;
    public ?int $sticker_id = null;
    public ?string $keyboard = null;
    public ?string $payload = null;

    public bool $dont_parse_links = false;
    public bool $disable_mentions = false;


    /**
     * @inheritDoc
     */
    public function setUserId(int ...$user_ids): MessageBuilder
    {
        $this->user_ids = implode(',', $user_ids);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPeerId(int ...$peer_ids): MessageBuilder
    {
        $this->peer_ids = implode(',', $peer_ids);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDomain(string $domain): MessageBuilder
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setChatId(int $chat_id): MessageBuilder
    {
        $this->chat_id = $chat_id;
        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setMessage(string $message): MessageBuilder
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLat(float $lat): MessageBuilder
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLong(float $long): MessageBuilder
    {
        $this->long = $long;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setAttachment(string ...$attachment): MessageBuilder
    {
        $this->attachment = implode(',', $attachment);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setReplyTo(int $reply_to): MessageBuilder
    {
        $this->reply_to = $reply_to;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setForwardMessages(int ...$forward_messages): MessageBuilder
    {
        $this->forward_messages = implode(',', $forward_messages);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setStickerId(int $sticker_id): MessageBuilder
    {
        $this->sticker_id = $sticker_id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setKeyboard(string $keyboard): MessageBuilder
    {
        $this->keyboard = $keyboard;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPayload(string $payload): MessageBuilder
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDontParseLinks(bool $dont_parse_links): MessageBuilder
    {
        $this->dont_parse_links = $dont_parse_links;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDisableMentions(bool $disable_mentions): MessageBuilder
    {
        $this->disable_mentions = $disable_mentions;
        return $this;
    }
}