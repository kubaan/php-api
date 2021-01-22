<?php
namespace App\Classes;

use Mpdf\MpdfException;
use PHPMailer\PHPMailer\Exception;

class App
{
    /**
     * @var App
     */
    private static $instance;

    /**
     * App constructor.
     */
    private function __construct()
    {

    }

    private function __clone()
    {

    }

    /**
     * Singleton constructor.
     *
     * @return App
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new App();
        }

        return self::$instance;
    }

    /**
     * Init application.
     */
    public function init()
    {
        $api = new Api();

        try {
            $api->sendMail();
        }
        catch (MpdfException $e) {
            echo "MPDF exception: " . $e->getMessage();
        }
        catch (Exception $e) {
            echo "Exception: " . $e->getMessage();
        }
    }
}
