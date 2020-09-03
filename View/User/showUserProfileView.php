<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 27/07/2020
 * Time: 15:04
 */
?>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card shadow mb-4" id="release">
            <div class="card-header text-white bg-dark header-elements-inline">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> User Profil</h5>
                    </div>
                    <?php if ($user->hasRole('member')) { ?>
                        <div class="col-md-6">
                            <div class="float-right">
                                <a class="btn btn-success" href="<?= htmlspecialchars($config->basePath); ?>/editUserProfile"><i
                                        class="fa fa-edit" aria-hidden="true"></i> Edit Profil</a>
                                <a id="btnPreviousPage" class="btn btn-light" href="#"><i class="fa fa-previous"
                                                                                          aria-hidden="true"></i>
                                    Previous Page</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="card-body">

                <div class="card border-0 mb-4">
                    <div class="card-body">
                        <h5 class="m-0"><?= htmlspecialchars($user->getSalutation()) . ' ' . htmlspecialchars($user->getFirstName()) . ' ' . htmlspecialchars($user->getLastName()); ?></h5>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-6">
                                <strong><label>Login : </label></strong> <?= htmlspecialchars($user->getMail()); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <strong><label>Role(s)
                                        : </label></strong> <?php foreach ($user->getListRoles() as $role) {
                                    echo htmlspecialchars($role->getDescription()) . ', ';
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-row">
                            <div class="col-md-6">
                                <strong><label>Password : </label></strong> ************
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
