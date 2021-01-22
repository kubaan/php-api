<?php
namespace App\Classes;

class Api
{
    /**
     * @var array
     */
    protected $response;

    /**
     * Endpoint: ?count=codesCount&email=email
     * count - integer
     * email - string
     *
     * @throws \Mpdf\MpdfException
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function sendMail()
    {
        $this->validate();

        $file = new File((int) $_GET['count']);
        $pdf = new Pdf($file);
        $mail = new Mail();
        $mail->sendMail($file, trim($_GET['email']));

        /** @var Code $code */
        foreach ($file->getCodes() as $code) {
            $codes[] = $code->getCode();
        }

        $this->setResponse([
            'status' => 200,
            'success' => true,
            'message' => 'E-mail has been sent successfully',
            'data' => [
                'email_address' => trim($_GET['email']),
                'file' => [
                    'name' => $file->getName() . $file::TARGET_EXTENSION,
                    'codes_count' => $_GET['count'],
                    'codes' => $codes
                ]
            ]
        ]);
        $this->sendResponse();
    }

    /**
     * Validate API request parameters
     */
    private function validate()
    {
        if (!$this->isParemetersSet()) {
            $this->buildFailedResponse('Invalid endpoint address - parameters are not set');
        }

        if ((int) $_GET['count'] < 1) {
            $this->buildFailedResponse('Count must be at least 1');
        }

        if (!$this->isEmailValid()) {
            $this->buildFailedResponse('Invalid e-mail address');
        }
    }

    /**
     * Check if all parameters are set.
     *
     * @return bool
     */
    private function isParemetersSet()
    {
        return empty($_GET['count']) && empty($_GET['email']) ? false : true;
    }

    /**
     * Build and send failed response.
     *
     * @param string $message
     */
    private function buildFailedResponse($message)
    {
        $this->setResponse([
            'status' => 400,
            'success' => false,
            'message' => (string) $message
        ]);
        $this->sendResponse();
    }

    /**
     * @param array $response
     */
    public function setResponse(array $response)
    {
        $this->response = $response;
    }

    /**
     * Send response to client.
     */
    private function sendResponse()
    {
        header("Content-Type: application/json");
        header('X-PHP-Response-Code: ' . $this->response['status'], true, $this->response['status']);

        die(json_encode($this->response));
    }

    /**
     * Check if email parameter is valid.
     *
     * @return bool
     */
    private function isEmailValid()
    {
        return filter_var(trim($_GET['email']), FILTER_VALIDATE_EMAIL);
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }
}
