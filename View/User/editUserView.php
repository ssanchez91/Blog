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
                        <h5 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Edit User Profil</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="float-right">
                            <a id="btnPreviousPage" class="btn btn-light" href="#"><i class="fa fa-previous"
                                                                                      aria-hidden="true"></i> Previous
                                Page</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="../editUser">
                    <div class="form-row">
                        <div class="col-md-6">
                            <input id="id" name="id" type="hidden" value="<?= htmlspecialchars($user->getId()); ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="enabled">Etat : </label>
                            <select id="enabled" name="enabled" class="form-control">
                                <option value=1 <?php if (htmlspecialchars($user->getEnabled()) == true) {
                                    echo 'selected="selected"';
                                } ?>>Enable
                                </option>
                                <option value="false" <?php if (htmlspecialchars($user->getEnabled()) == false) {
                                    echo 'selected="selected"';
                                } ?>>Disable
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="role">Role(s) : </label>
                            <select id="role" name="role" class="form-control">
                                <option value="admin" <?php if (htmlspecialchars($user->hasRole('admin'))) {
                                    echo 'selected="selected"';
                                } ?>>Administrator
                                </option>
                                <option value="author" <?php if (htmlspecialchars($user->hasRole('author')) && htmlspecialchars($user->hasRole('admin')) == false) {
                                    echo 'selected="selected"';
                                } ?>>Author
                                </option>
                                <option value="member" <?php if (htmlspecialchars($user->hasRole('member')) && htmlspecialchars($user->hasRole('author')) == false && htmlspecialchars($user->hasRole('admin')) == false) {
                                    echo 'selected="selected"';
                                } ?>>Member
                                </option>
                            </select>
                        </div>
                        <input type="hidden" value=<?php if (htmlspecialchars($user->getEnabled()) == true) {
                            echo '1';
                        } else {
                            echo "false";
                        } ?> name="enabledOrigin"/>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="salutation">Salutation : </label>
                            <select id="salutation" name="salutation" class="form-control">
                                <option value="M." <?php if (htmlspecialchars($user->getSalutation()) == 'M.') {
                                    echo 'selected="selected"';
                                } ?>>Monsieur
                                </option>
                                <option value="Mme" <?php if (htmlspecialchars($user->getSalutation()) == 'Mme') {
                                    echo 'selected="selected"';
                                } ?>>Madame
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">Firstname : </label> <input id="firstname" name="firstname"
                                                                               class="form-control" type="text"
                                                                               value="<?= htmlspecialchars($user->getFirstname()); ?>"/>
                        </div>
                        <div class="form-group  col-md-6">
                            <label for="lastname">Lastname : </label> <input id="lastname" name="lastname"
                                                                             class="form-control" type="text"
                                                                             value="<?= htmlspecialchars($user->getLastname()); ?>"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group  col-md-6">
                            <label for="login">Login : </label> <input id="login" name="login" class="form-control"
                                                                       type="text" value="<?= htmlspecialchars($user->getMail()); ?>"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group  col-md-3">
                            <input id='submit' type="submit" value="Save" class="btn btn-dark form-control"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>