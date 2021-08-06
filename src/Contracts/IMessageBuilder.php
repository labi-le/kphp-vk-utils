<?php

declare(strict_types=1);


namespace Astaroth\VkUtils\Contracts;

use Astaroth\VkUtils\Builders\Message;

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
     * @return static
     */
    public function setUserId(int ...$user_ids): Message;

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
     * @return static
     */
    public function setPeerId(int ...$peer_ids): Message;

    /**
     * User's short address (for example, labile.paranoid)
     * @param string $domain
     * @return static
     */
    public function setDomain(string $domain): Message;

    /**
     * ID of conversation the message will relate to
     * @param int $chat_id
     * @return static
     */
    public function setChatId(int $chat_id): Message;

    /**
     * (Required if attachments is not set.) Text of the message
     * @param string $message
     * @return static
     */
    public function setMessage(string $message): Message;

    /**
     * Geographical latitude of a check-in, in degrees (from -90 to 90)
     * @param float $lat
     * @return static
     */
    public function setLat(float $lat): Message;

    /**
     * Geographical longitude of a check-in, in degrees (from -180 to 180)
     * @param float $long
     * @return static
     */
    public function setLong(float $long): Message;

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
     * @return static
     */
    public function setAttachment(string ...$attachments): Message;

    /**
     * Id of replied message
     * @param int $reply_to
     * @return static
     */
    public function setReplyTo(int $reply_to): Message;

    /**
     * ID of forwarded messages, separated with a comma. Listed messages of the sender will be shown in the message body at the recipient's
     *
     * Example:
     * 123,431,544
     *
     * list of comma-separated numbers, the maximum number of elements allowed is 1000
     *
     * @param int ...$forward_messages
     * @return static
     */
    public function setForwardMessages(int ...$forward_messages): Message;

    /**
     * Sticker id
     * @param int $sticker_id
     * @return static
     */
    public function setStickerId(int $sticker_id): Message;

    /**
     * Keyboard object
     * https://vk.com/dev/bots_docs_3
     * @param string $keyboard
     * @return static
     */
    public function setKeyboard(string $keyboard): Message;

    /**
     * Payload of message
     * maximum length 1000
     * @param string $payload
     * @return static
     */
    public function setPayload(string $payload): Message;

    /**
     * Links will not attach snippet
     * @param bool $dont_parse_links
     * @return static
     */
    public function setDontParseLinks(bool $dont_parse_links): Message;

    /**
     * Mention of user will not generate notification for him
     * @param bool $disable_mentions
     * @return static
     */
    public function setDisableMentions(bool $disable_mentions): Message;

    /**
     * @param int $expire_ttl
     * @return static
     */
    public function setExpireTtl(int $expire_ttl): Message;

}