<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 21/07/2020
 * Time: 10:24
 */

namespace App\Model\Manager;

use App\Framework\BaseManager;

class RoleManager extends BaseManager
{
    public function __construct($datasource)
    {
        parent::__construct('role', 'App\\Model\\Entity\\Role', $datasource);
    }


}