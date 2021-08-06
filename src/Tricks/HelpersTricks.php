<?php

namespace Astaroth\VkUtils\Tricks;

/**
 * Trick that implements support for helpers-functions
 */
class HelpersTricks
{
    /**
     * Get web file size
     * @param string $url
     * @return int
     */
    public static function filesize_web(string $url): int
    {
        $ch = curl_init($url);

        curl_setopt_array($ch,
            [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => true,
                CURLOPT_NOBODY => true,
            ]
        );
        curl_exec($ch);
        $size = (int)curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        curl_close($ch);

        if ($size === -1) {
            throw new \RuntimeException("Incorrect url");
        }

        return $size;
    }
}