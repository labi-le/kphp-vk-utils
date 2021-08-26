<?php


namespace Astaroth\VkUtils;

/**
 * Class ExceptionGenerator
 * @package Astaroth\VkUtils
 */
class ExceptionGenerator
{
    private string $message;
    private int $error_code;

    /**
     * @throws Exceptions\CaptchaRequiredVkException
     * @throws Exceptions\PermissionDeniedVkException
     * @throws Exceptions\UnknownErrorVkException
     * @throws Exceptions\VkException
     * @throws Exceptions\TooMuchSimilarVkException
     * @throws Exceptions\RuntimeException
     * @throws Exceptions\AuthorizationFailedVkException
     * @throws Exceptions\InternalErrorVkException
     * @throws Exceptions\AccessDeniedVkException
     * @throws Exceptions\TooManyRequestsVkException
     * @throws Exceptions\MissingOrInvalidExceptionParameters
     */
    public function throw(): void
    {
        switch ($this->error_code) {
            case 0:
                throw new Exceptions\VkException($this->message);
            case 1:
                throw new Exceptions\UnknownErrorVkException($this->message);
            case 5:
                throw new Exceptions\AuthorizationFailedVkException($this->message);
            case 6:
                throw new Exceptions\TooManyRequestsVkException($this->message);
            case 7:
                throw new Exceptions\PermissionDeniedVkException($this->message);
            case 9:
                throw new Exceptions\TooMuchSimilarVkException($this->message);
            case 10:
                throw new Exceptions\InternalErrorVkException($this->message);
            case 14:
                throw new Exceptions\CaptchaRequiredVkException($this->message);
            case 15:
                throw new Exceptions\AccessDeniedVkException($this->message);
            case Client::RuntimeException:
                throw new Exceptions\RuntimeException($this->message);
            case 100:
                throw new Exceptions\MissingOrInvalidExceptionParameters($this->message);

            default:
                throw new Exceptions\VkException($this->message);
        }
    }

    /**
     * @param int $code
     * @param string $message
     */
    public function __construct(int $code, string $message)
    {
        $this->error_code = $code;
        $this->message = $message;
    }
}