<?php

declare(strict_types=1);


namespace Astaroth\VkUtils;


use Astaroth\VkUtils\Contracts\IMessage;
use Astaroth\VkUtils\Contracts\IMessageBuilder;
use Astaroth\VkUtils\Traits\ParallelProcessingTrait;

use Throwable;

final class Messages extends Client implements IMessage
{
    use ParallelProcessingTrait;

    /**
     * @throws Throwable
     * @psalm-suppress UndefinedInterfaceMethod
     */
    public function create(IMessageBuilder ...$message): array
    {
        $callable = function ($IMessageBuilder) {
            return current($this->request('messages.send',
                [
                    'user_ids' => $IMessageBuilder->getUserIds() ? implode(',', $IMessageBuilder->getUserIds()) : null,
                    'random_id' => random_int(PHP_INT_MIN, PHP_INT_MAX),
                    'peer_ids' => $IMessageBuilder->getPeerIds() ? implode(',', $IMessageBuilder->getPeerIds()) : null,
                    'domain' => $IMessageBuilder->getDomain(),
                    'chat_id' => $IMessageBuilder->getChatId(),
                    'message' => $IMessageBuilder->getMessage(),
                    'lat' => $IMessageBuilder->getLat(),
                    'long' => $IMessageBuilder->getLong(),
                    'attachment' => $IMessageBuilder->getAttachment() ? implode(',', $IMessageBuilder->getAttachment()) : null,
                    'reply_to' => $IMessageBuilder->getReplyTo(),
                    'forward_messages' => $IMessageBuilder->getForwardMessages(),
                    'sticker_id' => $IMessageBuilder->getStickerId(),
                    'keyboard' => $IMessageBuilder->getKeyboard(),
                    'payload' => $IMessageBuilder->getPayload(),
                    'dont_parse_links' => $IMessageBuilder->isDontParseLinks(),
                    'disable_mentions' => $IMessageBuilder->isDisableMentions(),
                ]));
        };

        return self::isParallelUpload()
            ? $this->parallelRequest($callable, $message)
            : $this->nonParallelRequest($callable, $message);
    }
}