<?php
namespace App\Classes;

class File
{
    /**
     * Path to files.
     */
    const FILES_PATH = "files/";

    /**
     * Target file extension.
     */
    const TARGET_EXTENSION = ".pdf";

    /**
     * @var string
     */
    protected $name = "";

    /**
     * @var array
     */
    protected $codes = [];

    /**
     * @var int
     */
    protected $countCodes = 0;

    /**
     * Code generator instance.
     *
     * @var CodeGenerator
     */
    protected $codeGenerator = null;

    /**
     * Filename generator instace.
     *
     * @var FilenameGenerator
     */
    protected $filenameGenerator = null;

    /**
     * File constructor.
     *
     * @param $countCodes
     */
    public function __construct($countCodes)
    {
        $this->codeGenerator = new CodeGenerator();
        $this->filenameGenerator = new FilenameGenerator();
        $this->countCodes = $countCodes;
        $this->generateName();
        $this->generateCodes();
    }

    /**
     * Generate a unique filename.
     */
    private function generateName()
    {
        do {
            $this->name = $this->filenameGenerator->generate();
        }
        while(file_exists(self::FILES_PATH . $this->name));
    }

    /**
     * Generate unique codes.
     */
    private function generateCodes()
    {
        for ($i = 0; $i < $this->countCodes; ++$i) {
            $code = new Code($this->codeGenerator->generate());

            while (!$this->codeIsUnique($code)) {
                $code->setCode($this->codeGenerator->generate());
            }

            array_push($this->codes, $code);
        }
    }

    /**
     * Check if the code is unique.
     *
     * @param Code $code
     * @return bool
     */
    private function codeIsUnique($code)
    {
        /** @var Code $item */
        foreach ($this->getCodes() as $item) {
            if ($item->getCode() === $code->getCode()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getCodes()
    {
        return $this->codes;
    }

    /**
     * @return int
     */
    public function getCountCodes()
    {
        return $this->countCodes;
    }
}
