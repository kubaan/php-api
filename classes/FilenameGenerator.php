<?php


namespace App\Classes;


class FilenameGenerator implements GeneratorInterface
{
    /**
     * Chars from which file name can be generated.
     */
    const CHARS = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    /**
     * Number of file name chars.
     */
    const LENGTH = 12;

    public function generate()
    {
        return substr(str_shuffle(self::CHARS), 0, self::LENGTH);
    }
}