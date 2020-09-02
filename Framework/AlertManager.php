<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 28/08/2020
 * Time: 16:16
 */

namespace App\Framework;


use App\Model\Entity\Alert;

class AlertManager
{
    private $listAlert;

    public function __construct($listAlert = [])
    {
        $this->listAlert = $listAlert;
    }

    public function addAlert($message, $type)
    {
        $alert = new Alert($message, $type);
        $this->listAlert[] = $alert;
        $_SESSION['alert'] = $this->listAlert;
    }

    public function showAlert()
    {
        $alertContent = '';

        foreach ($this->listAlert as $alert) {
            $alertContent .= '<div class="alert alert-' . $alert->getType() . ' alert-dismissible fade show col-md-10 offset-md-1" role="alert">' .
                $alert->getMessage() . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
        $this->clear();
        return $alertContent;
    }

    public function clear()
    {
        $_SESSION['alert'] = '';
    }
}