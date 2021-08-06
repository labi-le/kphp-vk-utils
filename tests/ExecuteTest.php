<?php


use Astaroth\VkUtils\Execute;
use Astaroth\VkUtils\Requests\Request;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertIsArray;


class ExecuteTest extends TestCase
{
    private const ACCESS_TOKEN = "";
    private Execute $execute;

    protected function setUp(): void
    {
        $this->execute = new Execute(self::ACCESS_TOKEN);
    }

    public function testSend(): void
    {
        $requests = [
            new Request("users.get", []),
            new Request("friends.get", []),
            new Request("groups.get", [])];

        $response = $this->execute->send($requests);

        assertIsArray($response);
    }
}
