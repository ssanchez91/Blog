<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 19/08/2020
 * Time: 09:03
 */

namespace App\Framework\Exception;

/**
 * Class PageNotFoundException
 *
 * @package App\Framework\Exception
 */
class PageNotFoundException extends \Exception
{

    /**
     * PageNotFoundException constructor.
     *
     * @param string $page number of the page asked
     * @param int $pageMax number of max page
     */
    public function __construct($page, $pageMax)
    {
        $message = 'The page number ' . $page . ' is not found ! The number of pages is ' . $pageMax . '.';
        parent::__construct($message, 0603);
    }
}