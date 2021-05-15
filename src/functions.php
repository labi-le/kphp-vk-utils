<?php

declare(strict_types=1);

if (!function_exists('tmpfile_ext')) {
    /**
     * VK does not allow uploading images without extensions, and this crutch solves the problem ...
     * @param string $path_file
     * @return string|false
     */
    function tmpfile_ext(string $path_file): string|false
    {
        $tmp_file = stream_get_meta_data(tmpfile());
        $raw_file = $tmp_file['uri'];

        if (copy($path_file, $raw_file)) {
            $extension = explode('/', mime_content_type($raw_file))[1];
            $file = $raw_file . '.' . $extension;
            rename($raw_file, $file);

            register_shutdown_function(static function () use ($file) {
                unlink($file);
            });

            return $file;
        }

        return false;
    }
}