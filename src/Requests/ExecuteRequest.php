<?php


namespace Astaroth\VkUtils\Requests;

use Astaroth\VkUtils\Contracts\IScriptable;
use InvalidArgumentException;

/**
 * Class ExecuteRequest
 * @package Astaroth\VkUtils\Requests
 */
class ExecuteRequest extends Request
{
    /**
     * ExecuteRequest constructor.
     *
     * @param array $parameters
     * @param null|string $token
     */
    public function __construct(array $parameters, $token = null)
    {
        parent::__construct('execute', $parameters, $token);
    }

    /**
     * @param IScriptable[] $requests
     */
    public static function make(array $requests, ?string $token = null): static
    {
        $scripts = array_map(static function ($request): string {
            if (!$request instanceof IScriptable) {
                throw new InvalidArgumentException(
                    'Argument must be an array instances of ' . IScriptable::class
                );
            }

            return $request->toScript();
        }, $requests);

        $parameters['code'] = sprintf('return [%s];', implode(', ', $scripts));

        return new static($parameters, $token);
    }
}
