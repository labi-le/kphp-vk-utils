<?php


namespace Astaroth\VkUtils\Contracts;


use Astaroth\VkUtils\Exceptions\VkException;
use Astaroth\VkUtils\Requests\Request;

interface IExecute
{
    /**
     * @param Request[] $request
     * @return array
     * @throws VkException
     */
    public function send(array $request): array;
}