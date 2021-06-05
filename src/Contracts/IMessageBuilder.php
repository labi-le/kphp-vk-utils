<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Contracts;

use Astaroth\VkUtils\Builders\MessageBuilder;

/**
 * Sends a message
 * https://vk.com/dev/messages.send
 *
 * Does not contain all parameters, because this is a terrible api
 *
 * Interface IMessageBuilder
 * @package Astaroth\VkUtils\Contracts
 */
interface IMessageBuilder
{

    /**
     * User ID
     * @param int ...$user_ids
     * @return MessageBuilder
     */
    public function setUserId(int ...$user_ids): MessageBuilder;

    /**
     * Destination ID.
     *
     * For user:
     * User ID, e.g. 12345.
     *
     * For chat:
     * 2000000000 + chat_id, e.g. 2000000001.
     *
     * For community:
     * - community ID, e.g. -12345.
     *
     * @param int ...$peer_ids
     * @return MessageBuilder
     */
    public function setPeerId(int ...$peer_ids): MessageBuilder;

    /**
     * User's short address (for example, labile.paranoid)
     * @param string $domain
     * @return MessageBuilder
     */
    public function setDomain(string $domain): MessageBuilder;

    /**
     * ID of conversation the message will relate to
     * @param int $chat_id
     * @return MessageBuilder
     */
    public function setChatId(int $chat_id): MessageBuilder;

    /**
     * (Required if attachments is not set.) Text of the message
     * @param string $message
     * @return MessageBuilder
     */
    public function setMessage(string $message): MessageBuilder;

    /**
     * Geographical latitude of a check-in, in degrees (from -90 to 90)
     * @param float $lat
     * @return MessageBuilder
     */
    public function setLat(float $lat): MessageBuilder;

    /**
     * Geographical longitude of a check-in, in degrees (from -180 to 180)
     * @param float $long
     * @return MessageBuilder
     */
    public function setLong(float $long): MessageBuilder;

    /**
     * NO MORE THAN 10 ATTACHMENTS
     *
     * (Required if message is not set.) List of objects attached to the message, separated by commas, in the following format:
     * <type><owner_id>_<media_id>
     * <type> — Type of media attachment:
     *
     * photo — photo;
     * video — video;
     * audio — audio;
     * doc — document;
     * wall — wall post;
     * market — market item.
     *
     * <owner_id> — ID of the media attachment owner
     * <media_id> — media attachment ID
     *
     * Example:
     * photo100172_166443618
     *
     * @param string ...$attachments
     * @return MessageBuilder
     */
    public function setAttachment(string ...$attachments): MessageBuilder;

    /**
     * Id of replied message
     * @param int $reply_to
     * @return MessageBuilder
     */
    public function setReplyTo(int $reply_to): MessageBuilder;

    /**
     * ID of forwarded messages, separated with a comma. Listed messages of the sender will be shown in the message body at the recipient's
     *
     * Example:
     * 123,431,544
     *
     * list of comma-separated numbers, the maximum number of elements allowed is 1000
     *
     * @param int ...$forward_messages
     * @return MessageBuilder
     */
    public function setForwardMessages(int ...$forward_messages): MessageBuilder;

    /**
     * Sticker id
     * @param int $sticker_id
     * @return MessageBuilder
     */
    public function setStickerId(int $sticker_id): MessageBuilder;

    /**
     * Keyboard object
     * https://vk.com/dev/bots_docs_3
     * @param string $keyboard
     * @return MessageBuilder
     */
    public function setKeyboard(string $keyboard): MessageBuilder;

    /**
     * Payload of message
     * maximum length 1000
     * @param string $payload
     * @return MessageBuilder
     */
    public function setPayload(string $payload): MessageBuilder;

    /**
     * Links will not attach snippet
     * @param bool $dont_parse_links
     * @return MessageBuilder
     */
    public function setDontParseLinks(bool $dont_parse_links): MessageBuilder;

    /**
     * Mention of user will not generate notification for him
     * @param bool $disable_mentions
     * @return MessageBuilder
     */
    public function setDisableMentions(bool $disable_mentions): MessageBuilder;

    /**
     * @param int $expire_ttl
     * @return MessageBuilder
     */
    public function setExpireTTl(int $expire_ttl): MessageBuilder;

}