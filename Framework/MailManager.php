<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 27/08/2020
 * Time: 16:38
 */

namespace App\Framework;

/**
 * Class MailManager
 *
 * @package App\Framework
 */
class MailManager
{
    /**
     * Variable To
     * @var
     */
    private $to;
    /**
     * Variable From
     * @var
     */
    private $from;
    /**
     * Variable Subject
     * @var string
     */
    private $subject;

    /**
     * Constructor
     *
     * @param object $config Json File Object Config
     */
    public function __construct($config)
    {
        $this->to = $config->mailTo;
        $this->subject = "Website Contact : Blog Projet 5";
        $this->from = $config->mailFrom;
    }

    /**
     * Method sendMail
     *
     * @param string $to mail to
     * @param string $subject mail subject
     * @param string $body content of message
     * @return bool
     * @throws \Exception
     */
    public function sendEmail($to = null, $subject = null, $body)
    {
        if (empty($subject)) {
            $subject = $this->subject;
        }
        if (empty($to)) {
            $to = $this->to;
        }
        $headers = "From: $this->from\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
        $headers .= "Reply-To: $this->from";
        try {
            mail($this->to, $subject, $body, $headers);
            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}