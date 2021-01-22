<?php
namespace App\Classes;

use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class Pdf
{
    /**
     * Password to unlock access to PDF generated file.
     */
    const PDF_FILE_PASSWORD = "IntellectPL!";

    /**
     * File to convert to PDF.
     *
     * @var File
     */
    protected $file = null;

    /**
     * PDF library.
     *
     * @var Mpdf
     */
    protected $pdfGenerator = null;

    /**
     * Pdf constructor.
     *
     * @param $file
     * @throws \Mpdf\MpdfException
     */
    public function __construct($file)
    {
        $this->file = $file;
        $this->pdfGenerator = new Mpdf();
        $this->generatePdf();
    }

    /**
     * Generate PDF file.
     *
     * @throws \Mpdf\MpdfException
     */
    public function generatePdf()
    {
        $data = "";

        /** @var Code $code */
        foreach ($this->file->getCodes() as $code) {
            $data .= $code;
        }

        $this->pdfGenerator->WriteHTML($data);
        $this->pdfGenerator->SetProtection(['print'], self::PDF_FILE_PASSWORD);
        $this->pdfGenerator->Output( $this->file::FILES_PATH . $this->file->getName() . $this->file::TARGET_EXTENSION, Destination::FILE);
    }
}
