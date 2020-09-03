<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 02/07/2020
 * Time: 14:14
 */
namespace App\Controller;

use App\Framework\BaseController;
use App\Framework\Exception\NoRouteFileFoundException;
use App\Framework\HttpRequest;
use App\Framework\Router;
use App\Model\Entity\Alert;


class DefaultController extends BaseController
{
    /**
     * @throws \App\Framework\Exception\NoViewFoundException
     */
    public function defaultAction()
    {
        $this->view('default');
    }

    /**
     * @param $fullname
     * @param $contactEmail
     * @param $message
     * @throws \App\Framework\Exception\NoViewFoundException
     * @throws \Exception
     */
    public function sendEmailAction($fullname, $contactEmail, $message)
    {
        // Create the email and send the message
        $email_subject = "Website Contact Form:  $fullname";
        $email_body = "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $fullname\n\nEmail: $contactEmail\n\nMessage: $message";
        $this->mailManager->sendEmail(null, $email_subject, $email_body);
        $this->alertManager->addAlert("Your email has been sent with success !", "info");
        return $this->view('default');
    }
}