<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 28/08/2020
 * Time: 16:16
 */

namespace App\Framework;


use App\Model\Entity\Alert;


/**
 * Class AlertManager
 *
 * @package App\Framework
 */
class AlertManager
{
    /**
     * List of Alert
     *
     * @var array
     */
    private $listAlert;

    /**
     * Constructor
     *
     * @param array $listAlert List of Alert
     */
    public function __construct($listAlert = [])
    {
        $this->listAlert = $listAlert;
    }

    /**
     * Method addAlert
     *
     * @param string $message Content of alert
     * @param string $type Type of alert (success - danger - warning -...)
     */
    public function addAlert($message, $type)
    {
        $alert = new Alert($message, $type);
        $this->listAlert[] = $alert;
        $_SESSION['alert'] = $this->listAlert;
    }

    /**
     * Method showAlert
     *
     * @return string display alerts on the layout base.php
     */
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

    /**
     * Method clear
     *
     * Allow to clear List of alerts
     */
    public function clear()
    {
        $_SESSION['alert'] = '';
    }
}