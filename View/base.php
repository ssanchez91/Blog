<!DOCTYPE html>
<html class="h-100">
    <head>
        <meta charset="utf-8"/>
        <title><?= $httpRequest->getRoute()->getName(); ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
              integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
              integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <?= $fileManager->generateCss(); ?>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
                integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
                crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"
                integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd"
                crossorigin="anonymous"></script>
        <?= $fileManager->generateJs(); ?>
    </head>
    <body class="d-flex flex-column h-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="<?= $config->basePath; ?>/default">BLOG-PROJET 5</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item  <?php if ($httpRequest->getRoute()->getName() == "default") { ?> active <?php } ?> ">
                        <a class="nav-item nav-link" href="<?= $config->basePath; ?>/default"><i class="fa fa-home"></i> Home
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <?php if ($user == null) { ?>
                        <li class="nav-item <?php if ($httpRequest->getRoute()->getName() == "registerUser") { ?> active <?php } ?> ">
                            <a class="nav-item nav-link" href="<?= $config->basePath; ?>/registerUser"><i
                                    class="fa fa-user-plus"></i> Register</a>
                        </li>
                    <?php } ?>
                    <?php if ($user != null) { ?>
                        <?php if ($user->hasRole("member")) { ?>
                            <li class="nav-item <?php if ($httpRequest->getRoute()->getName() == "showUserProfile") { ?> active <?php } ?> ">
                                <a class="nav-item nav-link" href="<?= $config->basePath; ?>/showUserProfile"><i
                                        class="fa fa-user"></i> Profile</a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <li class="nav-item <?php if ($httpRequest->getRoute()->getName() == "listPostPublic") { ?> active <?php } ?> ">
                        <a class="nav-item nav-link" href="<?= $config->basePath; ?>/listPostPublic/1"><i
                                class="fa fa-list"></i> List Post</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <?php if ($user != null) { ?>
                            <li class="nav-item">
                                <a class="nav-item nav-link float-right" href="<?= $config->basePath; ?>/logout"><i
                                        class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-item nav-link text-right" href="<?= $config->basePath; ?>/login"><i
                                        class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                            </li>
                        <?php } ?>
                    </ul>
                </form>
            </div>
        </nav>
        <div class="container-fluid">
            <?php if (!empty($alertManager))
            { ?>
                <?= $alertManager->showAlert(); ?>
            <?php } ?>
            <!-- Modal -->
            <div class="modal fade confirm" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title text-white" id="confirmModalLabel">Confirm action</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            You must confirm you want execute this action !
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-warning btn-ok">Confirm</a>
                        </div>
                    </div>
                </div>
            </div>
            <?= $content; ?>
        </div>
        <footer class="footer mt-auto py-3 w-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <span class="text-muted">Blog - Projet 5 - OCR - <i class="fa fa-copyright"></i> ssanchez - 2020 </span>
                    </div>
                    <div class="col-md-6">
                        <?php if ($user != null && ($user->hasRole("admin") || $user->hasRole("author"))) { ?>
                            <span class="text-muted float-right"><a href="<?= $config->basePath; ?>/admin"><i
                                        class="fa fa-cogs"></i> Admin Settings</a></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>