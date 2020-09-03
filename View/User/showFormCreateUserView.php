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
                        <h5 class="card-title"><i class="fa fa-user" aria-hidden="true"></i> Register User</h5>
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
                <form method="post" action="registerUser">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="salutation">Salutation : </label>
                            <select id="salutation" name="salutation" class="form-control">
                                <option value="M.">Monsieur</option>
                                <option value="Mme">Madame</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="firstname">Firstname : </label> <input id="firstname" name="firstname"
                                                                               class="form-control" type="text"
                                                                               value=""/>
                        </div>
                        <div class="form-group  col-md-4">
                            <label for="lastname">Lastname : </label> <input id="lastname" name="lastname"
                                                                             class="form-control" type="text" value=""/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group  col-md-12">
                            <label for="login"> Email (Login) : </label> <input id="login" name="login"
                                                                                class="form-control" type="text"
                                                                                value=""/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Password : </label> <input id="password" name="password"
                                                                             class="form-control" type="password"
                                                                             value=""/>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirmPassword">Confirm Password : </label> <input id="confirmPassword"
                                                                                            name="confirmPassword"
                                                                                            class="form-control"
                                                                                            type="password" value=""/>
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

