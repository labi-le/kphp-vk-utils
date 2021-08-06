<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Builders;


use Astaroth\VkUtils\Contracts\IBuilder;
use Astaroth\VkUtils\Contracts\IMessageBuilder;

final class Message implements IMessageBuilder, IBuilder
{
    private ?string $user_ids = null;
    private ?string $peer_ids = null;
    private ?string $domain = null;
    private ?int $chat_id = null;
    private ?string $message = null;

    private ?float $lat = null;
    private ?float $long = null;

    private ?string $attachment = null;
    private ?int $reply_to = null;
    private ?string $forward_messages = null;
    private ?int $sticker_id = null;
    private ?string $keyboard = null;
    private ?string $payload = null;

    private bool $dont_parse_links = false;
    private bool $disable_mentions = false;
    private ?int $expire_ttl = null;


    /**
     * @inheritDoc
     */
    public function setUserId(int ...$user_ids): Message
    {
        $this->user_ids = implode(',', $user_ids);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPeerId(int ...$peer_ids): Message
    {
        $this->peer_ids = implode(',', $peer_ids);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDomain(string $domain): Message
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setChatId(int $chat_id): Message
    {
        $this->chat_id = $chat_id;
        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setMessage(string $message): Message
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLat(float $lat): Message
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLong(float $long): Message
    {
        $this->long = $long;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setAttachment(string ...$attachments): Message
    {
        $this->attachment = implode(',', $attachments);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setReplyTo(int $reply_to): Message
    {
        $this->reply_to = $reply_to;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setForwardMessages(int ...$forward_messages): Message
    {
        $this->forward_messages = implode(',', $forward_messages);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setStickerId(int $sticker_id): Message
    {
        $this->sticker_id = $sticker_id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setKeyboard(string $keyboard): Message
    {
        $this->keyboard = $keyboard;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPayload(string $payload): Message
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDontParseLinks(bool $dont_parse_links): Message
    {
        $this->dont_parse_links = $dont_parse_links;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDisableMentions(bool $disable_mentions): Message
    {
        $this->disable_mentions = $disable_mentions;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setExpireTtl(int $expire_ttl): Message
    {
        $this->expire_ttl = $expire_ttl;
        return $this;
    }

    public function getParams(): array
    {
        return
            [
                "user_ids" => $this->user_ids,
                "peer_ids" => $this->peer_ids,
                "domain" => $this->domain,
                "chat_id" => $this->chat_id,
                "message" => $this->message,
                "lat" => $this->lat,
                "long" => $this->long,
                "attachment" => $this->attachment,
                "reply_to" => $this->reply_to,
                "forward_messages" => $this->forward_messages,
                "sticker_id" => $this->sticker_id,
                "keyboard" => $this->keyboard,
                "payload" => $this->payload,
                "dont_parse_links" => $this->dont_parse_links,
                "disable_mentions" => $this->disable_mentions,
                "expire_ttl" => $this->expire_ttl,

                'random_id' => rand()
            ];
    }

    public function getMethod(): string
    {
        return "messages.send";
    }
}