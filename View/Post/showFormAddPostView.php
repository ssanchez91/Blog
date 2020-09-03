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
        <div class="card" id="release">
            <div class="card-header text-white bg-dark header-elements-inline">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title"><i class="fa fa-tag" aria-hidden="true"></i> Add Post</h5>
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
                <form method="post" action="addPost">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="title">Title : </label><input id="title" name="title" class="form-control"
                                                                      type="text" value=""/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="hat">Hat : </label> <textarea id="hat" name="hat"
                                                                      class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group  col-md-12">
                            <label for="content">Content : </label> <textarea id="content" name="content"
                                                                              class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group  col-md-3">
                            <input id='submit' type="submit" value="Save" class="btn btn-dark form-control"/>
                        </div>
                        <div class="form-group col-md-3 offset-md-6">
                            <p class="text-right">
                                <small
                                    class="text-muted text-sm-right"><?php echo 'By ' . $user->getFirstname() . ' ' . $user->getLastname() . '.'; ?></small>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
