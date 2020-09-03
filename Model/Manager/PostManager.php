<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 03/08/2020
 * Time: 16:04
 */

namespace App\Model\Manager;


use App\Framework\BaseManager;

class PostManager extends BaseManager
{
    public function __construct($datasource)
    {
        parent::__construct('post', 'App\\Model\\Entity\\Post', $datasource);
    }
}