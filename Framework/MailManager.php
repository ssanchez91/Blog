<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 27/08/2020
 * Time: 16:38
 */

namespace App\Framework;


class MailManager
{
    private $to;
    private $from;
    private $subject;

    public function __construct()
    {
        $this->to = "sanchez.steeve@gmail.com";
        $this->subject = "Website Contact : Blog Projet 5";
        $this->from = "steeve.sanchez@orange.fr";
    }


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