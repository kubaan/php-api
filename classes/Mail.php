<?php
namespace App\Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Mail
{
    /**
     * SMTP host.
     */
    const MAIL_SMTP_HOST = "smtp.elasticemail.com";

    /**
     * SMTP username.
     */
    const MAIL_SMTP_USERNAME = "example@app.com";

    /**
     * SMTP password.
     */
    const MAIL_SMTP_PASSWORD = "950455E81E7AFCF7A470FEA8B9BF4952310A";

    /**
     * SMTP port.
     */
    const MAIL_SMTP_PORT = "2525";

    /**
     * From address e-mail.
     */
    const MAIL_FROM_ADDRESS = "kubasgce@gmail.com";

    /**
     * Mail subject.
     */
    const MAIL_SUBJECT = "Misja PHP - Intellect";

    /**
     * Mail body.
     */
    const MAIL_BODY = "Ukończenie pierwszej misji PHP!";

    /**
     * @var PHPMailer
     */
    protected $mailer = null;

    /**
     * Mail constructor.
     */
    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->setSettings();
    }

    /**
     * Send e-mail.
     *
     * @param File $file
     * @param string $recipient
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function sendMail($file, $recipient)
    {
        $this->mailer->setFrom(self::MAIL_FROM_ADDRESS);
        $this->mailer->addAddress((string)$recipient);
        /** @var File $file */
        $this->mailer->addAttachment($file::FILES_PATH . $file->getName() . $file::TARGET_EXTENSION);
        $this->mailer->Subject = self::MAIL_SUBJECT;
        $this->mailer->Body = self::MAIL_BODY;
        $this->mailer->send();
    }

    /**
     * Set main PHPMailer settings.
     */
    private function setSettings()
    {
        $this->mailer->isSMTP();
        $this->mailer->SMTPAuth = true;
        $this->mailer->Host = self::MAIL_SMTP_HOST;
        $this->mailer->Username = self::MAIL_SMTP_USERNAME;
        $this->mailer->Password = self::MAIL_SMTP_PASSWORD;
        $this->mailer->Port = (int)self::MAIL_SMTP_PORT;
        $this->mailer->CharSet = "UTF-8";
    }
}
