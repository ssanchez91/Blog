<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 19/08/2020
 * Time: 09:03
 */

namespace App\Framework\Exception;


class PageNotFoundException extends \Exception
{

    /**
     * PageNotFoundException constructor.
     */
    public function __construct($page, $pageMax)
    {
        $message = 'The page number ' . $page . ' is not found ! The number of pages is ' . $pageMax . '.';
        parent::__construct($message, 0603);
    }
}