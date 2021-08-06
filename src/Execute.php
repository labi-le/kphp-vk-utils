<?php


namespace Astaroth\VkUtils;


use Astaroth\VkUtils\Contracts\IExecute;
use Astaroth\VkUtils\Contracts\IScriptable;
use Astaroth\VkUtils\Requests\ExecuteRequest;
use Astaroth\VkUtils\Requests\Request;

class Execute implements IExecute
{
    private string $access_token;

    public function __construct(string $access_token)
    {
        $this->access_token = $access_token;
    }

    public function send(array $request): array
    {
        $oneBigRequest = ExecuteRequest::make($request, $this->access_token);

        return (new Client())
            ->setDefaultToken($this->access_token)
            ->request(
                $oneBigRequest->getMethod(),
                $oneBigRequest->getParameters(),
                $oneBigRequest->getToken());
    }
}