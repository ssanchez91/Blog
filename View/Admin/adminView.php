<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 26/08/2020
 * Time: 11:57
 */

?>
<?php $controller->sharedView('navbarAdmin', 'Shared'); ?>
<div class="content">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h2><?= $user->getFirstname() . ' ' . $user->getLastname() . '' ?></h2>
            <span>Welcome in your administrator workspace !</span>
        </div>
    </div>
</div>
<div class="content">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card shadow mb-4" id="release_info">
                <div class="card-header text-white bg-info header-elements-inline">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title"><i class="fa fa-stat" aria-hidden="true"></i> Statistics</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h4><i class="fa fa-tag" aria-hidden="true"></i> Post Infos</h4>

                            <div class="row">
                                <div class="col-md-12">
                                    <h6>Number of Posts written : <span
                                            class="badge badge-pill badge-warning"><?= $stats->nbPostWritten ?></span>
                                    </h6>
                                </div>
                            </div>
                            <?php if ($user->hasRole('admin')) {
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>Total number of Posts : <span
                                                class="badge badge-pill badge-info"><?= $stats->nbPost ?></span></h6>
                                    </div>
                                </div>
                                <?php
                            } ?>
                        </div>
                        <div class="col-md-4">
                            <h4><i class="fa fa-comment" aria-hidden="true"></i> Comment Infos</h4>

                            <div class="row">
                                <div class="col-md-12">
                                    <h6>Number of Comments written : <span
                                            class="badge badge-pill badge-warning"><?= $stats->nbCommentWritten ?></span>
                                    </h6>
                                </div>
                            </div>
                            <?php if ($user->hasRole('admin')) {
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>Total number of Comments : <span
                                                class="badge badge-pill badge-info"><?= $stats->nbCommentTot ?></span>
                                        </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>Number of Comments published : <span
                                                class="badge badge-pill badge-success"><?= $stats->nbCommentPublished ?></span>
                                        </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>Number of Comments banned : <span
                                                class="badge badge-pill badge-danger"><?= $stats->nbCommentBanned ?></span>
                                        </h6>
                                    </div>
                                </div>
                                <?php
                            } ?>
                        </div>
                        <?php if ($user->hasRole('admin')) {
                            ?>
                            <div class="col-md-4">
                                <h4><i class="fa fa-user" aria-hidden="true"></i> User Infos</h4>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>Number of enabled User : <span
                                                class="badge badge-pill badge-success"><?= $stats->nbUserEnabled ?></span>
                                        </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>Number of disabled User : <span
                                                class="badge badge-pill badge-danger"><?= $stats->nbUserDisabled ?></span>
                                        </h6>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h6>Total number of User : <span
                                                class="badge badge-pill badge-info"><?= $stats->nbUserTot ?></span></h6>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





