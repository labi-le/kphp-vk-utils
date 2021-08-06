<?php


namespace Astaroth\VkUtils\Tricks;

/**
 * Class RequestTricks
 * File upload tricks, etc.
 * @package Astaroth\VkUtils\Tricks
 */
class RequestTricks
{
    /**
     * For safe multipart POST request for PHP5.3 ~ PHP 5.4.
     *
     * @see https://www.php.net/manual/ru/class.curlfile.php#115161
     * @param mixed $ch
     * @param string[] $files
     * @return void
     */
    public static function curl_custom_postfields($ch, array $files = []): void
    {
        // invalid characters for "name" and "filename"
        static $disallow = ["\0", "\"", "\r", "\n"];

        $body = [];
        /**
         * @var string $k
         * @var string $v
         */
        foreach ($files as $k => $v) {
            $data = file_get_contents($v);

            $k = str_replace($disallow, "_", $k);
            $clear_invalid_character = str_replace($disallow, "_", $v);

            $body[] = implode("\r\n", [
                "Content-Disposition: form-data; name=" . $k . "; filename=" . $clear_invalid_character,
                "Content-Type: application/octet-stream",
                "",
                $data,
            ]);
        }

        $boundary = "---------------------" . hash('sha256', uniqid('', true));

        foreach ($body as &$part) {
            $part = "--$boundary\r\n$part";
        }

        // add final boundary
        $body[] = "--$boundary--";
        $body[] = "";

        // set options
        @curl_setopt_array($ch, array(
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => implode("\r\n", $body),
            CURLOPT_HTTPHEADER => array(
                "Expect: 100-continue",
                "Content-Type: multipart/form-data; boundary=$boundary", // change Content-Type
            ),
        ));
    }
}