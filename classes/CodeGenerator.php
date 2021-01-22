<?php


namespace App\Classes;


class CodeGenerator implements GeneratorInterface
{
    /**
     * Chars from which codes can be generated.
     */
    const CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    /**
     * Number of code chars.
     */
    const LENGTH = 2;

    /**
     * Generate code.
     * @return string
     */
    public function generate()
    {
        return substr(str_shuffle(self::CHARS), 0, self::LENGTH);
    }
}