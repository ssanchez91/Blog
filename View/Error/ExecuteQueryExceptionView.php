<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 23/07/2020
 * Time: 10:26
 */
?>
<div class="content">
    <div class="card" id="release">
        <div class="card-header bg-danger header-elements-inline">
            <h5 class="card-title">Une erreur s'est produite :</h5>

            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="alert alert-info"><b>Message :</b> <?= htmlspecialchars($exception->getMessage()); ?></div>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']->hasRole('admin')) {
                ?>
                <div class="alert alert-info"><b>Type de requête :</b> <?= htmlspecialchars($exception->getRequestType()); ?></div>
                <div class="alert alert-danger"><b>Détails :</b> <?= htmlspecialchars($exception->getDetails()); ?></div>
                <div class="alert alert-info"><b>Trace :</b> <?= htmlspecialchars($exception->getTraceAsString()); ?></div>
            <?php } ?>
        </div>
    </div>
</div>
