<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 02/07/2020
 * Time: 14:14
 */
namespace App\Controller;

use App\Framework\BaseController;

/**
 * Class DefaultController
 *
 * @package App\Controller
 */
class DefaultController extends BaseController
{
    /**
     * Method default
     *
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     */
    public function defaultAction()
    {
        $this->view('default');
    }

    /**
     * Method sendEmail
     *
     * Create email and send the message
     *
     * @param string $fullname Lastname and FirstName of visitor
     * @param string $contactEmail mail of visitor
     * @param string $message Message sent
     * @throws \App\Framework\Exception\NoViewFoundException No view found with this name
     * @throws \Exception
     */
    public function sendEmailAction($fullname, $contactEmail, $message)
    {
        $email_subject = "Website Contact Form:  $fullname";
        $email_body = "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $fullname\n\nEmail: $contactEmail\n\nMessage: $message";
        $this->mailManager->sendEmail(null, $email_subject, $email_body);
        $this->alertManager->addAlert("Your email has been sent with success !", "info");
        return $this->view('default');
    }
}