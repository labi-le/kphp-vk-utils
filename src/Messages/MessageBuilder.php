<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Messages;


use Astaroth\VkUtils\Contracts\IMessageBuilder;

class MessageBuilder implements IMessageBuilder
{

    private ?array $user_ids = null;
    private ?array $peer_ids = null;
    private ?string $domain = null;
    private ?int $chat_id = null;
    private ?string $message = null;

    private ?float $lat = null;
    private ?float $long = null;

    private ?array $attachment = null;
    private ?int $reply_to = null;
    private ?array $forward_messages = null;
    private ?int $sticker_id = null;
    private ?string $keyboard = null;
    private ?string $payload = null;

    private bool $dont_parse_links = false;
    private bool $disable_mentions = false;


    /**
     * @inheritDoc
     */
    public function setUserId(int ...$user_ids): static
    {
        $this->user_ids = $user_ids;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPeerId(int ...$peer_ids): static
    {
        $this->peer_ids = $peer_ids;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDomain(string $domain): static
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setChatId(int $chat_id): static
    {
        $this->chat_id = $chat_id;
        return $this;

    }

    /**
     * @inheritDoc
     */
    public function setMessage(string $message): static
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLat(float $lat): static
    {
        $this->lat = $lat;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setLong(float $long): static
    {
        $this->long = $long;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setAttachment(string ...$attachment): static
    {
        $this->attachment = $attachment;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setReplyTo(int $reply_to): static
    {
        $this->reply_to = $reply_to;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setForwardMessages(int ...$forward_messages): static
    {
        $this->forward_messages = $forward_messages;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setStickerId(int $sticker_id): static
    {
        $this->sticker_id = $sticker_id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setKeyboard(string $keyboard): static
    {
        $this->keyboard = $keyboard;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setPayload(string $payload): static
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDontParseLinks(bool $dont_parse_links): static
    {
        $this->dont_parse_links = $dont_parse_links;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function setDisableMentions(bool $disable_mentions): static
    {
        $this->disable_mentions = $disable_mentions;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getUserIds(): ?array
    {
        return $this->user_ids;
    }

    /**
     * @return array|null
     */
    public function getPeerIds(): ?array
    {
        return $this->peer_ids;
    }

    /**
     * @param array|null $peer_ids
     */
    public function setPeerIds(?array $peer_ids): void
    {
        $this->peer_ids = $peer_ids;
    }

    /**
     * @return string|null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return int|null
     */
    public function getChatId(): ?int
    {
        return $this->chat_id;
    }

    /**
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @return float|null
     */
    public function getLong(): ?float
    {
        return $this->long;
    }

    /**
     * @return array|null
     */
    public function getAttachment(): ?array
    {
        return $this->attachment;
    }

    /**
     * @return int|null
     */
    public function getReplyTo(): ?int
    {
        return $this->reply_to;
    }

    /**
     * @return array|null
     */
    public function getForwardMessages(): ?array
    {
        return $this->forward_messages;
    }

    /**
     * @return int|null
     */
    public function getStickerId(): ?int
    {
        return $this->sticker_id;
    }

    /**
     * @return string|null
     */
    public function getKeyboard(): ?string
    {
        return $this->keyboard;
    }

    /**
     * @return string|null
     */
    public function getPayload(): ?string
    {
        return $this->payload;
    }

    /**
     * @return bool
     */
    public function isDontParseLinks(): bool
    {
        return $this->dont_parse_links;
    }

    /**
     * @return bool
     */
    public function isDisableMentions(): bool
    {
        return $this->disable_mentions;
    }
}