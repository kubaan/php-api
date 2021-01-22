<?php
namespace App\Classes;


class Code
{
    /**
     * @var string
     */
    protected $code = "";

    /**
     * Code constructor.
     *
     * @param $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getCode() . "<br />";
    }
}
