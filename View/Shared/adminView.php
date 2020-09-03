<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 26/08/2020
 * Time: 11:57
 */
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-danger col-md-10 offset-md-1">
    <a class="navbar-brand" href="<?= htmlspecialchars($config->basePath); ?>/admin"><i class="fa fa-cogs"></i> ADMIN SETTINGS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContentAdmin" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContentAdmin">
        <ul class="navbar-nav mr-auto">
            <?php if ($user != null) { ?>
                <?php if ($user->hasRole("admin")) { ?>

                    <li class="nav-item <?php if ($httpRequest->getRoute()->getName() == "listUser") { ?> active <?php } ?> ">
                        <a class="nav-item nav-link" href="<?= htmlspecialchars($config->basePath); ?>/listUser/1"><i
                                class="fa fa-user"></i> User Settings</a>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</nav>